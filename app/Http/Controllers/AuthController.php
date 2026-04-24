<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|string|email|unique:users',
            'password'   => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
            'password'     => Hash::make($request->password), 
            'role'         => 'masyarakat', 
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Registrasi berhasil. Silakan login.',
                'user'    => $user
            ], 201);
        }

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($request->expectsJson()) {
                return response()->json([
                    'token' => $user->createToken('auth_token')->plainTextToken,
                    'role'  => $user->role,
                    'user'  => $user
                ]);
            }

            return $this->redirectBasedOnRole($user->role);
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request) {
        Auth::logout();
        
        if ($request->expectsJson()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Logged out']);
        }

        return redirect('/login');
    }

    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user()->role);
        }
        return view('auth.login');
    }

    public function showAdminDashboard() {
        return view('admin.dashboard');
    }

    public function showPakarDashboard() {
        return view('pakar.dashboard');
    }

    public function showMasyarakatDashboard() {
        return view('masyarakat.dashboard');
    }

    protected function redirectBasedOnRole($role)
    {
        return match($role) {
            'admin'      => redirect()->route('admin.dashboard'),
            'pakar'      => redirect()->route('pakar.dashboard'),
            'masyarakat' => redirect()->route('dashboard'),
            default      => redirect('/login'),
        };
    }
    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user()->role);
        }

        return view('auth.signup');
    }
}