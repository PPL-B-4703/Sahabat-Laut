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
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#0F172A] text-white overflow-x-hidden">

    <aside class="sidebar-fixed bg-[#0F172A] border-r border-slate-800/60 flex flex-col fixed h-full z-40">
        <div class="p-8 mb-4">
            <h1 class="text-2xl font-extrabold text-white tracking-tight">Sahabat Laut</h1>
        </div>
        
        <nav class="flex-1 px-6 space-y-2">
            <a href="{{ route('pakar.dashboard') }}" class="flex items-center gap-4 text-slate-400 p-4 rounded-2xl hover:bg-slate-800/40 transition-all group">
                <i class="ph-bold ph-squares-four text-xl group-hover:text-blue-500"></i>
                <span class="font-bold text-sm">Dashboard</span>
            </a>
            <a href="{{ route('pakar.validasi') }}" class="flex items-center gap-4 bg-blue-600 text-white p-4 rounded-2xl shadow-lg shadow-blue-900/20">
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
                <div class="flex-1 flex items-center justify-between mr-8 lg:mr-16">
                    <div>
                        <h2 class="text-[32px] font-bold text-white tracking-tight">Daftar Validasi</h2>
                        <p class="text-slate-400 text-base font-bold mt-1">Kelola laporan biota laut terbaru.</p>
                    </div>
                    <button type="button" onclick="validasiEkspor()" class="shrink-0 bg-[#131C31] text-blue-500 border border-blue-500/50 hover:bg-blue-600 hover:text-white font-bold py-2.5 px-5 rounded-xl flex items-center gap-2 transition-all text-sm shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Ekspor Laporan
                    </button>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('pakar.profile') }}" class="flex items-center gap-3 bg-slate-800/40 p-1.5 pr-5 rounded-full border border-slate-700 hover:bg-slate-700/60 transition-all group">
                        <div class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center font-bold text-white shadow-lg shadow-blue-900/20 group-hover:scale-105 transition-transform uppercase">
                            {{ substr(auth()->user()->first_name, 0, 1) }}
                        </div>
                        <p class="text-white font-bold text-sm">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                    </a>
                    
                    <!-- INTEGRASI NOTIFIKASI DENGAN RESET BUBBLE -->
                    <div class="relative" 
                         x-data="{ 
                            notificationsOpen: false, 
                            count: {{ auth()->check() ? auth()->user()->unreadNotifications->count() : 0 }},
                            markAsRead() {
                                this.notificationsOpen = !this.notificationsOpen;
                                if (this.notificationsOpen && this.count > 0) {
                                    this.count = 0;
                                    fetch('{{ route("notifications.markAsRead") }}', {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Content-Type': 'application/json'
                                        }
                                    }).catch(err => console.error(err));
                                }
                            }
                         }">
                        <button @click="markAsRead()" class="w-12 h-12 bg-[#131C31] border border-slate-700/40 rounded-2xl flex items-center justify-center text-blue-500 relative transition-all active:scale-95">
                            <i class="ph-bold ph-bell text-2xl"></i>
                            <template x-if="count > 0">
                                <span class="absolute top-3 right-3.5 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-[#131C31] animate-pulse"></span>
                            </template>
                        </button>

                        <div x-show="notificationsOpen" x-cloak @click.away="notificationsOpen = false" 
                             class="absolute right-0 mt-4 w-80 bg-[#131C31] border border-slate-700/60 rounded-3xl shadow-2xl z-50 overflow-hidden text-sm">
                            <div class="p-5 border-b border-slate-800/60 font-bold text-xs uppercase tracking-widest text-slate-500 flex justify-between items-center">
                                <span>Notifikasi</span>
                                <template x-if="count > 0">
                                    <span class="bg-blue-500/20 text-blue-400 px-2 py-0.5 rounded-full text-[10px]" x-text="count + ' Baru'"></span>
                                </template>
                            </div>
                            <div class="max-h-72 overflow-y-auto">
                                @forelse(auth()->user()->unreadNotifications as $notification)
                                    <a href="{{ route('pakar.validasi.show', $notification->data['laporan_id'] ?? 1) }}" class="block p-4 border-b border-slate-800/40 hover:bg-slate-800/30 transition-all text-left">
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
        </div>

        <div class="table-card shadow-2xl mr-6">
            <div class="w-full overflow-x-auto no-scrollbar">
                <form id="formEksporLaporan" action="{{ route('pakar.export.laporan') }}" method="GET">
                    <table class="w-full text-left table-auto">
                        <thead class="text-xs text-gray-400 uppercase bg-[#0B1221] border-b border-gray-700">
                            <tr>
                                <th scope="col" class="px-4 py-4">
                                    <div class="flex items-center">
                                        <input type="checkbox" onclick="toggleSemua(this)" class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-600 focus:ring-2">
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-4 font-semibold text-left">NAMA</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-left">TANGGAL LAPOR</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-center">SPESIES</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-center">PROVINSI</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-center">LOKASI</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-center">AKTIVITAS</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-center">STATUS</th>
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
                                <td class="px-4 py-6">
                                    <div class="flex items-center">
                                        <input type="checkbox" name="ids[]" value="{{ $report->id }}" class="ceklis-laporan w-4 h-4 text-blue-600 rounded bg-slate-900 border-slate-700">
                                    </div>
                                </td>
                                
                                <td class="px-6 py-6 text-white whitespace-nowrap text-left">{{ $report->user->first_name ?? 'Anonim' }}</td>
                                
                                <td class="px-6 py-6 text-slate-400 whitespace-nowrap text-left">{{ \Carbon\Carbon::parse($report->tanggal_temuan)->format('d F, Y') }}</td>
                                
                                <td class="px-6 py-6 italic text-slate-300 whitespace-nowrap text-center">{{ $report->species }}</td>
                                
                                <td class="px-6 py-6 text-slate-400 whitespace-nowrap text-center">{{ $provinsi }}</td>
                                
                                <td class="px-6 py-6 text-slate-400 leading-tight text-center">{{ Str::limit($lokasi, 45) }}</td>
                                
                                <td class="px-6 py-6 text-slate-400 whitespace-nowrap text-center">{{ $report->aktivitas }}</td>
                                
                                <td class="px-6 py-6 text-center">
                                    @php
                                        $style = match($report->status) {
                                            'Terverifikasi' => 'bg-green-500/10 text-green-500 border-green-500/20',
                                            'Ditolak' => 'bg-red-500/10 text-red-500 border-red-500/20',
                                            default => 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20'
                                        };
                                    @endphp
                                    <span class="whitespace-nowrap px-3 py-1.5 text-[10px] font-extrabold uppercase border rounded-xl {{ $style }}">
                                        {{ $report->status }}
                                    </span>
                                </td>
                                
                                <td class="px-6 py-6 text-center">
                                    <a href="{{ route('pakar.validasi.show', $report->id) }}" class="inline-block py-2 px-5 bg-blue-600 text-white text-[10px] font-extrabold rounded-xl shadow-lg hover:bg-blue-500 transition-all">DETAIL</a>
                                </td>
                            </tr>
                            @endforeach
                            <script>
                                function toggleSemua(source) {
                                    let checkboxes = document.querySelectorAll('.ceklis-laporan');
                                    checkboxes.forEach(cb => {
                                        cb.checked = source.checked;
                                    });
                                }

                                function validasiEkspor() {
                                    let ygDiceklis = document.querySelectorAll('.ceklis-laporan:checked');
                                    
                                    if(ygDiceklis.length === 0) {
                                        window.dispatchEvent(new CustomEvent('tampil-peringatan'));
                                        return;
                                    }
                                    
                                    document.getElementById('formEksporLaporan').submit();
                                }
                            </script>
                        </tbody>
                    </table>
                </form>
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
        <div x-data="{ openAlert: false }" 
            @tampil-peringatan.window="openAlert = true" 
            x-show="openAlert" 
            style="display: none;" 
            class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm transition-opacity">
            
            <div @click.away="openAlert = false" 
                class="bg-[#131C31] border border-slate-700/50 rounded-3xl p-6 w-[320px] shadow-2xl text-center transform scale-100 transition-all">
                
                <div class="mx-auto w-16 h-16 bg-red-500/10 text-red-500 rounded-full flex items-center justify-center mb-4 border border-red-500/20">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                
                <h3 class="text-white font-bold text-lg mb-2">Peringatan</h3>
                <p class="text-slate-400 text-sm mb-6 leading-relaxed">Harap pilih (ceklis) minimal satu laporan terlebih dahulu untuk diekspor.</p>
                
                <button @click="openAlert = false" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-4 rounded-xl transition-all shadow-lg shadow-blue-900/20">
                    OK, Mengerti
                </button>
            </div>
        </div>
</body>
</html>