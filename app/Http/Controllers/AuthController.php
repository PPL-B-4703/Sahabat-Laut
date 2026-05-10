<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        return view('pakar.dashboard', ['user' => Auth::user()]); 
    }

    public function showMasyarakatDashboard() 
    {
        return view('masyarakat.dashboard', ['user' => Auth::user()]);
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