@extends('admin.layouts.app')

@section('title', 'Edit User')
@section('page_title', 'Edit User')

@section('content')
    <div class="max-w-2xl">
        <!-- Form Card -->
        <div class="bg-slate-900 border border-slate-800 rounded-lg p-8">
            <p class="text-slate-400 text-sm mb-6">{{ $user->first_name }} {{ $user->last_name }}</p>
            
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- First Name -->
                <div>
                    <label for="first_name" class="block text-sm font-bold text-slate-100 mb-2">Nama Depan <span class="text-red-400">*</span></label>
                    <input 
                        type="text" 
                        id="first_name" 
                        name="first_name" 
                        value="{{ old('first_name', $user->first_name) }}"
                        class="w-full px-4 py-3 bg-slate-800 border @error('first_name') border-red-600 @else border-slate-700 @enderror rounded-lg text-slate-100 placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-colors"
                        placeholder="Masukkan nama depan"
                        required>
                    @error('first_name')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Last Name -->
                <div>
                    <label for="last_name" class="block text-sm font-bold text-slate-100 mb-2">Nama Belakang <span class="text-red-400">*</span></label>
                    <input 
                        type="text" 
                        id="last_name" 
                        name="last_name" 
                        value="{{ old('last_name', $user->last_name) }}"
                        class="w-full px-4 py-3 bg-slate-800 border @error('last_name') border-red-600 @else border-slate-700 @enderror rounded-lg text-slate-100 placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-colors"
                        placeholder="Masukkan nama belakang"
                        required>
                    @error('last_name')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-bold text-slate-100 mb-2">Email <span class="text-red-400">*</span></label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-3 bg-slate-800 border @error('email') border-red-600 @else border-slate-700 @enderror rounded-lg text-slate-100 placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-colors"
                        placeholder="Masukkan email"
                        required>
                    @error('email')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone_number" class="block text-sm font-bold text-slate-100 mb-2">Nomor Telepon</label>
                    <input 
                        type="text" 
                        id="phone_number" 
                        name="phone_number" 
                        value="{{ old('phone_number', $user->phone_number) }}"
                        class="w-full px-4 py-3 bg-slate-800 border @error('phone_number') border-red-600 @else border-slate-700 @enderror rounded-lg text-slate-100 placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-colors"
                        placeholder="Masukkan nomor telepon (opsional)">
                    @error('phone_number')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-bold text-slate-100 mb-2">Password Baru</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full px-4 py-3 bg-slate-800 border @error('password') border-red-600 @else border-slate-700 @enderror rounded-lg text-slate-100 placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-colors"
                        placeholder="Masukkan password baru (min. 8 karakter, kosongkan jika tidak ingin mengubah)">
                    @error('password')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-slate-400 text-xs mt-2">Kosongkan field ini jika tidak ingin mengubah password</p>
                </div>

                <!-- Password Confirmation -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-slate-100 mb-2">Konfirmasi Password Baru</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="w-full px-4 py-3 bg-slate-800 border @error('password_confirmation') border-red-600 @else border-slate-700 @enderror rounded-lg text-slate-100 placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-colors"
                        placeholder="Konfirmasi password baru">
                    @error('password_confirmation')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block text-sm font-bold text-slate-100 mb-2">Role <span class="text-red-400">*</span></label>
                    <select 
                        id="role" 
                        name="role" 
                        class="w-full px-4 py-3 bg-slate-800 border @error('role') border-red-600 @else border-slate-700 @enderror rounded-lg text-slate-100 focus:outline-none focus:border-blue-500 transition-colors"
                        required>
                        <option value="" class="bg-slate-800 text-slate-100">-- Pilih Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role }}" @selected(old('role', $user->role) === $role) class="bg-slate-800 text-slate-100">
                                {{ ucfirst($role) }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-4">
                    <button 
                        type="submit" 
                        class="flex-1 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition-all shadow-lg">
                        Update User
                    </button>
                    <a 
                        href="{{ route('admin.users.index') }}" 
                        class="flex-1 py-3 bg-slate-700 hover:bg-slate-600 text-slate-100 font-bold rounded-lg transition-all text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
