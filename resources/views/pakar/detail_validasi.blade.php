<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Validasi - {{ $report->nama }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #0F172A; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#0F172A] text-white overflow-x-hidden" x-data="{ notificationsOpen: false, selectAll: false }">

    <aside class="w-64 bg-[#0F172A] border-r border-slate-800 flex flex-col fixed h-full z-30">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-white tracking-tight">Sahabat Laut</h1>
        </div>
        
        <nav class="flex-1 px-4 space-y-2">
            <a href="{{ route('pakar.dashboard') }}" class="flex items-center px-4 py-3 text-slate-400 hover:bg-slate-800 rounded-xl transition group">
                <svg class="w-5 h-5 mr-3 text-slate-500 group-hover:text-white transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
                Dashboard
            </a>

            <a href="{{ route('pakar.validasi') }}" class="flex items-center px-4 py-3 bg-blue-600/10 text-blue-500 rounded-xl font-semibold border border-blue-500/20">
                <svg class="w-5 h-5 mr-3 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .415.162.798.425 1.081.263.283.646.445 1.075.445.429 0 .812-.162 1.075-.445.263-.283.425-.666.425-1.081 0-.231-.035-.454-.1-.664m-5.801 0A2.251 2.251 0 0 1 13.5 2.25c1.028 0 1.91.685 2.199 1.626M6.108 4.625a48.191 48.191 0 0 0-1.123.08C3.845 4.798 3 5.761 3 6.896v11.354A2.25 2.25 0 0 0 5.25 20.5h13.5" />
                </svg>
                Validasi Laporan
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 text-red-400 hover:bg-red-400/10 rounded-xl transition font-medium">
                    <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-8">
        <header class="mb-8">
            <nav class="flex items-center gap-2 text-[10px] uppercase tracking-widest text-slate-500 mb-2 font-bold">
                <a href="{{ route('pakar.validasi') }}" class="hover:text-blue-500 transition">Validasi Laporan</a>
                <span>&gt;</span>
                <span class="text-slate-300">Detail Laporan</span>
            </nav>
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-white">Detail Laporan</h1>

                <div class="flex items-center gap-3">
                    <a href="{{ route('pakar.profile') }}" class="flex items-center gap-3 bg-slate-800/40 p-1.5 pr-5 rounded-full border border-slate-700 hover:bg-slate-700/60 transition-all group">
                        <div class="w-9 h-9 bg-blue-600 rounded-full flex items-center justify-center font-bold text-white shadow-lg shadow-blue-900/20 group-hover:scale-105 transition-transform uppercase">
                            {{ substr(auth()->user()->first_name, 0, 1) }}
                        </div>
                        <p class="text-white font-bold text-sm">
                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                        </p>
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
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            class="absolute right-0 mt-4 w-72 bg-[#131C31] border border-slate-700/60 rounded-3xl shadow-2xl z-50 overflow-hidden text-left">
                            <div class="p-5 border-b border-slate-800/60 font-bold text-xs uppercase tracking-widest text-slate-500">Notifikasi</div>
                            <div class="p-8 text-center text-slate-500 italic text-xs">
                                Belum ada notifikasi baru
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        @php
            $alamatArray = explode(', Provinsi ', $report->alamat_lokasi);
            $lokasi = $alamatArray[0] ?? $report->alamat_lokasi;
            $provinsi = $alamatArray[1] ?? '-';
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
            <section class="bg-slate-800/40 p-8 rounded-[32px] border border-slate-700 shadow-2xl backdrop-blur-sm">
                <h3 class="text-xl font-bold mb-8">Informasi Laporan User</h3>
                
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <p class="text-lg font-bold text-white">{{ $report->user->first_name ?? 'Anonim' }} {{ $report->user->last_name ?? '' }}</p>
                        <div class="mt-2 flex items-center gap-2">
                            <span class="text-[9px] font-bold uppercase px-3 py-1 bg-yellow-500/10 text-yellow-500 border border-yellow-500/20 rounded-lg">
                                {{ $report->status }}
                            </span>
                        </div>
                    </div>
                    <p class="text-xs font-bold text-slate-500 uppercase">TANGGAL: {{ $report->tanggal_temuan }}</p>
                </div>

                <div class="relative group mb-8">
                    @php
                        $fotos = is_string($report->attachments) ? json_decode($report->attachments, true) : $report->attachments;
                    @endphp

                    @if(!empty($fotos) && is_array($fotos) && count($fotos) > 0)
                        <img src="{{ asset('storage/laporan/' . $fotos[0]) }}" 
                            alt="Foto Biota" 
                            class="w-full h-80 object-cover rounded-[32px] border border-slate-700/50 shadow-2xl">
                    @else
                        <img src="https://placehold.jp/24/131c31/ffffff/600x400.png?text=FOTO+{{ urlencode($report->species ?? 'BIOTA') }}" 
                            alt="Foto Biota" 
                            class="w-full h-80 object-cover rounded-[32px] border border-slate-700/50 shadow-2xl">
                    @endif
                    
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-[32px] flex items-center justify-center">
                        <p class="text-sm font-bold text-white">Klik untuk memperbesar</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-1">Spesies</label>
                        <p class="text-slate-200 font-semibold italic">{{ $report->species }}</p>
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-1">Aktivitas</label>
                        <p class="text-slate-200 font-semibold italic">{{ $report->aktivitas }}</p>
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-1">Deskripsi Temuan</label>
                        <p class="text-sm text-slate-400 leading-relaxed">
                            {{ $report->deskripsi_temuan }}
                        </p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 border-t border-slate-700/50 pt-6">
                        <div>
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-1">Provinsi</label>
                            <p class="text-slate-200 font-semibold italic">{{ $provinsi }}</p>
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-1">Lokasi</label>
                            <p class="text-slate-200 font-semibold italic">{{ $lokasi }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-slate-800/40 p-8 rounded-[32px] border border-slate-700 shadow-2xl backdrop-blur-sm sticky top-8">
                <h3 class="text-xl font-bold mb-6">Formulir Validasi & Koreksi Pakar</h3>
                
                @if($report->status == 'Menunggu Verifikasi')
                    <form action="{{ route('pakar.validasi.update', $report->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-6 border-b border-slate-700/50 pb-4">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-1">Pakar Validasi</label>
                            <p class="text-slate-200 font-bold text-base">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                        </div>

                        <div class="mb-6" x-data="{ open: false, selected: 'Terverifikasi' }">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">Status <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <button type="button" @click="open = !open" 
                                        class="w-full bg-[#131C31] border border-slate-700/60 p-4 rounded-2xl flex justify-between items-center text-sm font-semibold">
                                    <span x-text="selected"></span>
                                    <i class="ph-bold ph-caret-down transition-transform" :class="open ? 'rotate-180' : ''"></i>
                                </button>
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute w-full mt-2 bg-[#131C31] border border-slate-700 shadow-xl rounded-2xl z-50 overflow-hidden">
                                    <div @click="selected = 'Terverifikasi'; open = false" class="p-4 hover:bg-blue-600/20 cursor-pointer">Terverifikasi</div>
                                    <div @click="selected = 'Ditolak'; open = false" class="p-4 hover:bg-red-600/20 cursor-pointer">Ditolak</div>
                                </div>
                                <input type="hidden" name="status" :value="selected">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-2">Koreksi & Tindak Lanjut</label>
                            <textarea name="koreksi" rows="6" class="w-full bg-[#131C31] border border-slate-700/60 p-5 rounded-3xl text-sm text-slate-300 focus:border-blue-500 outline-none transition-all" placeholder="Tuliskan alasan ilmiah atau koreksi..."></textarea>
                        </div>

                        <div class="mb-8 flex items-start gap-3">
                            <input type="checkbox" id="pernyataan" required class="mt-0.5 w-4 h-4 rounded bg-[#131C31] border-slate-700/60 text-blue-600 focus:ring-blue-500 cursor-pointer">
                            <label for="pernyataan" class="text-[11px] text-slate-400 leading-relaxed cursor-pointer select-none">
                                Saya menyatakan bahwa validasi ini dilakukan berdasarkan keilmuan yang dapat dipertanggungjawabkan
                            </label>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="button" onclick="window.history.back()" class="w-1/3 bg-slate-700 py-4 rounded-2xl font-bold text-sm hover:bg-slate-600 shadow-lg transition-all text-white">
                                BATAL
                            </button>
                            <button type="submit" class="w-2/3 bg-blue-600 py-4 rounded-2xl font-bold text-sm hover:bg-blue-500 shadow-lg shadow-blue-900/20 transition-all text-white">
                                SIMPAN VALIDASI
                            </button>
                        </div>
                    </form>
                @else
                    <div class="space-y-6">
                        <div class="border-b border-slate-700/50 pb-4">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block mb-1">Divalidasi Oleh</label>
                            <p class="text-slate-200 font-bold text-base">
                                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                            </p>
                        </div>
                        
                        <div class="p-4 rounded-2xl border {{ $report->status == 'Terverifikasi' ? 'border-green-500/20 bg-green-500/5' : 'border-red-500/20 bg-red-500/5' }}">
                            <label class="text-[10px] font-bold text-slate-500 uppercase mb-1 block">Status Akhir</label>
                            <p class="font-bold {{ $report->status == 'Terverifikasi' ? 'text-green-500' : 'text-red-500' }}">
                                {{ strtoupper($report->status) }}
                            </p>
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-slate-500 uppercase mb-1 block">Catatan Pakar</label>
                            <div class="bg-[#131C31] p-5 rounded-3xl border border-slate-700/60 text-sm text-slate-400 italic">
                                "{{ $report->koreksi ?? 'Tidak ada catatan tambahan.' }}"
                            </div>
                        </div>

                        <div class="p-4 bg-slate-800/50 rounded-2xl border border-slate-700/50">
                            <p class="text-[10px] text-slate-500 leading-relaxed font-medium">
                                <i class="ph-bold ph-info mr-1"></i> Laporan ini sudah bersifat final. Status tidak dapat diubah kembali kecuali masyarakat membuat laporan baru.
                            </p>
                        </div>
                        
                        <a href="{{ route('pakar.validasi') }}" class="block w-full bg-slate-700 py-4 rounded-2xl font-bold text-sm text-center hover:bg-slate-600 transition">
                            KEMBALI KE DAFTAR
                        </a>
                    </div>
                @endif
            </section>
        </div>
    </main>
</body>
</html>