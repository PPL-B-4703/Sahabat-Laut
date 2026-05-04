<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $biota->nama_biota }} – Sahabat Laut</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-playfair { font-family: 'Playfair Display', serif; }
        #hero-img { transition: transform 0.1s linear; }
        .glass { background: rgba(13, 31, 62, 0.55); backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.07); }
        .rel-card:hover .rel-img { transform: scale(1.07); }
        .rel-img { transition: transform 0.4s ease; }
        #related-scroll { scrollbar-width: none; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #071325; }
        ::-webkit-scrollbar-thumb { background: #1a3a6b; border-radius: 3px; }
    </style>
</head>
<body class="bg-[#071325] text-white">

{{-- NAVBAR --}}
<nav class="fixed top-0 left-0 right-0 z-50 px-6 md:px-12 py-4 flex items-center justify-between"
     style="background: linear-gradient(to bottom, rgba(7,19,37,0.97), transparent)">
    <a href="{{ route('katalog.index') }}" class="flex items-center gap-2 text-white/55 hover:text-white text-sm transition group">
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Katalog
    </a>
    <span class="text-white/25 text-xs tracking-widest uppercase">Sahabat Laut · {{ $biota->kategori }}</span>
</nav>

{{-- HERO --}}
<section class="relative h-[65vh] min-h-[450px] overflow-hidden">
    <img id="hero-img" src="{{ $biota->gambar_url }}" alt="{{ $biota->nama_biota }}" class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(7,19,37,1) 0%, rgba(7,19,37,0.4) 50%, transparent 100%)"></div>
    
    <div class="absolute bottom-0 left-0 px-6 md:px-12 pb-12 w-full">
        <p class="text-[#00e5c3] text-[10px] tracking-[0.3em] uppercase mb-4 font-bold">Biota Dilindungi Indonesia</p>
        <h1 class="font-playfair text-5xl md:text-7xl font-bold leading-tight mb-3 tracking-tight">{{ $biota->nama_biota }}</h1>
        <p class="text-white/50 text-xl italic font-playfair">{{ $biota->nama_ilmiah }}</p>
    </div>
</section>

{{-- CONTENT --}}
<section class="px-6 md:px-12 py-12">
    <div class="grid lg:grid-cols-3 gap-12">
        
        {{-- LEFT COLUMN: Deskripsi & Fakta --}}
        <div class="lg:col-span-2 space-y-12">
            <div>
                <h2 class="font-playfair text-3xl font-bold mb-6 text-cyan-400">Deskripsi</h2>
                <p class="text-white/70 leading-relaxed text-lg">{{ $biota->deskripsi }}</p>
            </div>

            <div>
                <h2 class="font-playfair text-3xl font-bold mb-6 text-cyan-400">Fakta Menarik</h2>
                <div class="grid md:grid-cols-2 gap-4">
                    @foreach($biota->fakta_array as $idx => $f)
                        @if(!empty($f))
                        <div class="glass p-5 rounded-2xl flex gap-4 items-start">
                            <span class="text-2xl">✨</span>
                            <p class="text-sm text-white/80 leading-relaxed">{{ $f }}</p>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN: Distribusi (LIST) & Info --}}
        <div class="space-y-8">
            <div class="glass p-8 rounded-[2rem] border-cyan-400/20 shadow-2xl">
                <h2 class="font-playfair text-2xl font-bold mb-6 border-b border-white/10 pb-4">Habitat & Distribusi</h2>
                
                <div class="space-y-4">
                    @forelse($biota->lokasi_array as $loc)
                        <div class="flex items-center gap-4 group p-3 rounded-xl hover:bg-white/5 transition">
                            <div class="w-10 h-10 rounded-full bg-cyan-400/10 flex items-center justify-center text-cyan-400 flex-shrink-0 group-hover:bg-cyan-400 group-hover:text-[#071325] transition duration-300">
                                📍
                            </div>
                            <div>
                                {{-- SESUAIKAN DENGAN KEY DI MODEL (nama, lat, lng) --}}
                                <p class="text-white/90 font-bold text-sm">{{ $loc['nama'] }}</p>
                                <p class="text-[10px] text-white/30 font-mono tracking-tighter">
                                    {{ $loc['lat'] }}° , {{ $loc['lng'] }}°
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-white/30 text-sm italic text-center py-4">Data lokasi belum terdaftar.</p>
                    @endforelse
                </div>
                
                <div class="mt-8 pt-6 border-t border-white/10">
                    <p class="text-[10px] text-white/40 uppercase tracking-widest mb-2 font-bold text-center">Status Konservasi</p>
                    <div class="bg-red-500/10 border border-red-500/30 text-red-400 py-3 rounded-xl text-center font-bold text-sm">
                        {{ $biota->status_konservasi }}
                    </div>
                </div>
            </div>

            {{-- SPESIES TERKAIT --}}
            <div>
                <h2 class="font-playfair text-2xl font-bold mb-6">Spesies Terkait</h2>
                <div id="related-scroll" class="flex gap-4 overflow-x-auto pb-4">
                    @foreach($spesiesTorkait as $rel)
                        <a href="{{ route('katalog.show', $rel->id) }}" class="rel-card flex-shrink-0 w-44 glass rounded-[1.5rem] overflow-hidden group">
                            <div class="h-48 overflow-hidden relative">
                                <img src="{{ $rel->gambar_url }}" class="rel-img w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#071325] to-transparent"></div>
                            </div>
                            <div class="p-4">
                                <p class="text-xs font-bold truncate group-hover:text-cyan-400 transition">{{ $rel->nama_biota }}</p>
                                <p class="text-[9px] text-white/30 italic truncate">{{ $rel->nama_ilmiah }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>

<footer class="mt-12 border-t border-white/5 py-12 text-center bg-[#050e1b]">
    <p class="text-white/20 text-[10px] tracking-widest uppercase">© 2026 Sahabat Laut · Data Kementerian Kelautan dan Perikanan RI</p>
</footer>

<script>
    const heroImg = document.getElementById('hero-img');
    window.addEventListener('scroll', () => {
        let value = window.scrollY;
        heroImg.style.transform = `translateY(${value * 0.3}px)`;
    });
</script>
</body>
</html>