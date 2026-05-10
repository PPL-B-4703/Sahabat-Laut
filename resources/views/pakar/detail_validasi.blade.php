<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Validasi - {{ $data['nama'] }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #0F172A; }
    </style>
</head>
<body class="min-h-screen flex text-white overflow-x-hidden">

    <aside class="w-64 bg-[#0F172A] border-r border-slate-800 flex flex-col fixed h-full z-30">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-white tracking-tight">Sahabat Laut</h1>
        </div>
        
        <nav class="flex-1 px-4 space-y-2">
            <a href="{{ route('pakar.dashboard') }}" class="flex items-center px-4 py-3 text-slate-400 hover:bg-slate-800 rounded-xl transition group">
                <svg class="w-5 h-5 mr-3 text-slate-500 group-hover:text-white transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
                Dashboard
            </a>

            <a href="{{ route('pakar.validasi') }}" class="flex items-center px-4 py-3 bg-blue-600/10 text-blue-500 rounded-xl font-semibold border border-blue-500/20">
                <svg class="w-5 h-5 mr-3 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .415.162.798.425 1.081.263.283.646.445 1.075.445.429 0 .812-.162 1.075-.445.263-.283.425-.666.425-1.081 0-.231-.035-.454-.1-.664m-5.801 0A2.251 2.251 0 0 1 13.5 2.25c1.028 0 1.91.685 2.199 1.626M6.108 4.625a48.191 48.191 0 0 0-1.123.08C3.845 4.798 3 5.761 3 6.896v11.354A2.25 2.25 0 0 0 5.25 20.5h13.5" />
                </svg>
                Validasi Laporan
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800">
            <button class="w-full flex items-center px-4 py-3 text-red-400 hover:bg-red-400/10 rounded-xl transition font-medium">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                </svg>
                Logout
            </button>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-8">
        <header class="mb-8">
            <nav class="flex items-center gap-2 text-[10px] uppercase tracking-widest text-slate-500 mb-2 font-bold">
                <a href="{{ route('pakar.validasi') }}" class="hover:text-blue-500 transition">Validasi Laporan</a>
                <span>&gt;</span>
                <span class="text-slate-300">Detail Laporan</span>
            </nav>
            <h2 class="text-3xl font-bold">Detail Laporan</h2>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
            <section class="bg-slate-800/40 p-8 rounded-[32px] border border-slate-700 shadow-2xl backdrop-blur-sm">
                <h3 class="text-xl font-bold mb-8">Informasi Laporan User</h3>
                
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <p class="text-lg font-bold text-white">{{ $data['nama'] }}</p>
                        <div class="mt-2 flex items-center gap-2">
                            <span class="text-[9px] font-bold uppercase px-3 py-1 bg-yellow-500/10 text-yellow-500 border border-yellow-500/20 rounded-lg">
                                {{ $data['status'] }}
                            </span>
                        </div>
                    </div>
                    <p class="text-xs font-bold text-slate-500 uppercase">TANGGAL: {{ $data['tgl'] }}</p>
                </div>

                <div class="relative group mb-8">
                    <img src="{{ $data['img'] }}" class="w-full h-72 object-cover rounded-[24px] border border-slate-600 shadow-xl">
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-1">Spesies</label>
                        <p class="text-slate-200 font-semibold italic">{{ $data['spesies'] }}</p>
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-1">Aktivitas</label>
                        <p class="text-slate-200 font-semibold italic">{{ $data['aktivitas'] }}</p>
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-1">Deskripsi Temuan</label>
                        <p class="text-sm text-slate-400 leading-relaxed">
                            Laporan penemuan biota laut jenis {{ $data['spesies'] }} di area {{ $data['lokasi'] }}. Mohon dilakukan verifikasi lebih lanjut oleh tim pakar terkait.
                        </p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 border-t border-slate-700/50 pt-6">
                        <div>
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-1">Provinsi</label>
                            <p class="text-slate-200 font-semibold italic">{{ $data['prov'] }}</p>
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-1">Lokasi</label>
                            <p class="text-slate-200 font-semibold italic">{{ $data['lokasi'] }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-slate-800/40 p-8 rounded-[32px] border border-slate-700 shadow-2xl backdrop-blur-sm sticky top-8">
                <h3 class="text-xl font-bold mb-8">Formulir Validasi & Koreksi Pakar</h3>
                
                <div class="mb-8">
                    <p class="text-lg font-bold text-white mb-6 underline underline-offset-8 decoration-blue-500">Dr. Alif</p>
                    <label class="block text-sm font-bold text-slate-300 mb-3">Status <span class="text-red-500">*</span></label>
                    <select class="w-full bg-slate-900/50 border border-slate-600 rounded-2xl px-5 py-4 text-slate-300 focus:border-blue-500 outline-none">
                        <option value="">Pilih Status Validasi</option>
                        <option value="terverifikasi">Terverifikasi</option>
                        <option value="ditolak">Ditolak</option>
                        <option value="menunggu">Menunggu Verifikasi</option>
                        <option value="sudah_diproses">Sudah Diproses</option>
                    </select>
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-bold text-slate-300 mb-3">Catatan Justifikasi <span class="text-red-500">*</span></label>
                    <textarea class="w-full h-56 bg-slate-900/50 border border-slate-600 rounded-2xl px-5 py-4 text-slate-300 focus:border-blue-500 outline-none resize-none"></textarea>
                    <p class="text-right text-[10px] font-bold text-slate-600 mt-3 tracking-widest">0/1000</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('pakar.validasi') }}" class="py-4 bg-slate-700/50 hover:bg-slate-700 text-center text-white font-bold rounded-2xl transition-all">Batal</a>
                    <button class="py-4 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-2xl shadow-lg shadow-blue-900/30 transition-all">Simpan Validasi</button>
                </div>
            </section>
        </div>
    </main>
</body>
</html>