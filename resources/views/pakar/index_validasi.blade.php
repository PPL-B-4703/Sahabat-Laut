<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Laporan - Sahabat Laut</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #0F172A; }
        .sidebar-fixed { width: 256px; } 
        .main-content { 
            margin-left: 256px; 
            padding: 40px 24px 40px 0px; 
            width: calc(100vw - 256px);
        }
        .content-container { padding-left: 48px; width: 100%; }
        .table-card {
            background-color: #131C31;
            border-radius: 40px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            margin-left: 48px;
            width: calc(100% - 48px);
        }
        .font-dashboard-bold { font-weight: 800 !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-[#0F172A] text-white overflow-x-hidden" x-data="{ notificationsOpen: false, selectAll: false }">

    <aside class="sidebar-fixed bg-[#0F172A] border-r border-slate-800/60 flex flex-col fixed h-full z-40">
        <div class="p-8 mb-4">
            <h1 class="text-2xl font-extrabold text-white tracking-tight">Sahabat Laut</h1>
        </div>
        
        <nav class="flex-1 px-6 space-y-2">
            <a href="/pakar/dashboard" class="flex items-center gap-4 text-slate-400 p-4 rounded-2xl hover:bg-slate-800/40 transition-all group">
                <i class="ph-bold ph-squares-four text-xl group-hover:text-blue-500"></i>
                <span class="font-bold text-sm">Dashboard</span>
            </a>
            <a href="/pakar/validasi" class="flex items-center gap-4 bg-blue-600 text-white p-4 rounded-2xl shadow-lg shadow-blue-900/20">
                <i class="ph-bold ph-article text-xl"></i>
                <span class="font-bold text-sm">Validasi Laporan</span>
            </a>
        </nav>

        <div class="p-8 border-t border-slate-800/60">
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

    <main class="main-content">
        <div class="content-container">
            <header class="flex justify-between items-center mb-10 pr-6">
                <div>
                    <h2 class="text-[32px] font-dashboard-bold text-white tracking-tight">Daftar Validasi</h2>
                    <p class="text-slate-400 text-base font-bold mt-1">Kelola laporan biota laut terbaru.</p>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('pakar.profile') }}" class="flex items-center gap-3 bg-slate-800/40 p-1.5 pr-5 rounded-full border border-slate-700 hover:bg-slate-700/60 transition-all group">
                        <div class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center font-bold text-white shadow-lg shadow-blue-900/20 group-hover:scale-105 transition-transform">
                            P
                        </div>
                        <p class="text-white font-bold text-sm">Pakar Kelautan</p>
                    </a>
                    
                    <div class="relative">
                        <button @click="notificationsOpen = !notificationsOpen" class="w-12 h-12 bg-[#131C31] border border-slate-700/40 rounded-2xl flex items-center justify-center text-blue-500 relative transition-all active:scale-95">
                            <i class="ph-bold ph-bell text-2xl"></i>
                            <span class="absolute top-3 right-3.5 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-[#131C31]"></span>
                        </button>

                        <div x-show="notificationsOpen" @click.away="notificationsOpen = false" 
                             class="absolute right-0 mt-4 w-72 bg-[#131C31] border border-slate-700/60 rounded-3xl shadow-2xl z-50 overflow-hidden">
                            <div class="p-5 border-b border-slate-800/60 font-bold text-xs uppercase tracking-widest text-slate-500">Notifikasi</div>
                            <div class="p-8 text-center text-slate-500 italic text-xs">Belum ada notifikasi baru</div>
                        </div>
                    </div>
                </div>
            </header>
        </div>

        <div class="table-card shadow-2xl mr-6">
            <div class="w-full overflow-x-auto no-scrollbar">
                <table class="w-full text-left table-auto">
                    <thead class="text-xs text-gray-400 uppercase bg-[#0B1221] border-b border-gray-700">
                        <tr>
                            <th scope="col" class="p-4">
                                <div class="flex items-center">
                                    <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-600 focus:ring-2">
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 font-semibold">NAMA</th>
                            <th scope="col" class="px-6 py-4 font-semibold">TANGGAL LAPOR</th>
                            <th scope="col" class="px-6 py-4 font-semibold">SPESIES</th>
                            <th scope="col" class="px-6 py-4 font-semibold">PROVINSI</th>
                            <th scope="col" class="px-6 py-4 font-semibold">LOKASI</th>
                            <th scope="col" class="px-6 py-4 font-semibold text-center">AKTIVITAS</th> <th scope="col" class="px-6 py-4 font-semibold text-center">STATUS</th>
                            <th scope="col" class="px-6 py-4 font-semibold text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="text-[13px] font-bold">
                        @foreach($reports as $report)
                        @php
                            $alamatArray = explode(', Provinsi ', $report->alamat_lokasi);
                            $lokasi = $alamatArray[0] ?? $report->alamat_lokasi;
                            $provinsi = $alamatArray[1] ?? '-';
                        @endphp
                        <tr class="border-b border-slate-800/30 hover:bg-slate-800/20 transition-all">
                            <td class="pl-10 py-6">
                                <input type="checkbox" :checked="selectAll" class="rounded bg-slate-900 border-slate-700">
                            </td>
                            <td class="px-3 py-6 text-white whitespace-nowrap">{{ $report->user->first_name ?? 'Anonim' }}</td>
                            
                            <td class="px-3 py-6 text-slate-400 whitespace-nowrap">{{ \Carbon\Carbon::parse($report->tanggal_temuan)->format('d F, Y') }}</td>
                            
                            <td class="px-3 py-6 italic text-slate-300 whitespace-nowrap">{{ $report->species }}</td>
                            
                            <td class="px-3 py-6 text-slate-400 whitespace-nowrap">{{ $provinsi }}</td>
                            
                            <td class="px-3 py-6 text-slate-400 leading-tight">{{ Str::limit($lokasi, 45) }}</td>
                            
                            <td class="px-3 py-6 text-slate-400 whitespace-nowrap text-center">{{ $report->aktivitas }}</td>
                            
                            <td class="px-3 py-6 text-center">
                                @php
                                    $style = match($report->status) {
                                        'Terverifikasi' => 'bg-green-500/10 text-green-500 border-green-500/20',
                                        'Ditolak' => 'bg-red-500/10 text-red-500 border-red-500/20',
                                        default => 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20' // Untuk 'Menunggu Verifikasi'
                                    };
                                @endphp
                                <span class="px-3 py-1.5 text-[10px] font-extrabold uppercase border rounded-xl {{ $style }}">
                                    {{ $report->status }}
                                </span>
                            </td>
                            <td class="pr-10 py-6 text-right">
                                <a href="{{ route('pakar.validasi.show', $report->id) }}" class="inline-block py-2 px-5 bg-blue-600 text-white text-[10px] font-extrabold rounded-xl shadow-lg hover:bg-blue-500 transition-all">DETAIL</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-10 py-8 bg-[#0F172A]/30 flex justify-between items-center border-t border-slate-800/50">
                <p class="text-[12px] text-slate-500 font-bold uppercase tracking-widest">
                    Showing <span class="text-white">{{ $reports->firstItem() }}</span> to <span class="text-white">{{ $reports->lastItem() }}</span> of <span class="text-white">{{ $reports->total() }}</span> entries
                </p>
                
                <div class="flex items-center gap-2">
                    <a href="{{ $reports->previousPageUrl() }}" class="w-10 h-10 rounded-xl border border-slate-700/50 flex items-center justify-center text-slate-400 {{ $reports->onFirstPage() ? 'opacity-20 pointer-events-none' : 'hover:bg-slate-800' }}">
                        <i class="ph-bold ph-caret-left"></i>
                    </a>

                    @foreach ($reports->getUrlRange(1, $reports->lastPage()) as $page => $url)
                        <a href="{{ $url }}" class="w-10 h-10 rounded-xl flex items-center justify-center text-[11px] font-extrabold transition-all {{ $page == $reports->currentPage() ? 'bg-blue-600 text-white shadow-xl' : 'border border-slate-700/50 text-slate-500 hover:bg-slate-800' }}">
                            {{ $page }}
                        </a>
                    @endforeach

                    <a href="{{ $reports->nextPageUrl() }}" class="w-10 h-10 rounded-xl border border-slate-700/50 flex items-center justify-center text-slate-400 {{ !$reports->hasMorePages() ? 'opacity-20 pointer-events-none' : 'hover:bg-slate-800' }}">
                        <i class="ph-bold ph-caret-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>