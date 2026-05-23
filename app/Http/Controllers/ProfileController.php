<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Tambahkan ini untuk enkripsi password
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk manajemen file
class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user(); 
        return view('masyarakat.profil_masyarakat', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Validasi inputan (termasuk foto max 5MB)
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'nullable|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'phone_number'      => 'nullable|string|max:20',
            'password'   => 'nullable|min:8',
            'avatar'     => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // Maks 5MB
        ], [
            'avatar.max' => 'Ukuran foto maksimal 5MB!',
            'avatar.mimes' => 'Format foto harus berupa JPG, JPEG, atau PNG.',
        ]);

        // 2. Proses upload foto (jika ada file yang diunggah)
        if ($request->hasFile('avatar')) {
            // Hapus foto lama jika ada (supaya storage tidak penuh)
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            // Simpan foto baru ke folder storage/app/public/avatars
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        // 3. Update data lainnya
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone;

        // Update password HANYA JIKA form password diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Simpan perubahan ke database
        $user->save();

        // Redirect kembali ke halaman profil dengan pesan sukses
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}