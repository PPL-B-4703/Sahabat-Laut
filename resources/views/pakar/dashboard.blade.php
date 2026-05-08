<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pakar - Sahabat Laut</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #0F172A; }
    </style>
</head>
<body class="min-h-screen flex text-white">

    <aside class="w-64 bg-[#0F172A] border-r border-slate-800 flex flex-col fixed h-full">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-white tracking-tight">Sahabat Laut</h1>
        </div>
        <nav class="flex-1 px-4 space-y-2">
            <a href="#" class="flex items-center px-4 py-3 bg-blue-600/10 text-blue-500 rounded-xl font-semibold border border-blue-500/20">
                <span class="mr-3">📊</span> Dashboard
            </a>
            <a href="{{ route('pakar.validasi') }}" class="flex items-center px-4 py-3 text-slate-400 hover:bg-slate-800 hover:text-white rounded-xl transition">
                <span class="mr-3">📋</span> Validasi Laporan
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 text-red-400 hover:bg-red-400/10 rounded-xl transition font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
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
            
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-3 bg-slate-800/50 p-2 pr-4 rounded-2xl border border-slate-700">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">P</div>
                    <span class="text-sm font-medium text-slate-200">Pakar Kelautan</span>
                </div>
                <button class="relative p-2.5 bg-slate-800/50 rounded-xl border border-slate-700 text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z" /></svg>
                    <span class="absolute top-2 right-2.5 block h-2.5 w-2.5 rounded-full bg-red-500 border-2 border-[#0F172A]"></span>
                </button>
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
                    <h3 class="text-4xl font-bold">128</h3>
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
                    <h3 class="text-4xl font-bold">14</h3>
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
                    <h3 class="text-4xl font-bold">114</h3>
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
                labels: ['Bali', 'Papua Barat', 'Sulawesi Utara', 'NTT', 'Merauke', 'Jawa Timur', 'Jawa Barat', 'Maluku'],
                datasets: [{
                    data: [180, 145, 120, 95, 80, 75, 60, 50],
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