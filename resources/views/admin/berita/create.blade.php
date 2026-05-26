@extends('admin.layouts.app')

@section('content')
<div class="p-6 bg-[#07132b] min-h-screen text-white flex justify-center">
    <div class="w-full max-w-4xl bg-[#0b1e42] p-8 rounded-xl border border-gray-800 shadow-2xl">
        <div class="mb-6">
            <span class="text-xs text-gray-400">Manajemen berita &gt; <strong class="text-blue-400">Tambah Berita</strong></span>
            <h2 class="text-xl font-bold mt-1 text-white">Formulir Tambah Berita</h2>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-950 border border-red-800 text-red-400 rounded-lg text-sm">
                <p class="font-bold mb-1">⚠️ Gagal menyimpan berita:</p>
                <ul class="list-disc list-inside text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="bg-[#07132b] p-6 rounded-lg border border-dashed border-gray-700 text-center relative hover:border-blue-500 transition-colors group">
                <label class="block text-sm font-medium mb-2 text-gray-300">Tambah foto <span class="text-red-500">*</span></label>
                <div class="flex flex-col items-center justify-center pt-4 pb-4">
                    <svg class="w-12 h-12 text-gray-500 mb-3 group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    <p class="text-xs text-gray-400 mb-2">Anda dapat seret dan lepas berkas di sini untuk menambahkan.</p>
                    <input type="file" name="gambar" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-950 file:text-blue-400 hover:file:bg-blue-900 cursor-pointer">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Judul Berita</label>
                <input type="text" name="judul" value="{{ old('judul') }}" required placeholder="Input judul berita" class="w-full bg-[#07132b] border border-gray-700 rounded-lg p-3 text-sm focus:outline-none focus:border-blue-500 text-white">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Nama Penulis</label>
                <input type="text" name="penulis" value="{{ old('penulis') }}" required placeholder="Input nama penulis" class="w-full bg-[#07132b] border border-gray-700 rounded-lg p-3 text-sm focus:outline-none focus:border-blue-500 text-white">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Isi Berita</label>
                <textarea name="isi" rows="6" required placeholder="Input isi berita" class="w-full bg-[#07132b] border border-gray-700 rounded-lg p-3 text-sm focus:outline-none focus:border-blue-500 text-white">{{ old('isi') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Referensi</label>
                <textarea name="referensi" rows="3" placeholder="Input referensi" class="w-full bg-[#07132b] border border-gray-700 rounded-lg p-3 text-sm focus:outline-none focus:border-blue-500 text-white">{{ old('referensi') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2">Tag</label>
                <input type="text" name="tag" value="{{ old('tag') }}" placeholder="Input tag" class="w-full bg-[#07132b] border border-gray-700 rounded-lg p-3 text-sm focus:outline-none focus:border-blue-500 text-white">
            </div>

            <div class="flex justify-end gap-4 pt-4 border-t border-gray-800">
                <a href="{{ route('admin.berita.index') }}" class="px-6 py-2 bg-gray-600 hover:bg-gray-500 rounded-lg text-sm font-medium transition-colors text-white text-center">Batal</a>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-sm font-medium transition-colors text-white">Simpan Berita</button>
            </div>
        </form>
    </div>
</div>
@endsection