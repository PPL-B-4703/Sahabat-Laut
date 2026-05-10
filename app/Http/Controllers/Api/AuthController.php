<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
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

        return response()->json([
            'message' => 'Registrasi berhasil.',
            'user'    => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            return response()->json([
                'message' => 'Login berhasil',
                'token'   => $user->createToken('auth_token')->plainTextToken,
                'role'    => $user->role,
                'user'    => $user
            ]);
        }

        return response()->json(['message' => 'Email atau password salah.'], 401);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'message' => 'Data profil berhasil diambil',
            'user'    => $request->user()
        ]);
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
        }

        return response()->json(['message' => 'Logged out from API']);
    }
}