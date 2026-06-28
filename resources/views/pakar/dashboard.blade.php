<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pakar - Sahabat Laut</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

    <aside class="fixed inset-y-0 left-0 w-64 bg-[#0B1221] border-r border-slate-800/50 flex flex-col z-50">
        <div class="px-8 py-8">
            <h1 class="text-2xl font-black text-white tracking-tight">
                Sahabat <span class="text-blue-500">Laut</span>
            </h1>
        </div>

        <nav class="flex-1 px-4 space-y-2 mt-2">
            <a href="{{ route('pakar.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-xl {{ request()->routeIs('pakar.dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }} transition-all">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>

            <a href="{{ route('pakar.validasi') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-xl {{ request()->routeIs('pakar.validasi') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }} transition-all">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Validasi Laporan
            </a>
            
            <a href="{{ route('pakar.biota.index') }}"
            class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-xl {{ request()->routeIs('pakar.biota.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }} transition-all">

                <svg class="w-5 h-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 11H5m14-6H5m14 12H5m14 6H5"/>
                </svg>

                Kelola Katalog
            </a>

        </nav>

        
        <div class="px-4 pb-8 flex flex-col gap-2">
            <a href="{{ url('/') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-400 hover:text-white hover:bg-slate-800/50 rounded-xl transition-all w-full">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Beranda
            </a>

            <form action="{{ route('logout') }}" method="POST" class="w-full m-0 p-0">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-bold text-red-500 hover:text-red-400 hover:bg-red-500/10 rounded-xl transition-all text-left bg-transparent border-none">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-8">
        <header class="flex justify-between items-center mb-10 pr-6">
            <div class="flex-1 flex items-center justify-between mr-8 lg:mr-16">
                <div>
                    <h2 class="text-3xl font-bold text-white">Dashboard Utama</h2>
                    <p class="text-slate-400">Statistik pantauan biota laut terkini.</p>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('pakar.profile') }}" class="flex items-center gap-3 bg-slate-800/40 p-1.5 pr-5 rounded-full border border-slate-700 hover:bg-slate-700/60 transition-all group">
                    <div class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center font-bold text-white shadow-lg shadow-blue-900/20 group-hover:scale-105 transition-transform">
                        {{ strtoupper(substr(auth()->user()->first_name ?? 'P', 0, 1)) }}
                    </div>
                    <p class="text-white font-bold text-sm">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                </a>
                
                <!-- INTEGRASI NOTIFIKASI PAKAR -->
                <div class="relative">
                    <button @click="notificationsOpen = !notificationsOpen" 
                            class="w-12 h-12 bg-[#131C31] border border-slate-700/40 rounded-2xl flex items-center justify-center text-blue-500 relative transition-all active:scale-95">
                        <i class="ph-bold ph-bell text-2xl"></i>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute top-3 right-3.5 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-[#131C31] animate-pulse"></span>
                        @endif
                    </button>

                    <div x-show="notificationsOpen" 
                        x-cloak
                        @click.away="notificationsOpen = false" 
                        class="absolute right-0 mt-4 w-80 bg-[#131C31] border border-slate-700/60 rounded-3xl shadow-2xl z-50 overflow-hidden text-sm">
                        <div class="p-5 border-b border-slate-800/60 font-bold text-xs uppercase tracking-widest text-slate-400 flex justify-between items-center">
                            <span>Notifikasi Masuk</span>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="bg-blue-500/20 text-blue-400 px-2 py-0.5 rounded-full text-[10px]">
                                    {{ auth()->user()->unreadNotifications->count() }} Baru
                                </span>
                            @endif
                        </div>
                        <div class="max-h-72 overflow-y-auto">
                            @forelse(auth()->user()->unreadNotifications as $notification)
                                <!-- SINKRONISASI ROUTE: Menggunakan pakar.validasi.show sesuai web.php kamu -->
                                <a href="{{ route('pakar.validasi.show', $notification->data['laporan_id'] ?? 1) }}" class="block p-4 border-b border-slate-800/40 hover:bg-slate-800/30 transition-all">
                                    <p class="text-xs font-bold text-blue-400 mb-1">{{ $notification->data['title'] }}</p>
                                    <p class="text-xs text-slate-300 leading-relaxed">{{ $notification->data['message'] }}</p>
                                    <span class="text-[10px] text-slate-500 block mt-2">{{ $notification->created_at->diffForHumans() }}</span>
                                </a>
                            @empty
                                <div class="p-8 text-center text-slate-500 italic text-xs">Belum ada notifikasi baru</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-slate-800/40 p-6 rounded-3xl border border-slate-700">
                <div class="flex items-center gap-2 mb-4 text-slate-400">
                    <i class="ph-bold ph-files text-blue-500 text-lg"></i>
                    <span class="text-sm font-medium">Total Laporan</span>
                </div>
                <div class="flex items-end gap-3">
                    <!-- PERBAIKAN EROR: Menambahkan operator fallback ?? 0 agar tidak crash -->
                    <h3 class="text-4xl font-bold">{{ $totalLaporan ?? 0 }}</h3>
                    <div class="flex items-center px-2 py-1 rounded-lg bg-green-400/10 mb-1">
                        <span class="text-xs font-bold text-green-400">28.4%</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-green-400 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                    </div>
                </div>
            </div>

            <div class="bg-slate-800/40 p-6 rounded-3xl border border-slate-700">
                <div class="flex items-center gap-2 mb-4 text-slate-400">
                    <i class="ph-bold ph-clock text-yellow-500 text-lg"></i>
                    <span class="text-sm font-medium">Menunggu Validasi</span>
                </div>
                <div class="flex items-end gap-3">
                    <!-- PERBAIKAN EROR: Fallback ?? 0 -->
                    <h3 class="text-4xl font-bold">{{ $laporanMenunggu ?? 0 }}</h3>
                    <div class="flex items-center px-2 py-1 rounded-lg bg-green-400/10 mb-1">
                        <span class="text-xs font-bold text-green-400">12.5%</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-green-400 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                    </div>
                </div>
            </div>

            <div class="bg-slate-800/40 p-6 rounded-3xl border border-slate-700">
                <div class="flex items-center gap-2 mb-4 text-slate-400">
                    <i class="ph-bold ph-check-circle text-green-500 text-lg"></i>
                    <span class="text-sm font-medium">Laporan Selesai</span>
                </div>
                <div class="flex items-end gap-3">
                    <!-- PERBAIKAN UTAMA: Mengamankan variabel agar tidak memicu eror Undefined -->
                    <h3 class="text-4xl font-bold">{{ $laporanSelesai ?? 0 }}</h3>
                    <div class="flex items-center px-2 py-1 rounded-lg bg-green-400/10 mb-1">
                        <span class="text-xs font-bold text-green-400">35.2%</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-green-400 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/40 p-8 rounded-3xl border border-slate-700 shadow-lg">
            <div class="flex justify-between items-center mb-6">
                <h4 class="text-xl font-bold text-white">Laporan Per Provinsi</h4>
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
                // PERBAIKAN EROR: Memberikan array kosong bawaan [] jika data grafik belum di-passing oleh controller
                labels: {!! json_encode($chartLabels ?? ['Belum Ada Data']) !!},
                datasets: [{
                    data: {!! json_encode($chartValues ?? [0]) !!},
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