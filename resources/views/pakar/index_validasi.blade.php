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

    <main class="main-content">
        <div class="content-container">
            <header class="flex justify-between items-center mb-10 pr-6">
                <div class="flex-1 flex items-center justify-between mr-8 lg:mr-16">
                    <div>
                        <h2 class="text-3xl font-bold text-white">Daftar Validasi</h2>
                        <p class="text-slate-400">Kelola laporan biota laut terbaru.</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('pakar.profile') }}" class="flex items-center gap-3 bg-slate-800/40 p-1.5 pr-5 rounded-full border border-slate-700 hover:bg-slate-700/60 transition-all group">
                        <div class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center font-bold text-white shadow-lg shadow-blue-900/20 group-hover:scale-105 transition-transform uppercase">
                            {{ substr(auth()->user()->first_name, 0, 1) }}
                        </div>
                        <p class="text-white font-bold text-sm">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                    </a>
                    
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

        <div class="flex justify-end mb-4 mr-6">
            <button type="button" onclick="validasiMassal()" class="bg-[#131C31] text-blue-500 border border-blue-500/50 hover:bg-blue-600 hover:text-white font-bold py-2.5 px-6 rounded-xl transition-all text-sm shadow-lg shadow-blue-900/20">
                Verifikasi Terpilih
            </button>
        </div>

        <div class="table-card shadow-2xl mr-6">
            <div class="w-full overflow-x-auto no-scrollbar">
                <form id="formValidasiMassal" onsubmit="event.preventDefault();">
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

        <div id="modalBulkVerify" class="fixed inset-0 z-[99] hidden flex items-center justify-center">
            <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity opacity-0" id="modalBackdrop" onclick="tutupModal()"></div>

            <div class="relative bg-[#131C31] border border-slate-700 w-[400px] rounded-[32px] shadow-2xl p-7 transform transition-all scale-95 opacity-0" id="modalContent">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-blue-500/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Verifikasi <span id="angkaModal" class="text-blue-500">0</span> Data</h3>
                    <p class="text-sm text-slate-400">Yakin mau memvalidasi laporan yang dipilih? Ketik catatan lu di bawah ini.</p>
                </div>

                <div class="mb-8">
                    <textarea id="catatanModal" rows="3" class="w-full bg-slate-900 border border-slate-700 rounded-2xl p-4 text-sm text-white placeholder-slate-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all resize-none" placeholder="Telah divalidasi massal..."></textarea>
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="tutupModal()" class="flex-1 py-3.5 bg-slate-800 text-slate-300 font-bold rounded-2xl hover:bg-slate-700 transition-all text-sm">Batal</button>
                    <button type="button" onclick="kirimValidasi()" id="btnKirimModal" class="flex-1 py-3.5 bg-blue-600 text-white font-bold rounded-2xl shadow-lg shadow-blue-900/20 hover:bg-blue-500 transition-all text-sm">Verifikasi</button>
                </div>
            </div>
        </div>

        <script>
            let selectedIdsGlobal = []; // Variabel nyimpen ID sementara

            // 1. Fungsi Centang Semua
            window.toggleSemua = function(source) {
                let checkboxes = document.querySelectorAll('.ceklis-laporan');
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = source.checked;
                });
            };

            // 2. Fungsi Pas Tombol Pertama Diklik (Buka Modal)
            window.validasiMassal = function() {
                let checkboxes = document.querySelectorAll('.ceklis-laporan:checked');
                selectedIdsGlobal = [];
                
                checkboxes.forEach((checkbox) => {
                    selectedIdsGlobal.push(checkbox.value);
                });

                if (selectedIdsGlobal.length === 0) {
                    alert('Ceklis minimal satu laporan dulu brok!');
                    return;
                }

                // Update angka di pop-up
                document.getElementById('angkaModal').innerText = selectedIdsGlobal.length;
                document.getElementById('catatanModal').value = 'Telah divalidasi massal.'; 
                
                // Tampilkan pop-up dengan efek transisi
                const modal = document.getElementById('modalBulkVerify');
                const backdrop = document.getElementById('modalBackdrop');
                const content = document.getElementById('modalContent');
                
                modal.classList.remove('hidden');
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                    backdrop.classList.add('opacity-100');
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 10);
            };

            // 3. Fungsi Tutup Modal
            window.tutupModal = function() {
                const modal = document.getElementById('modalBulkVerify');
                const backdrop = document.getElementById('modalBackdrop');
                const content = document.getElementById('modalContent');
                
                backdrop.classList.remove('opacity-100');
                backdrop.classList.add('opacity-0');
                content.classList.remove('scale-100', 'opacity-100');
                content.classList.add('scale-95', 'opacity-0');
                
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300); // Nunggu animasi kelar
            };

            // 4. Fungsi Pas Tombol Verifikasi di Dalam Pop-up Diklik
            window.kirimValidasi = function() {
                let catatan = document.getElementById('catatanModal').value;
                let btnKirim = document.getElementById('btnKirimModal');
                
                // Bikin tombol loading biar user ga klik 2x
                btnKirim.innerText = 'Memproses...';
                btnKirim.disabled = true;
                btnKirim.classList.add('opacity-50', 'cursor-not-allowed');

                fetch('{{ route("pakar.validasi.bulk") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ 
                        ids: selectedIdsGlobal,
                        catatan: catatan
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        window.location.reload(); 
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Waduh gagal nembak server brok.');
                    btnKirim.innerText = 'Verifikasi';
                    btnKirim.disabled = false;
                    btnKirim.classList.remove('opacity-50', 'cursor-not-allowed');
                });
            };
        </script>
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