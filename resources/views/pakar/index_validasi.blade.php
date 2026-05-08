<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Laporan - Sahabat Laut</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #0F172A; }
        .custom-scrollbar::-webkit-scrollbar { height: 8px; width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    </style>
</head>
<body class="min-h-screen flex text-white overflow-x-hidden">

    <aside class="w-64 bg-[#0F172A] border-r border-slate-800 flex flex-col fixed h-full z-10">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-white tracking-tight">Sahabat Laut</h1>
        </div>
        <nav class="flex-1 px-4 space-y-2">
            <a href="{{ route('pakar.dashboard') }}" class="flex items-center px-4 py-3 text-slate-400 hover:bg-slate-800 hover:text-white rounded-xl transition">
                <span class="mr-3">📊</span> Dashboard
            </a>
            <a href="#" class="flex items-center px-4 py-3 bg-slate-800 text-[#A78BFA] rounded-xl font-semibold">
                <span class="mr-3">📋</span> Validasi Laporan
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 text-red-400 hover:bg-red-400/10 rounded-xl transition font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-8 min-w-0">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-3xl font-bold text-white">Daftar Validasi</h2>
                <p class="text-slate-400">Kelola dan verifikasi laporan biota laut terbaru.</p>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-3 bg-slate-800/50 p-2 pr-4 rounded-2xl border border-slate-700">
                    <div class="w-10 h-10 bg-[#7C3AED] rounded-full flex items-center justify-center text-white font-bold uppercase text-sm">P</div>
                    <div class="hidden sm:block text-left">
                        <p class="text-xs text-slate-400 font-medium leading-none mb-1">Status: Pakar</p>
                        <p class="text-sm font-semibold text-white leading-none">Pakar Kelautan</p>
                    </div>
                </div>
                <button class="relative p-2.5 bg-slate-800/50 rounded-xl border border-slate-700 text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z" />
                    </svg>
                    <span class="absolute top-2 right-2.5 block h-2.5 w-2.5 rounded-full bg-red-500 border-2 border-[#0F172A]"></span>
                </button>
            </div>
        </header>

        <div class="bg-slate-800/40 rounded-3xl border border-slate-700 overflow-hidden shadow-2xl">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-800/60 border-b border-slate-700">
                        <tr>
                            <th class="px-4 py-4 text-center">
                                <input type="checkbox" id="checkAll" class="w-4 h-4 rounded bg-slate-700 border-slate-600 text-[#7C3AED] focus:ring-[#7C3AED]">
                            </th>
                            <th class="px-4 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Nama</th>
                            <th class="px-4 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Tanggal Lapor</th>
                            <th class="px-4 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Spesies</th>
                            <th class="px-4 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Provinsi</th>
                            <th class="px-4 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Lokasi</th>
                            <th class="px-4 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Aktivitas</th>
                            <th class="px-4 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Status</th>
                            <th class="px-4 py-4 text-xs font-bold uppercase tracking-wider text-slate-400 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/50">
                        
                        <tr class="hover:bg-slate-700/30 transition-all duration-200">
                            <td class="px-4 py-4 text-center">
                                <input type="checkbox" class="childCheckbox w-4 h-4 rounded bg-slate-700 border-slate-600 text-[#7C3AED]">
                            </td>
                            <td class="px-4 py-4 text-sm font-medium text-white">Gatot Doer</td>
                            <td class="px-4 py-4 text-xs text-slate-400">10 Mei 2026</td>
                            <td class="px-4 py-4 text-sm text-slate-200">Penyu Hijau</td>
                            <td class="px-4 py-4 text-sm text-slate-200">Jawa Barat</td>
                            <td class="px-4 py-4 text-xs text-slate-400 max-w-[120px] truncate">Pangandaran</td>
                            <td class="px-4 py-4 text-xs text-slate-400 italic">Pemantauan</td>
                            <td class="px-4 py-4">
                                <span class="px-2 py-1 text-[9px] font-bold uppercase bg-yellow-500/10 text-yellow-500 border border-yellow-500/20 rounded-md whitespace-nowrap">Menunggu Verifikasi</span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <a href="{{ route('pakar.detail', ['id' => 1]) }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-500 text-xs font-semibold text-white rounded-full transition-all shadow-lg shadow-blue-900/20">
                                    Detail
                                </a>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-700/30 transition-all duration-200">
                            <td class="px-4 py-4 text-center">
                                <input type="checkbox" class="childCheckbox w-4 h-4 rounded bg-slate-700 border-slate-600 text-[#7C3AED]">
                            </td>
                            <td class="px-4 py-4 text-sm font-medium text-white">Rusdi Got</td>
                            <td class="px-4 py-4 text-xs text-slate-400">08 Mei 2026</td>
                            <td class="px-4 py-4 text-sm text-slate-200">Dugong</td>
                            <td class="px-4 py-4 text-sm text-slate-200">Papua Barat</td>
                            <td class="px-4 py-4 text-xs text-slate-400 max-w-[120px] truncate">Raja Ampat</td>
                            <td class="px-4 py-4 text-xs text-slate-400 italic">Pemantauan</td>
                            <td class="px-4 py-4">
                                <span class="px-2 py-1 text-[9px] font-bold uppercase bg-green-500/10 text-green-500 border border-green-500/20 rounded-md whitespace-nowrap">Terverifikasi</span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <a href="{{ route('pakar.detail', ['id' => 1]) }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-500 text-xs font-semibold text-white rounded-full transition-all shadow-lg shadow-blue-900/20">
                                    Detail
                                </a>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-700/30 transition-all duration-200">
                            <td class="px-4 py-4 text-center">
                                <input type="checkbox" class="childCheckbox w-4 h-4 rounded bg-slate-700 border-slate-600 text-[#7C3AED]">
                            </td>
                            <td class="px-4 py-4 text-sm font-medium text-white">Amba Tukam</td>
                            <td class="px-4 py-4 text-xs text-slate-400">07 Mei 2026</td>
                            <td class="px-4 py-4 text-sm text-slate-200">Hiu Paus</td>
                            <td class="px-4 py-4 text-sm text-slate-200">Bali</td>
                            <td class="px-4 py-4 text-xs text-slate-400 max-w-[120px] truncate">Pantai Sanur</td>
                            <td class="px-4 py-4 text-xs text-slate-400 italic">Pemantauan</td>
                            <td class="px-4 py-4">
                                <span class="px-2 py-1 text-[9px] font-bold uppercase bg-red-500/10 text-red-500 border border-red-500/20 rounded-md whitespace-nowrap">Ditolak</span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <a href="{{ route('pakar.detail', ['id' => 1]) }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-500 text-xs font-semibold text-white rounded-full transition-all shadow-lg shadow-blue-900/20">
                                    Detail
                                </a>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-700/30 transition-all duration-200">
                            <td class="px-4 py-4 text-center">
                                <input type="checkbox" class="childCheckbox w-4 h-4 rounded bg-slate-700 border-slate-600 text-[#7C3AED]">
                            </td>
                            <td class="px-4 py-4 text-sm font-medium text-white">Goblil Super</td>
                            <td class="px-4 py-4 text-xs text-slate-400">05 Mei 2026</td>
                            <td class="px-4 py-4 text-sm text-slate-200">Penyu Sisik</td>
                            <td class="px-4 py-4 text-sm text-slate-200">Banten</td>
                            <td class="px-4 py-4 text-xs text-slate-400 max-w-[120px] truncate">Ujung Kulon</td>
                            <td class="px-4 py-4 text-xs text-slate-400 italic">Pemantauan</td>
                            <td class="px-4 py-4">
                                <span class="px-2 py-1 text-[9px] font-bold uppercase bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded-md whitespace-nowrap">Sudah Diproses</span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <a href="{{ route('pakar.detail', ['id' => 1]) }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-500 text-xs font-semibold text-white rounded-full transition-all shadow-lg shadow-blue-900/20">
                                    Detail
                                </a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="px-6 py-5 bg-slate-800/20 border-t border-slate-700 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="text-xs sm:text-sm text-slate-400">
                    Showing <span class="text-white font-bold">1</span> to <span class="text-white font-bold">10</span> of <span class="text-white font-bold">50</span> entries
                </div>
                <div class="flex items-center gap-2">
                    <button class="p-2 bg-slate-700 hover:bg-slate-600 rounded-xl transition border border-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 19l-7-7 7-7" /></svg>
                    </button>
                    <button class="px-3.5 py-1.5 bg-[#7C3AED] text-white text-xs font-bold rounded-xl">1</button>
                    <button class="px-3.5 py-1.5 bg-slate-700 hover:bg-slate-600 text-white text-xs font-bold rounded-xl border border-slate-600">2</button>
                    <button class="p-2 bg-slate-700 hover:bg-slate-600 rounded-xl transition border border-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 5l7 7-7 7" /></svg>
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAll = document.getElementById('checkAll');
            const checkboxes = document.querySelectorAll('.childCheckbox');

            checkAll.addEventListener('change', function() {
                checkboxes.forEach(cb => {
                    cb.checked = checkAll.checked;
                });
            });
        });
    </script>
</body>
</html>