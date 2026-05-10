<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pakar - Sahabat Laut</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins..." rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #0F172A; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#0F172A] text-white overflow-x-hidden" x-data="{ notificationsOpen: false, selectAll: false }">

    <aside class="w-64 bg-[#0F172A] border-r border-slate-800 flex flex-col fixed h-full z-40">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-white tracking-tight">Sahabat Laut</h1>
        </div>

        <nav class="flex-1 px-4 space-y-2">
            <a href="/pakar/dashboard" class="flex items-center gap-3 bg-blue-600 text-white p-3 rounded-xl transition-all shadow-lg shadow-blue-900/20 group">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
                <span class="font-bold text-sm">Dashboard</span>
            </a>

            <a href="/pakar/validasi" class="flex items-center gap-3 text-slate-400 p-3 rounded-xl hover:bg-slate-800 hover:text-white transition-all group">
                <svg class="w-5 h-5 group-hover:text-blue-500 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m.75 2.25H6.75A2.25 2.25 0 0 1 4.5 18V6a2.25 2.25 0 0 1 2.25-2.25h10.5A2.25 2.25 0 0 1 19.5 6v12a2.25 2.25 0 0 1-2.25 2.25H13.5m-3-11.25h.008v.008H10.5V5.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                <span class="font-bold text-sm transition-colors">Validasi Laporan</span>
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800/50">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 text-red-500 hover:bg-red-500/10 rounded-xl transition font-bold text-sm group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-8">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-3xl font-bold text-white">Dashboard Utama</h2>
                <p class="text-slate-400">Statistik pantauan biota laut terkini.</p>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('pakar.profile') }}" class="flex items-center gap-3 bg-slate-800/40 p-1.5 pr-5 rounded-full border border-slate-700 hover:bg-slate-700/60 transition-all group">
                    <div class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center font-bold text-white shadow-lg shadow-blue-900/20 group-hover:scale-105 transition-transform">
                        P
                    </div>
                    <p class="text-white font-bold text-sm">Pakar Kelautan</p>
                </a>
                
                <div class="relative">
                    <button @click="notificationsOpen = !notificationsOpen" 
                            class="w-12 h-12 bg-[#131C31] border border-slate-700/40 rounded-2xl flex items-center justify-center text-blue-500 relative transition-all active:scale-95">
                        <i class="ph-bold ph-bell text-2xl"></i>
                        <span class="absolute top-3 right-3.5 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-[#131C31]"></span>
                    </button>

                    <div x-show="notificationsOpen" 
                        x-cloak
                        @click.away="notificationsOpen = false" 
                        class="absolute right-0 mt-4 w-72 bg-[#131C31] border border-slate-700/60 rounded-3xl shadow-2xl z-50 overflow-hidden">
                        <div class="p-5 border-b border-slate-800/60 font-bold text-xs uppercase tracking-widest text-slate-500">Notifikasi</div>
                        <div class="p-8 text-center text-slate-500 italic text-xs">Belum ada notifikasi baru</div>
                    </div>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-slate-800/40 p-6 rounded-3xl border border-slate-700">
                <div class="flex items-center gap-2 mb-4 text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span class="text-sm font-medium">Total Laporan</span>
                </div>
                <div class="flex items-end gap-3">
                    <h3 class="text-4xl font-bold">{{ $totalLaporan }}</h3>
                    <div class="flex items-center px-2 py-1 rounded-lg bg-green-400/10 mb-1">
                        <span class="text-xs font-bold text-green-400">28.4%</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-green-400 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                    </div>
                </div>
            </div>

            <div class="bg-slate-800/40 p-6 rounded-3xl border border-slate-700">
                <div class="flex items-center gap-2 mb-4 text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span class="text-sm font-medium">Menunggu Validasi</span>
                </div>
                <div class="flex items-end gap-3">
                    <h3 class="text-4xl font-bold">{{ $laporanMenunggu }}</h3>
                    <div class="flex items-center px-2 py-1 rounded-lg bg-green-400/10 mb-1">
                        <span class="text-xs font-bold text-green-400">12.5%</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-green-400 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                    </div>
                </div>
            </div>

            <div class="bg-slate-800/40 p-6 rounded-3xl border border-slate-700">
                <div class="flex items-center gap-2 mb-4 text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span class="text-sm font-medium">Laporan Disetujui</span>
                </div>
                <div class="flex items-end gap-3">
                    <h3 class="text-4xl font-bold">{{ $laporanDiproses }}</h3>
                    <div class="flex items-center px-2 py-1 rounded-lg bg-green-400/10 mb-1">
                        <span class="text-xs font-bold text-green-400">35.2%</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-green-400 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/40 p-8 rounded-3xl border border-slate-700 shadow-lg">
            <div class="flex justify-between items-center mb-6">
                <h4 class="text-xl font-bold text-white">Statistik Laporan Per Wilayah</h4>
            </div>
            <div class="h-[400px]">
                <canvas id="pakarChart"></canvas>
            </div>
        </div>
    </main>

    <script>
        const ctx = document.getElementById('pakarChart').getContext('2d');
        const purpleGradient = ctx.createLinearGradient(0, 0, 600, 0);
        purpleGradient.addColorStop(0, '#7C3AED');
        purpleGradient.addColorStop(1, '#C084FC');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    data: {!! json_encode($chartValues) !!},
                    backgroundColor: purpleGradient,
                    borderRadius: 6,
                    barThickness: 22,
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: { color: '#334155' },
                        ticks: { color: '#94A3B8' }
                    },
                    y: {
                        grid: { display: false },
                        ticks: { color: '#94A3B8' }
                    }
                }
            }
        });
    </script>
</body>
</html>