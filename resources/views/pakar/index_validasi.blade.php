<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Validasi - Sahabat Laut</title>
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
                <svg class="w-5 h-5 mr-3 text-slate-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/></svg>
                Dashboard
            </a>
            <a href="{{ route('pakar.validasi') }}" class="flex items-center px-4 py-3 bg-blue-600/10 text-blue-500 rounded-xl font-semibold border border-blue-500/20">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .415.162.798.425 1.081.263.283.646.445 1.075.445.429 0 .812-.162 1.075-.445.263-.283.425-.666.425-1.081 0-.231-.035-.454-.1-.664m-5.801 0A2.251 2.251 0 0 1 13.5 2.25c1.028 0 1.91.685 2.199 1.626M6.108 4.625a48.191 48.191 0 0 0-1.123.08C3.845 4.798 3 5.761 3 6.896v11.354A2.25 2.25 0 0 0 5.25 20.5h13.5"/></svg>
                Validasi Laporan
            </a>
        </nav>
        <div class="p-4 border-t border-slate-800">
            <button class="w-full flex items-center px-4 py-3 text-red-400 hover:bg-red-400/10 rounded-xl transition font-medium">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/></svg>
                Logout
            </button>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-8">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-3xl font-bold">Daftar Validasi</h2>
                <p class="text-slate-400 mt-1">Kelola dan verifikasi laporan biota laut terbaru.</p>
            </div>
            <div class="flex items-center gap-4 bg-slate-800/40 p-2 pr-6 rounded-full border border-slate-700">
                <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center font-bold">P</div>
                <div class="text-xs">
                    <p class="text-slate-500 font-bold uppercase tracking-tighter">Status: Pakar</p>
                    <p class="text-white font-bold">Pakar Kelautan</p>
                </div>
            </div>
        </header>

        <div class="bg-slate-800/30 rounded-[32px] border border-slate-700/50 shadow-2xl overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[10px] uppercase tracking-[0.2em] text-slate-500 border-b border-slate-700/50">
                        <th class="px-8 py-6"><input type="checkbox" id="selectAll" class="rounded bg-slate-900 border-slate-700 cursor-pointer"></th>
                        <th class="px-4 py-6">Nama</th>
                        <th class="px-4 py-6">Tanggal Lapor</th>
                        <th class="px-4 py-6">Spesies</th>
                        <th class="px-4 py-6">Provinsi</th>
                        <th class="px-4 py-6">Lokasi</th>
                        <th class="px-4 py-6">Aktivitas</th>
                        <th class="px-4 py-6 text-center">Status</th>
                        <th class="px-8 py-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-slate-300">
                    @php
                        $reports = [
                            1 => ['n' => 'Gatot Doer', 'd' => '10 Mei 2026', 's' => 'Penyu Hijau', 'p' => 'Jawa Barat', 'l' => 'Pangandaran', 'a' => 'Pemantauan', 'st' => 'Menunggu Verifikasi', 'c' => 'yellow'],
                            2 => ['n' => 'Rusdi Got', 'd' => '08 Mei 2026', 's' => 'Dugong', 'p' => 'Papua Barat', 'l' => 'Raja Ampat', 'a' => 'Pemantauan', 'st' => 'Terverifikasi', 'c' => 'green'],
                            3 => ['n' => 'Amba Tukam', 'd' => '07 Mei 2026', 's' => 'Hiu Paus', 'p' => 'Bali', 'l' => 'Pantai Sanur', 'a' => 'Pemantauan', 'st' => 'Ditolak', 'c' => 'red'],
                            4 => ['n' => 'Goblil Super', 'd' => '05 Mei 2026', 's' => 'Penyu Sisik', 'p' => 'Banten', 'l' => 'Ujung Kulon', 'a' => 'Pemantauan', 'st' => 'Sudah Diproses', 'c' => 'blue'],
                        ];
                    @endphp

                    @foreach($reports as $id => $report)
                    <tr class="border-b border-slate-700/30 hover:bg-slate-700/20 transition-colors">
                        <td class="px-8 py-5"><input type="checkbox" class="report-checkbox rounded bg-slate-900 border-slate-700 cursor-pointer"></td>
                        <td class="px-4 py-5 font-semibold text-white">{{ $report['n'] }}</td>
                        <td class="px-4 py-5 whitespace-nowrap">{{ $report['d'] }}</td>
                        <td class="px-4 py-5 italic">{{ $report['s'] }}</td>
                        <td class="px-4 py-5">{{ $report['p'] }}</td>
                        <td class="px-4 py-5">{{ $report['l'] }}</td>
                        <td class="px-4 py-5 italic">{{ $report['a'] }}</td>
                        <td class="px-4 py-5 text-center">
                            <span class="px-3 py-1 text-[9px] font-bold uppercase bg-{{$report['c']}}-500/10 text-{{$report['c']}}-500 border border-{{$report['c']}}-500/20 rounded-lg whitespace-nowrap">
                                {{ $report['st'] }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <a href="{{ route('pakar.detail', $id) }}" class="inline-block py-2 px-6 bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold rounded-full transition-all shadow-lg shadow-blue-900/20">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="px-8 py-6 bg-slate-900/50 flex justify-between items-center text-xs text-slate-500">
                <p>Showing 1 to 4 of 50 entries</p>
                <div class="flex gap-2 relative z-30">
                    <a href="{{ route('pakar.validasi') }}" class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center font-bold shadow-lg shadow-blue-900/40">1</a>
                    <a href="#" class="w-8 h-8 rounded-lg border border-slate-700 flex items-center justify-center hover:bg-slate-800">2</a>
                    <a href="#" class="w-8 h-8 rounded-lg border border-slate-700 flex items-center justify-center hover:bg-slate-800">▶</a>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.report-checkbox');
            if (selectAll) {
                selectAll.addEventListener('change', () => {
                    checkboxes.forEach(c => c.checked = selectAll.checked);
                });
            }
        });
    </script>
</body>
</html>