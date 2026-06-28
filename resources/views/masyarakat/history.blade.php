<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Laporan - Sahabat Laut</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            /* BACKGROUND SAMA DENGAN DASHBOARD */
            background-image: url("{{ asset('images/bg-dashboard.jpg') }}");
            background-size: cover; 
            background-position: center; 
            background-attachment: fixed;
            margin: 0; 
            padding: 0;
            background-color: #004d6b; 
        }
        .glass-text { color: white; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4); }
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
        }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); }
        header { transform: translateZ(0); -webkit-transform: translateZ(0); }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="overflow-x-hidden min-h-screen">

    @if(session('success'))
        <script>Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", timer: 3000, showConfirmButton: false, background: '#004d6b', color: '#fff' });</script>
    @endif

    <div class="relative w-full min-h-screen" 
         x-data="{ 
            search: '',
            laporans: @js($laporans),
            get filteredLaporans() {
                if (!this.search) return this.laporans;
                let s = this.search.toLowerCase();
                return this.laporans.filter(l => 
                    (l.species && l.species.toLowerCase().includes(s)) ||
                    (l.alamat_lokasi && l.alamat_lokasi.toLowerCase().includes(s)) ||
                    (l.aktivitas && l.aktivitas.toLowerCase().includes(s)) ||
                    (l.status && l.status.toLowerCase().includes(s))
                );
            }
         }">
        
        <header class="fixed top-0 left-0 w-full h-[100px] flex items-center justify-between px-12 z-[100] bg-transparent">
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/logo.png') }}" class="w-12 h-12 object-contain mix-blend-multiply" alt="Logo">
                <h1 class="font-['Work_Sans'] font-semibold text-white text-3xl tracking-tight glass-text">Sahabat Laut</h1>
            </div>

            <div class="flex items-center gap-4">
                
                <div class="relative" 
                     x-data="{ 
                        openNotif: false,
                        count: {{ auth()->check() ? auth()->user()->unreadNotifications->count() : 0 }},
                        markAsRead() {
                            this.openNotif = !this.openNotif;
                            if (this.openNotif && this.count > 0) {
                                this.count = 0; // Reset bubble count secara instan di frontend
                                fetch('{{ route('notifications.markAsRead') }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    }
                                }).catch(err => console.error('Gagal memperbarui status notifikasi:', err));
                            }
                        }
                     }">
                    <button @click="markAsRead()" class="relative p-2 text-white bg-white/10 border border-white/20 rounded-full hover:bg-white/20 transition-all focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        
                        <template x-if="count > 0">
                            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full animate-bounce" x-text="count">
                            </span>
                        </template>
                    </button>

                    <div x-show="openNotif" @click.away="openNotif = false" x-transition x-cloak
                         class="absolute right-0 mt-3 w-80 bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 z-[110]">
                        <div class="px-4 py-3 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                            <span class="font-bold text-gray-800 text-sm">Notifikasi Terbaru</span>
                        </div>
                        <div class="max-h-64 overflow-y-auto">
                            @forelse(auth()->user()->unreadNotifications as $notification)
                                <a href="{{ route('laporan.show', $notification->data['laporan_id'] ?? 1) }}" class="block px-4 py-3 hover:bg-blue-50/50 border-b border-gray-50 transition-all">
                                    <p class="text-xs font-bold text-blue-600 mb-0.5">{{ $notification->data['title'] }}</p>
                                    <p class="text-xs text-gray-600 leading-relaxed">{{ $notification->data['message'] }}</p>
                                    <span class="text-[10px] text-gray-400 block mt-1">{{ $notification->created_at->diffForHumans() }}</span>
                                </a>
                            @empty
                                <div class="px-4 py-8 text-center text-gray-400 text-xs italic">
                                    Tidak ada pemberitahuan baru.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <a href="{{ route('masyarakat.profil.edit') }}" class="flex items-center gap-3 glass-card hover:bg-white/20 transition-all p-1 pr-4 rounded-full cursor-pointer">
                    <div class="w-10 h-10 rounded-full border-2 border-white bg-white overflow-hidden shadow-lg">
                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->first_name . ' ' . $user->last_name).'&background=random' }}" alt="Profile" class="w-full h-full object-cover">
                    </div>
                    <span class="font-semibold text-white text-sm glass-text">{{ $user->first_name }} {{ $user->last_name }}</span>
                </a>
            </div>
        </header>
        

        <div class="flex items-start pt-[120px] px-10 pb-10 gap-8 min-h-screen">
            
            <aside class="w-72 h-fit sticky top-[120px] rounded-[32px] overflow-hidden glass-card p-8 flex flex-col z-20 text-white">
                <nav class="flex flex-col gap-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-4 text-white/70 hover:text-white transition-all group">
                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('laporan.create') }}" class="flex items-center gap-4 text-white/70 hover:text-white transition-all group">
                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                        <span>Kirim Laporan</span>
                    </a>
                    <a href="{{ route('laporan.history') }}" class="flex items-center gap-4 text-white font-bold transition-all underline underline-offset-8 decoration-2 drop-shadow-md">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        <span class="glass-text">History Laporan</span>
                    </a>
                </nav>

                <form action="{{ route('logout') }}" method="POST" class="mt-12 pt-6 border-t border-white/20">
                    @csrf
                    <button type="submit" class="flex items-center gap-4 text-white/70 hover:text-red-400 w-full transition-all group">
                        <svg class="w-6 h-6 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span>Logout</span>
                    </button>
                </form>
            </aside>

            <main class="flex-1 flex flex-col gap-6 min-w-0">
                
                <div class="flex justify-between items-end mb-2">
                    <h2 class="text-3xl font-bold text-white glass-text tracking-wide">Riwayat Laporan</h2>
                    
                    <div class="relative w-80">
                        <input type="text" x-model="search" placeholder="Cari laporan..." 
                               class="w-full bg-white/10 border border-white/20 rounded-full py-3 pl-12 pr-4 text-white placeholder-white/50 focus:outline-none focus:border-white/50 focus:bg-white/20 backdrop-blur-md transition-all font-['Work_Sans']">
                        <svg class="w-5 h-5 absolute left-4 top-3.5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <div class="glass-card flex-1 overflow-hidden flex flex-col rounded-[24px]">
                    <div class="overflow-x-auto custom-scrollbar">
                        <table class="w-full text-left">
                            <thead class="bg-white/10 border-b border-white/20">
                                <tr class="text-[11px] uppercase tracking-widest text-white/80 font-bold font-['Work_Sans']">
                                    <th class="px-6 py-5">Spesies</th>
                                    <th class="px-6 py-5">Lokasi / Provinsi</th>
                                    <th class="px-6 py-5">Aktivitas</th>
                                    <th class="px-6 py-5">Tanggal Temuan</th>
                                    <th class="px-6 py-5 text-center">Status Laporan</th>
                                    <th class="px-6 py-5 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10 bg-transparent">
                                <template x-for="(laporan, index) in filteredLaporans" :key="index">
                                    <tr class="hover:bg-white/10 transition-all cursor-default">
                                        <td class="px-6 py-5 font-bold text-white text-base capitalize drop-shadow-sm" x-text="laporan.species"></td>
                                        <td class="px-6 py-5 text-sm text-white/80 font-medium" x-text="laporan.alamat_lokasi"></td>
                                        <td class="px-6 py-5 text-sm text-white/80" x-text="laporan.aktivitas"></td>
                                        <td class="px-6 py-5 text-sm text-white/70 font-['Work_Sans']" 
                                            x-text="new Date(laporan.tanggal_temuan).toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'})"></td>
                                        
                                        <td class="px-6 py-5 text-center">
                                            <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider border inline-block backdrop-blur-sm"
                                                  :class="{
                                                      'bg-yellow-500/20 text-yellow-300 border-yellow-500/30': laporan.status === 'Menunggu Verifikasi',
                                                      'bg-green-500/20 text-green-300 border-green-500/30': laporan.status === 'Terverifikasi',
                                                      'bg-red-500/20 text-red-300 border-red-500/30': laporan.status === 'Ditolak'
                                                  }" x-text="laporan.status"></span>
                                        </td>
                                        
                                        <td class="px-6 py-5 text-center">
                                            <a :href="'/masyarakat/lapor/' + laporan.id" 
                                               class="px-5 py-2 bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold rounded-lg transition-all shadow-[0_4px_15px_rgba(59,130,246,0.3)] active:scale-95 inline-block">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                </template>

                                <template x-if="filteredLaporans.length === 0">
                                    <tr>
                                        <td colspan="6" class="py-24 text-center">
                                            <div class="flex flex-col items-center opacity-60">
                                                <svg class="w-16 h-16 mb-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                <p class="italic text-white text-lg font-medium">Laporan tidak ditemukan.</p>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>