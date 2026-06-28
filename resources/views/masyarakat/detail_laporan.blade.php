<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Laporan - {{ $laporan->species }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Work+Sans:wght@400;600&family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            margin: 0; padding: 0; 
            /* SERAGAM DENGAN DASHBOARD */
            background-image: url("{{ asset('images/bg-dashboard.jpg') }}");
            background-size: cover; background-position: center; background-attachment: fixed;
            background-color: #004d6b; 
        }
        .glass-text { color: white; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4); }
        
        /* CLASS STANDARD GLASS UNTUK SIDEBAR & CARD */
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
        }
        
        /* CARD KHUSUS BACAAN BIAR KONTRAS TINGGI */
        .readable-box {
            background: rgba(0, 0, 0, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 24px;
            box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .label-detail { font-family: 'Inter', sans-serif; font-size: 12px; font-weight: 600; color: rgba(255, 255, 255, 0.6); text-transform: uppercase; letter-spacing: 0.05em; }
        .value-detail { font-family: 'Inter', sans-serif; font-size: 16px; font-weight: 600; color: #ffffff; display: block; margin-top: 6px; }
        .progress-dot { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; z-index: 2; }
        .progress-line { width: 4px; height: 50px; background-color: rgba(255, 255, 255, 0.2); margin-left: 14px; margin-top: -2px; margin-bottom: -2px; }
        .progress-line.active { background-color: #3b82f6; box-shadow: 0 0 10px rgba(59, 130, 246, 0.5); }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="overflow-x-hidden min-h-screen">

    @php
        $alamatArray = explode(', Provinsi ', $laporan->alamat_lokasi);
        $namaLokasi = $alamatArray[0] ?? $laporan->alamat_lokasi;
        $namaProvinsi = $alamatArray[1] ?? '-';

        $rawAttachments = $laporan->attachments;
        if (is_string($rawAttachments)) {
            $decoded = json_decode($rawAttachments, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $attachmentsArray = $decoded;
            } else {
                $attachmentsArray = [$rawAttachments];
            }
        } else {
            $attachmentsArray = (array) $rawAttachments;
        }
        $attachmentsArray = array_filter($attachmentsArray);
    @endphp

    <div class="relative w-full min-h-screen">
        
        <header class="fixed top-0 left-0 w-full h-[100px] flex items-center justify-between px-12 z-[100] bg-transparent">
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/logo.png') }}" class="w-12 h-12 object-contain mix-blend-multiply" alt="Logo">
                <h1 class="font-['Work_Sans'] font-semibold text-white text-3xl tracking-tight glass-text">Sahabat Laut</h1>
            </div>
            <div class="flex items-center gap-8">
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
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-white/60 font-semibold text-sm drop-shadow-md">
                        <a href="{{ route('laporan.history') }}" class="hover:text-white transition-all">Riwayat Laporan</a>
                        <span>&gt;</span>
                        <span class="text-white">Detail Laporan</span>
                    </div>
                    <a href="{{ route('laporan.history') }}" class="flex items-center gap-2 glass-card hover:bg-white/20 text-white px-5 py-2.5 rounded-xl transition-all text-sm font-semibold shadow-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>
                </div>

                <div class="flex flex-col lg:flex-row gap-8">
                    
                    <div class="flex-1 flex flex-col gap-6">
                        <div class="glass-card rounded-[24px] p-6 flex flex-col gap-6">

                            <div class="relative w-full aspect-video rounded-[16px] overflow-hidden bg-black/40 border border-white/10 shadow-[inset_0_4px_20px_rgba(0,0,0,0.5)] group" 
                                 x-data="{ 
                                    active: 0, 
                                    images: {{ json_encode(array_map(fn($p) => asset('storage/laporan/'.$p), $attachmentsArray)) }},
                                    next() { this.active = (this.active + 1) % this.images.length },
                                    prev() { this.active = (this.active - 1 + this.images.length) % this.images.length }
                                 }">
                                
                                <template x-if="images.length > 0">
                                    <div class="w-full h-full">
                                        <img :src="images[active]" class="w-full h-full object-cover transition-opacity duration-500" alt="Foto Temuan">
                                        <template x-if="images.length > 1">
                                            <div class="absolute inset-0 flex items-center justify-between px-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <button @click="prev()" class="p-3 bg-black/60 text-white rounded-full hover:bg-blue-600 transition-all backdrop-blur-sm border border-white/20">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                                </button>
                                                <button @click="next()" class="p-3 bg-black/60 text-white rounded-full hover:bg-blue-600 transition-all backdrop-blur-sm border border-white/20">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                                </button>
                                            </div>
                                        </template>

                                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 bg-black/30 backdrop-blur-md px-3 py-2 rounded-full">
                                            <template x-for="(img, index) in images" :key="index">
                                                <div class="h-1.5 rounded-full transition-all duration-300" 
                                                     :class="active === index ? 'w-6 bg-white shadow-[0_0_10px_white]' : 'w-2 bg-white/40'"></div>
                                            </template>
                                        </div>
                                    </div>
                                </template>

                                <template x-if="images.length === 0">
                                    <div class="w-full h-full flex items-center justify-center text-white/40 italic">Tidak ada foto bukti visual</div>
                                </template>
                            </div>

                            <div class="readable-box grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
                                <div>
                                    <span class="label-detail">Tanggal Temuan</span>
                                    <span class="value-detail">{{ \Carbon\Carbon::parse($laporan->tanggal_temuan)->translatedFormat('d F Y') }}</span>
                                </div>
                                <div>
                                    <span class="label-detail">Spesies</span>
                                    <span class="value-detail capitalize text-blue-300">{{ $laporan->species }}</span>
                                </div>
                                <div>
                                    <span class="label-detail">Aktivitas</span>
                                    <span class="value-detail">{{ $laporan->aktivitas }}</span>
                                </div>
                                <div>
                                    <span class="label-detail">Provinsi</span>
                                    <span class="value-detail">{{ $namaProvinsi }}</span>
                                </div>
                                <div class="md:col-span-2">
                                    <span class="label-detail">Alamat / Nama Lokasi</span>
                                    <span class="value-detail">{{ $namaLokasi }}</span>
                                </div>
                                <div class="md:col-span-2 border-t border-white/10 pt-6">
                                    <span class="label-detail">Deskripsi Temuan</span>
                                    <p class="text-white mt-3 leading-relaxed text-sm">{{ $laporan->deskripsi_temuan }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full lg:w-[400px] flex flex-col gap-6">
                        
                        <div class="glass-card rounded-[24px] p-8">
                            <h3 class="text-white font-bold text-xl mb-8 border-b border-white/20 pb-3 glass-text tracking-wide">Progress Pelaporan</h3>
                            
                            <div class="flex flex-col ml-2">
                                <div class="flex items-center gap-5">
                                    <div class="progress-dot bg-blue-500 shadow-[0_0_15px_rgba(59,130,246,0.8)] border-2 border-blue-300">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                        </svg>
                                    </div>
                                    <span class="text-white font-bold text-sm">Laporan Diterima</span>
                                </div>
                                <div class="progress-line {{ in_array($laporan->status, ['Menunggu Verifikasi', 'Terverifikasi', 'Ditolak']) ? 'active' : '' }}"></div>
                                
                                <div class="flex items-center gap-5">
                                    <div class="progress-dot {{ in_array($laporan->status, ['Terverifikasi', 'Ditolak']) ? 'bg-blue-500 shadow-[0_0_15px_rgba(59,130,246,0.8)] border-2 border-blue-300' : ($laporan->status == 'Menunggu Verifikasi' ? 'bg-yellow-400 border-2 border-yellow-200 animate-pulse shadow-[0_0_15px_rgba(250,204,21,0.6)]' : 'bg-black/30 border-2 border-white/20') }}">
                                        @if(in_array($laporan->status, ['Terverifikasi', 'Ditolak', 'Menunggu Verifikasi']))
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-bold text-sm {{ in_array($laporan->status, ['Menunggu Verifikasi', 'Terverifikasi', 'Ditolak']) ? 'text-white' : 'text-white/50' }}">Sedang Ditinjau Pakar</span>
                                        @if($laporan->status == 'Menunggu Verifikasi')
                                            <span class="text-yellow-300 text-xs mt-0.5">Memproses...</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="progress-line {{ in_array($laporan->status, ['Terverifikasi', 'Ditolak']) ? 'active' : '' }}"></div>
                                
                                <div class="flex items-center gap-5">
                                    <div class="progress-dot {{ in_array($laporan->status, ['Terverifikasi', 'Ditolak']) ? 'shadow-[0_0_15px_rgba(255,255,255,0.5)] border-2' : 'bg-black/30 border-2 border-white/20' }} 
                                        {{ $laporan->status == 'Terverifikasi' ? 'bg-green-500 border-green-300' : ($laporan->status == 'Ditolak' ? 'bg-red-500 border-red-300' : '') }}">
                                        @if($laporan->status == 'Terverifikasi')
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                        @elseif($laporan->status == 'Ditolak')
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                        @endif
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-bold text-sm {{ in_array($laporan->status, ['Terverifikasi', 'Ditolak']) ? 'text-white' : 'text-white/50' }}">Hasil Validasi</span>
                                        @if($laporan->status == 'Terverifikasi')
                                            <span class="text-green-300 text-sm font-bold mt-0.5 tracking-wide">TERVERIFIKASI</span>
                                        @elseif($laporan->status == 'Ditolak')
                                            <span class="text-red-300 text-sm font-bold mt-0.5 tracking-wide">DITOLAK</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="glass-card rounded-[24px] p-8">
                            <h3 class="text-white font-bold text-lg mb-2">Ditinjau oleh:</h3>
                            <p class="text-blue-200 font-semibold mb-6 border-b border-white/10 pb-4">
                                <span class="bg-black/30 px-3 py-1 rounded-lg">{{ $laporan->expert->name ?? 'Tim Ahli Sahabat Laut' }}</span>
                            </p>
                            
                            <h4 class="text-white/70 font-bold text-xs mb-3 uppercase tracking-widest">Catatan / Koreksi :</h4>
                            
                            @if($laporan->status == 'Terverifikasi')
                                <div class="w-full bg-green-500/10 rounded-2xl border border-green-400/30 p-5 text-white text-sm leading-relaxed shadow-inner">
                                    {{ $laporan->koreksi ?? 'Laporan tervalidasi. Terima kasih atas kontribusi Anda dalam menjaga kelestarian laut.' }}
                                </div>
                            @elseif($laporan->status == 'Ditolak')
                                <div class="w-full bg-red-500/10 rounded-2xl border border-red-400/30 p-5 text-white text-sm leading-relaxed shadow-inner">
                                    {{ $laporan->koreksi ?? 'Laporan ditolak. Bukti visual atau data yang dikirimkan tidak sesuai dengan kriteria.' }}
                                </div>
                            @else
                                <div class="w-full bg-black/30 rounded-2xl border border-white/10 p-5 text-white/70 text-sm leading-relaxed shadow-inner italic">
                                    Laporan Anda masih dalam antrean verifikasi tim pakar. Catatan hasil validasi akan muncul di sini.
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>