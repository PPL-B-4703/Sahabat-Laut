<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog - Sahabat Laut</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'DM Sans', sans-serif; background: #07192b; }
        .hero {
            background: linear-gradient(to right, rgba(7, 25, 43, 0.94), rgba(7, 25, 43, 0.35)),
                        url('https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=1800&q=80');
            background-size: cover;
            background-position: center;
        }
        .card { transition: all 0.3s ease; }
        .card:hover { transform: translateY(-8px); border-color: #22d3ee; }
        .card img { transition: transform 0.5s ease; }
        .card:hover img { transform: scale(1.1); }
    </style>
</head>

<body class="text-white">

    <!-- NAVBAR -->
    <nav class="fixed top-0 left-0 w-full z-50 px-10 py-6 flex justify-between bg-black/20 backdrop-blur-md border-b border-white/5">
        <h1 class="font-bold text-2xl leading-tight tracking-tighter">
            Sahabat <br> <span class="text-cyan-400">Laut</span>
        </h1>
        <div class="space-x-8 text-sm font-medium">
            <a href="/" class="text-white/70 hover:text-white transition">Beranda</a>
            <a href="/katalog" class="text-cyan-400">Katalog</a>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero min-h-[60vh] flex items-center px-10 pt-20">
        <div class="max-w-2xl">
            <h2 class="text-7xl font-extrabold mb-5 tracking-tight">Katalog<span class="text-cyan-400">.</span></h2>
            <p class="text-white/60 text-lg leading-relaxed mb-8">
                Menampilkan data resmi biota laut yang dilindungi di Indonesia. Jelajahi informasi lengkap mengenai habitat, konservasi, dan fakta unik tiap spesies.
            </p>

            <form action="{{ route('katalog.index') }}" method="GET" class="flex gap-3 flex-wrap">
                <div class="relative flex-1 min-w-[300px]">
                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-white/30">🔍</span>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari nama spesies atau kategori..."
                           class="w-full px-14 py-4 rounded-full bg-white/5 border border-white/10 focus:border-cyan-400 focus:outline-none transition">
                </div>
                <button type="submit" class="px-8 py-4 rounded-full bg-cyan-400 text-slate-900 font-bold hover:bg-cyan-300 transition shadow-lg shadow-cyan-400/20">
                    Cari Spesies
                </button>
            </form>
        </div>
    </section>

    <!-- GRID SEMUA SPESIES -->
    <section class="px-10 py-20 bg-[#06111d]">
        <div class="flex items-center justify-between mb-12 border-b border-white/5 pb-6">
            <h2 class="text-3xl font-bold">Semua Spesies</h2>
            <p class="px-4 py-2 bg-white/5 rounded-lg text-cyan-400 font-bold text-sm border border-white/10">
                {{ $biotas->count() }} Terdaftar
            </p>
        </div>

        @if($biotas->isEmpty())
            <div class="py-20 text-center">
                <p class="text-white/30 text-xl italic">Spesies yang kamu cari tidak ditemukan...</p>
                <a href="{{ route('katalog.index') }}" class="text-cyan-400 underline mt-4 inline-block">Reset Pencarian</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
                @foreach($biotas as $biota)
                    <a href="{{ route('katalog.show', $biota->id) }}" 
                       class="card group rounded-[2.5rem] overflow-hidden bg-white/[0.03] border border-white/10 flex flex-col h-full">
                        
                        <!-- GAMBAR: Diambil dari link yang kamu masukin di CSV -->
                        <div class="relative h-64 overflow-hidden bg-slate-900">
                            <img src="{{ $biota->gambar_url }}" 
                                 alt="{{ $biota->nama_biota }}"
                                 class="w-full h-full object-cover"
                                 onerror="this.src='https://images.unsplash.com/photo-1524704796725-9fc3044a58b2?q=80'">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#06111d] to-transparent opacity-60"></div>
                        </div>

                        <!-- INFO -->
                        <div class="p-6 flex flex-col flex-1">
                            <p class="text-cyan-400 text-[10px] uppercase font-black tracking-[0.2em] mb-3">
                                {{ $biota->kategori }}
                            </p>

                            <h3 class="text-xl font-bold leading-tight mb-2 group-hover:text-cyan-300 transition">
                                {{ $biota->nama_biota }}
                            </h3>

                            <p class="italic text-white/40 text-xs mb-6 flex-1">
                                {{ $biota->nama_ilmiah }}
                            </p>

                            <div class="pt-4 border-t border-white/5 flex items-center justify-between">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-white/5 text-white/60 border border-white/10 uppercase tracking-wider">
                                    {{ $biota->status_konservasi }}
                                </span>
                                <span class="text-cyan-400 opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>

    <!-- FOOTER -->
    <footer class="border-t border-white/5 bg-[#06111d] p-10 text-center">
        <p class="text-white/20 text-xs tracking-widest uppercase">© 2026 Sahabat Laut · Data KKP RI</p>
    </footer>

</body>
</html>