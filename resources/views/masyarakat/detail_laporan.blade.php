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
        body { font-family: 'Poppins', sans-serif; margin: 0; padding: 0; background-color: #004d6b; }
        .bg-sea {
            background-image: url("{{ asset('storage/images/background.jpg') }}");
            background-size: cover; background-position: center; background-attachment: fixed;
            min-height: 100vh; width: 100%;
        }
        .glass-text { color: white; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4); }
        .glass-sidebar { background: rgba(0, 0, 0, 0.2); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.2); }
        .glass-box { background-color: rgba(255, 240, 240, 0.25); backdrop-filter: blur(15px); border-radius: 24px; padding: 32px; border: 1px solid rgba(255, 255, 255, 0.1); }
        .label-detail { font-family: 'Inter', sans-serif; font-size: 13px; font-weight: 600; color: rgba(0, 0, 0, 0.5); text-transform: uppercase; letter-spacing: 0.05em; }
        .value-detail { font-family: 'Inter', sans-serif; font-size: 18px; font-weight: 600; color: #ffffff; display: block; margin-top: 4px; }
        .progress-dot { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; z-index: 2; }
        .progress-line { width: 6px; height: 60px; background-color: rgba(255, 255, 255, 0.3); margin-left: 13px; margin-top: -2px; margin-bottom: -2px; }
        .progress-line.active { background-color: #ffffff; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-sea overflow-x-hidden">

    @php
        $alamatArray = explode(', Provinsi ', $laporan->alamat_lokasi);
        $namaLokasi = $alamatArray[0] ?? $laporan->alamat_lokasi;
        $namaProvinsi = $alamatArray[1] ?? '-';
        $photos = $laporan->attachments ?? [];
    @endphp

    <div class="relative w-full min-h-screen">
        <header class="fixed top-0 left-0 w-full h-[100px] flex items-center justify-between px-12 z-[100] bg-[#0077a9]/10 backdrop-blur-md border-b border-white/10">
            <div class="flex items-center gap-4">
                <img src="{{ asset('storage/images/logo.png') }}" class="w-12 h-12 object-contain mix-blend-multiply" alt="Logo">
                <h1 class="font-['Work_Sans'] font-semibold text-white text-3xl tracking-tight glass-text">Sahabat Laut</h1>
            </div>
            <div class="flex items-center gap-3 bg-white/10 p-1 pr-4 rounded-full border border-white/20">
                <div class="w-10 h-10 rounded-full border-2 bg-white overflow-hidden border-white/50 shadow-sm">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->first_name . ' ' . $user->last_name) }}&background=random" alt="Profile">
                </div>
                <span class="font-semibold text-white text-sm glass-text">{{ $user->first_name }} {{ $user->last_name }}</span>
            </div>
        </header>

        <div class="flex items-start pt-[130px] px-10 pb-10 gap-10 min-h-screen">
            <aside class="w-72 h-fit sticky top-[120px] rounded-[32px] overflow-hidden glass-sidebar p-8 flex flex-col z-20 text-white">
                <nav class="flex flex-col gap-10">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-4 text-white/60 hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span>Home Page</span>
                    </a>
                    <a href="{{ route('laporan.create') }}" class="flex items-center gap-4 text-white/60 hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                        <span>Kirim Laporan</span>
                    </a>
                    <a href="{{ route('laporan.history') }}" class="flex items-center gap-4 text-white font-bold transition-all underline underline-offset-8 decoration-2">
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
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-white/40 font-semibold text-sm">
                        <a href="{{ route('laporan.history') }}" class="hover:text-white transition-all">Riwayat Laporan</a>
                        <span>&gt;</span>
                        <span class="text-white">Detail Laporan</span>
                    </div>
                    <a href="{{ route('laporan.history') }}" class="flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-xl border border-white/20 transition-all text-sm font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>
                </div>

                <div class="flex flex-col lg:flex-row gap-8">
                    <div class="flex-1 flex flex-col gap-6">
                        <div class="glass-box flex flex-col gap-6">

                            <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-black/20 border border-white/10 shadow-inner group" 
                                 x-data="{ 
                                    active: 0, 
                                    images: {{ json_encode(array_map(fn($p) => asset('storage/laporan/'.$p), $photos)) }},
                                    next() { this.active = (this.active + 1) % this.images.length },
                                    prev() { this.active = (this.active - 1 + this.images.length) % this.images.length }
                                 }">
                                
                                <template x-if="images.length > 0">
                                    <div class="w-full h-full">
                                        <img :src="images[active]" class="w-full h-full object-cover transition-opacity duration-500" alt="Foto Temuan">
                                        <template x-if="images.length > 1">
                                            <div class="absolute inset-0 flex items-center justify-between px-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <button @click="prev()" class="p-2 bg-black/50 text-white rounded-full hover:bg-black/80 transition-all">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                                </button>
                                                <button @click="next()" class="p-2 bg-black/50 text-white rounded-full hover:bg-black/80 transition-all">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                                </button>
                                            </div>
                                        </template>

                                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                                            <template x-for="(img, index) in images" :key="index">
                                                <div class="h-1.5 rounded-full transition-all duration-300" 
                                                     :class="active === index ? 'w-6 bg-white' : 'w-2 bg-white/40'"></div>
                                            </template>
                                        </div>
                                    </div>
                                </template>

                                <template x-if="images.length === 0">
                                    <div class="w-full h-full flex items-center justify-center text-white/30 italic">Tidak ada foto bukti visual</div>
                                </template>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
                                <div><span class="label-detail">Tanggal Temuan</span><span class="value-detail">{{ $laporan->tanggal_temuan->format('d.m.Y') }}</span></div>
                                <div><span class="label-detail">Spesies</span><span class="value-detail">{{ $laporan->species }}</span></div>
                                <div><span class="label-detail">Aktivitas</span><span class="value-detail">{{ $laporan->aktivitas }}</span></div>
                                <div><span class="label-detail">Provinsi</span><span class="value-detail">{{ $namaProvinsi }}</span></div>
                                <div class="md:col-span-2"><span class="label-detail">Alamat / Nama Lokasi</span><span class="value-detail">{{ $namaLokasi }}</span></div>
                            </div>

                            <div class="border-t border-white/10 pt-6">
                                <span class="label-detail">Deskripsi Temuan</span>
                                <p class="text-white/90 mt-2 leading-relaxed text-sm">{{ $laporan->deskripsi_temuan }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full lg:w-[450px] flex flex-col gap-6">
                        <div class="glass-box">
                            <h3 class="text-white font-bold text-xl mb-8">Progress Pelaporan</h3>
                            <div class="flex flex-col">
                                <div class="flex items-center gap-4">
                                    <div class="progress-dot bg-white shadow-[0_0_15px_rgba(255,255,255,0.5)]"><svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg></div>
                                    <span class="text-white font-semibold">Laporan Diterima</span>
                                </div>
                                <div class="progress-line {{ in_array($laporan->status, ['Terverifikasi', 'Ditolak']) ? 'active' : '' }}"></div>
                                <div class="flex items-center gap-4">
                                    <div class="progress-dot {{ in_array($laporan->status, ['Terverifikasi', 'Ditolak']) ? 'bg-white shadow-[0_0_15px_rgba(255,255,255,0.5)]' : 'bg-white/30 border-2 border-white/20' }}">
                                        @if(in_array($laporan->status, ['Terverifikasi', 'Ditolak']))<svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>@endif
                                    </div>
                                    <span class="font-semibold {{ $laporan->status == 'Menunggu Verifikasi' ? 'text-white' : 'text-white/60' }}">Sedang Ditinjau Pakar</span>
                                </div>
                                <div class="progress-line {{ in_array($laporan->status, ['Terverifikasi', 'Ditolak']) ? 'active' : '' }}"></div>
                                <div class="flex items-center gap-4">
                                    <div class="progress-dot {{ in_array($laporan->status, ['Terverifikasi', 'Ditolak']) ? 'bg-white shadow-[0_0_15px_rgba(255,255,255,0.5)]' : 'bg-white/30 border-2 border-white/20' }}">
                                        @if($laporan->status == 'Terverifikasi')<svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                        @elseif($laporan->status == 'Ditolak')<svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>@endif
                                    </div>
                                    <span class="font-semibold {{ in_array($laporan->status, ['Terverifikasi', 'Ditolak']) ? 'text-white' : 'text-white/60' }}">Hasil Validasi: {{ $laporan->status }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="glass-box">
                            <h3 class="text-white font-bold text-xl mb-2">Ditinjau oleh:</h3>
                            <p class="text-white/70 font-medium mb-6 italic">{{ $laporan->expert->name ?? 'Tim Ahli Sahabat Laut' }}</p>
                            <h4 class="text-white font-bold text-sm mb-3 uppercase tracking-wider">Catatan Pakar :</h4>
                            <div class="w-full min-h-[160px] bg-black/20 rounded-2xl border border-white/5 p-5 text-white/80 text-sm leading-relaxed shadow-inner">
                                {{ $laporan->catatan_expert ?? 'Laporan Anda sedang dalam tahap verifikasi oleh tim pakar kami.' }}
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>