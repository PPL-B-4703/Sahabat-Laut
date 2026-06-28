<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user()->role);
        }
        return view('auth.signup');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'required|string|email|unique:users',
            'phone_number' => 'nullable|string|max:15',
            'password'     => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
            'password'     => Hash::make($request->password), 
            'role'         => 'masyarakat', 
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user()->role);
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return $this->redirectBasedOnRole(Auth::user()->role);
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showAdminDashboard() 
    { 
        return view('admin.dashboard', ['user' => Auth::user()]); 
    }

    public function showPakarDashboard()
    {
        $totalLaporan = \App\Models\Laporan::count();
        $laporanMenunggu = \App\Models\Laporan::where('status', 'Menunggu Verifikasi')->count();
        $laporanSelesai = \App\Models\Laporan::whereIn('status', ['Terverifikasi', 'Ditolak'])->count();
        $recentReports = \App\Models\Laporan::latest()->take(5)->get();
        $semuaLaporan = \App\Models\Laporan::select('alamat_lokasi')->get();
        
        $provinsiCounts = $semuaLaporan->map(function ($laporan) {
            $parts = explode(', Provinsi ', $laporan->alamat_lokasi);
            return $parts[1] ?? 'Lainnya'; 
        })->countBy();

        return view('pakar.dashboard', [
            'user' => \Illuminate\Support\Facades\Auth::user(),
            'totalLaporan' => $totalLaporan,
            'laporanMenunggu' => $laporanMenunggu,
            'laporanDiproses' => $laporanSelesai,
            'recentReports' => $recentReports,
            
            'chartLabels' => $provinsiCounts->keys(),
            'chartValues' => $provinsiCounts->values(),
        ]);
    }

    public function showMasyarakatDashboard() 
    {
        $user = Auth::user();

        // 1. Ambil Laporan Terakhir untuk fitur Tracking Status
        $laporanTerakhir = Laporan::where('user_id', $user->id)
                                  ->latest()
                                  ->first();

        // 2. Hitung Laporan yang dikirim user HARI INI
        $laporanHarian = Laporan::where('user_id', $user->id)
                                ->whereDate('created_at', Carbon::today())
                                ->count();

        // 3. Ambil 3 data laporan tervalidasi terbaru untuk Tabel Preview
        $laporanValid = Laporan::where('status', 'Terverifikasi')
                               ->latest()
                               ->take(3)
                               ->get()
                               ->map(function ($item) {
                                   $provinsi = 'Lainnya';
                                   if (str_contains($item->alamat_lokasi, ', Provinsi ')) {
                                       $provinsi = explode(', Provinsi ', $item->alamat_lokasi)[1];
                                   }
                                   return [
                                       'tanggal' => Carbon::parse($item->tanggal_temuan)->translatedFormat('d M Y'),
                                       'spesies' => $item->species,
                                       'provinsi' => $provinsi,
                                   ];
                               });

        return view('masyarakat.dashboard', compact('user', 'laporanTerakhir', 'laporanHarian', 'laporanValid'));
    }

    protected function redirectBasedOnRole(string $role)
    {
        return match($role) {
            'admin'      => redirect()->route('admin.dashboard'),
            'pakar'      => redirect()->route('pakar.dashboard'),
            'masyarakat' => redirect()->route('dashboard'),
            default      => redirect('/login'),
        };
    }
}