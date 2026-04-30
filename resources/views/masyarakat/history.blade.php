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
            margin: 0; padding: 0;
            background-color: #004d6b; 
        }
        .bg-sea {
            background-image: url("{{ asset('storage/images/background.jpg') }}");
            background-size: cover; background-position: center; background-attachment: fixed;
            min-height: 100vh; width: 100%;
        }
        .glass-text { color: white; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4); }
        .glass-sidebar {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 32px;
        }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.1); border-radius: 10px; }
        header { transform: translateZ(0); -webkit-transform: translateZ(0); }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-sea overflow-x-hidden">

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
        
        <header class="fixed top-0 left-0 w-full h-[100px] flex items-center justify-between px-12 z-[100] bg-[#0077a9]/10 backdrop-blur-md border-b border-white/10">
            <div class="flex items-center gap-4">
                <img src="{{ asset('storage/images/logo.png') }}" class="w-12 h-12 object-contain mix-blend-multiply" alt="Logo">
                <h1 class="font-['Work_Sans'] font-semibold text-white text-3xl tracking-tight glass-text">Sahabat Laut</h1>
            </div>
            <div class="flex items-center gap-3 bg-white/10 p-1 pr-4 rounded-full border border-white/20">
                <div class="w-10 h-10 rounded-full border-2 bg-white overflow-hidden border-white/50">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->first_name . ' ' . $user->last_name) }}&background=random" alt="Profile">
                </div>
                <span class="font-semibold text-white text-sm glass-text">{{ $user->first_name }} {{ $user->last_name }}</span>
                
            </div>
            
        </header>

        <div class="flex items-start pt-[130px] px-10 pb-10 gap-10 min-h-screen">
            <aside class="w-72 h-fit sticky top-[120px] rounded-[32px] overflow-hidden backdrop-blur-xl bg-black/20 border border-white/20 p-8 flex flex-col z-20 text-white">
                <nav class="flex flex-col gap-10">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-4 text-white/60 hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span>Home Page</span>
                    </a>
                    <a href="{{ route('laporan.create') }}" class="flex items-center gap-4 text-white/60 hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                        <span>Kirim Laporan</span>
                    </a>
                    <a href="#" class="flex items-center gap-4 text-white font-bold transition-all underline underline-offset-8 decoration-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        <span class="glass-text">History Laporan</span>
                    </a>
                </nav>
                <form action="{{ route('logout') }}" method="POST" class="mt-12 pt-6 border-t border-white/10">
                    @csrf
                    <button type="submit" class="flex items-center gap-4 text-white/60 hover:text-red-400 w-full transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span>Logout</span>
                    </button>
                </form>
            </aside>

            <main class="flex-1 flex flex-col gap-6 min-w-0">
                <div class="flex justify-between items-end">
                    <h2 class="text-3xl font-bold text-white glass-text">Riwayat Laporan</h2>
                    
                    <div class="relative w-80">
                        <input type="text" x-model="search" placeholder="Cari laporan..." 
                               class="w-full bg-white/10 border border-white/20 rounded-2xl py-3 pl-12 pr-4 text-white placeholder-white/50 focus:outline-none focus:ring-2 backdrop-blur-md transition-all font-['Work_Sans']">
                        <svg class="w-5 h-5 absolute left-4 top-3.5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <div class="glass-card flex-1 overflow-hidden flex flex-col shadow-2xl border border-white/20">
                    <div class="overflow-x-auto custom-scrollbar">
                        <table class="w-full text-left">
                            <thead class="bg-gray-100 border-b border-gray-200">
                                <tr class="text-[11px] uppercase tracking-widest text-gray-400 font-black font-['Work_Sans']">
                                    <th class="px-6 py-6 text-black">Spesies</th>
                                    <th class="px-6 py-6 text-black">Lokasi / Provinsi</th>
                                    <th class="px-6 py-6 text-black">Aktivitas</th>
                                    <th class="px-6 py-6 text-black">Tanggal Temuan</th>
                                    <th class="px-6 py-6 text-center text-black">Status Laporan</th>
                                    <th class="px-6 py-6 text-center text-black">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white/50">
                                <template x-for="(laporan, index) in filteredLaporans" :key="index">
                                    <tr class="hover:bg-blue-50/50 transition-all">
                                        <td class="px-6 py-5 font-bold text-blue-900 text-base" x-text="laporan.species"></td>
                                        <td class="px-6 py-5 text-sm text-gray-700 font-medium" x-text="laporan.alamat_lokasi"></td>
                                        <td class="px-6 py-5 text-sm text-gray-600" x-text="laporan.aktivitas"></td>
                                        <td class="px-6 py-5 text-sm text-gray-500 font-['Work_Sans']" 
                                            x-text="new Date(laporan.tanggal_temuan).toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'})"></td>
                                        <td class="px-6 py-5 text-center">
                                            <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase italic border shadow-sm inline-block"
                                                  :class="{
                                                    'bg-amber-50 text-amber-600 border-amber-200': laporan.status === 'Menunggu Verifikasi',
                                                    'bg-emerald-50 text-emerald-600 border-emerald-200': laporan.status === 'Terverifikasi',
                                                    'bg-rose-50 text-rose-600 border-rose-200': laporan.status === 'Ditolak'
                                                  }" x-text="laporan.status"></span>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            <button @click="showDetail(laporan)" 
                                                    class="px-4 py-2 bg-black text-white text-xs font-bold rounded-lg hover:bg-gray-800 transition-all shadow-md active:scale-95">
                                                Detail
                                            </button>
                                        </td>
                                    </tr>
                                </template>

                                <template x-if="filteredLaporans.length === 0">
                                    <tr>
                                        <td colspan="6" class="py-32 text-center">
                                            <div class="flex flex-col items-center opacity-30">
                                                <svg class="w-16 h-16 mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                <p class="italic text-gray-700 font-bold text-lg">Data tidak ditemukan.</p>
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

    <script>
        function showDetail(data) {
            Swal.fire({
                title: `<span style="font-family: 'Poppins'; font-weight: 800; color: #1e3a8a;">DETAIL LAPORAN</span>`,
                html: `
                    <div style="text-align: left; font-family: 'Poppins'; font-size: 14px; line-height: 1.6;">
                        <div style="background: #f8fafc; padding: 15px; border-radius: 15px; border: 1px solid #e2e8f0; margin-bottom: 12px;">
                            <b style="color: #64748b; font-size: 10px; text-transform: uppercase;">Lokasi & Koordinat</b><br>
                            <span style="color: #1e293b; font-weight: 600;">${data.alamat_lokasi}</span><br>
                            <code style="color: #2563eb; font-size: 11px;">${data.latitude}, ${data.longitude}</code>
                        </div>
                        <div style="background: #f8fafc; padding: 15px; border-radius: 15px; border: 1px solid #e2e8f0; margin-bottom: 12px;">
                            <b style="color: #64748b; font-size: 10px; text-transform: uppercase;">Spesies & Aktivitas</b><br>
                            <span style="color: #1e293b;">${data.species} (${data.aktivitas})</span>
                        </div>
                        <div style="background: #f8fafc; padding: 15px; border-radius: 15px; border: 1px solid #e2e8f0;">
                            <b style="color: #64748b; font-size: 10px; text-transform: uppercase;">Deskripsi Temuan</b><br>
                            <i style="color: #475569;">"${data.deskripsi_temuan}"</i>
                        </div>
                    </div>
                `,
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#000000',
                width: '500px',
                borderRadius: '30px'
            });
        }
    </script>
</body>
</html>