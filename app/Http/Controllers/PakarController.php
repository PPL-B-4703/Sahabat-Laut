<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\DB;
use App\Notifications\LaporanBaruNotification;

class PakarController extends Controller
{
    public function showPakarDashboard()
    {
        $totalLaporan = Laporan::count();
        $laporanMenunggu = Laporan::where('status', 'Menunggu Verifikasi')->count();
        $laporanSelesai = Laporan::whereIn('status', ['Terverifikasi', 'Ditolak'])->count();
        $recentReports = Laporan::latest()->take(5)->get();

        // --- LOGIC TAMBAHAN UNTUK GRAFIK PROVINSI ---
        // Mengambil data alamat_lokasi, memecah string untuk mendapatkan nama Provinsi, lalu menghitungnya
        $laporanPerProvinsi = Laporan::select('alamat_lokasi', DB::raw('count(*) as total'))
            ->groupBy('alamat_lokasi')
            ->get();

        $provinsiData = [];
        foreach ($laporanPerProvinsi as $item) {
            // Memecah teks "Nama Lokasi, Provinsi Jawa Barat" mengambil bagian setelah kata "Provinsi "
            $parts = explode(', Provinsi ', $item->alamat_lokasi);
            $namaProvinsi = $parts[1] ?? 'Luar Provinsi / Tidak Diketahui';
            
            if (!isset($provinsiData[$namaProvinsi])) {
                $provinsiData[$namaProvinsi] = 0;
            }
            $provinsiData[$namaProvinsi] += $item->total;
        }

        // Ambil maksimal 5-7 provinsi teratas untuk grafik agar tidak terlalu penuh
        arsort($provinsiData);
        $provinsiData = array_slice($provinsiData, 0, 7, true);

        $chartLabels = array_keys($provinsiData);
        $chartValues = array_values($provinsiData);
        // --------------------------------------------

        return view('pakar.dashboard', compact(
            'totalLaporan', 
            'laporanMenunggu', 
            'laporanSelesai', 
            'recentReports',
            'chartLabels',
            'chartValues'
        ));
    }

    public function index()
    {
        $reports = Laporan::latest()->paginate(5);
        return view('pakar.index_validasi', compact('reports'));
    }

    public function show($id)
    {
        $report = Laporan::findOrFail($id);
        return view('pakar.detail_validasi', compact('report'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Terverifikasi,Ditolak',
            'koreksi' => 'nullable|string|max:1000',
        ]);

        $report = Laporan::findOrFail($id);

        if ($report->status !== 'Menunggu Verifikasi') {
            return redirect()->back()->with('error', 'Laporan ini sudah divalidasi!');
        }

        $report->status = $request->status;
        $report->koreksi = $request->koreksi;
        $report->save();

        $userMasyarakat = $report->user; 

        if ($userMasyarakat) {
            $userMasyarakat->notify(new LaporanBaruNotification($report, 'status_diperbarui'));
        }

        // ===============================================================================

        return redirect()->route('pakar.validasi')->with('success', 'Validasi laporan berhasil disimpan!');
    }

    public function editProfile()
    {
        $user = auth()->user(); 
        return view('pakar.edit_profile', compact('user'));
    }
}