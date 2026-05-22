<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $biota->nama_biota }} - Sahabat Laut</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family:'DM Sans',sans-serif;
            background:#071325;
        }

        .font-playfair{
            font-family:'Playfair Display',serif;
        }

        .glass{
            background:rgba(13,31,62,.55);
            backdrop-filter:blur(14px);
            border:1px solid rgba(255,255,255,.07);
        }
    </style>
</head>

<body class="text-white">

<!-- NAVBAR -->
<nav class="fixed top-0 left-0 w-full z-50 px-10 py-6 flex justify-between items-center bg-black/20 backdrop-blur-md border-b border-white/5">

    <!-- KIRI -->
    <div class="flex items-center gap-6">

        <!-- BACK BUTTON -->
        <a href="{{ route('katalog.index') }}"
           class="flex items-center gap-2 text-white/70 hover:text-cyan-400 transition text-sm">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-4 h-4"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 19l-7-7 7-7"/>
            </svg>

            Kembali
        </a>

        <!-- LOGO -->
        <h1 class="font-bold text-2xl tracking-tight">
            Sahabat <span class="text-cyan-400">Laut</span>
        </h1>

    </div>

    <!-- MENU -->
    <div class="space-x-8 text-sm font-medium">

        <a href="/"
           class="text-white/70 hover:text-white transition">
            Beranda
        </a>

        <a href="/katalog"
           class="text-cyan-400 font-bold">
            Katalog
        </a>

        <a href="/regulasi"
           class="text-white/70 hover:text-white transition">
            Regulasi
        </a>

    </div>

</nav>

<!-- HERO -->
<section class="relative h-[85vh] overflow-hidden">

    <img
        src="{{ $biota->gambar_url }}"
        alt="{{ $biota->nama_biota }}"
        class="absolute inset-0 w-full h-full object-cover"
    >

    <div class="absolute inset-0 bg-gradient-to-t from-[#071325] via-[#071325]/30 to-transparent"></div>

    <div class="absolute bottom-0 left-0 px-10 pb-16">

        <p class="text-cyan-400 uppercase tracking-[0.3em] text-xs font-bold mb-4">
            Biota Dilindungi Indonesia
        </p>

        <h1 class="font-playfair text-5xl md:text-7xl font-bold mb-4 leading-tight">
            {{ $biota->nama_biota }}
        </h1>

        <p class="italic text-2xl text-white/60">
            {{ $biota->nama_ilmiah }}
        </p>

    </div>

</section>

<!-- CONTENT -->
<section class="px-6 md:px-10 py-20 bg-[#071325]">

    <div class="grid lg:grid-cols-3 gap-14">

        <!-- LEFT -->
        <div class="lg:col-span-2 space-y-14">

            <!-- DESKRIPSI -->
            <div>

                <h2 class="text-4xl font-playfair font-bold mb-6 text-cyan-400">
                    Deskripsi
                </h2>

                <p class="text-white/75 text-lg leading-relaxed">
                    {{ $biota->deskripsi }}
                </p>

            </div>

            <!-- FAKTA -->
            <div>

                <h2 class="text-4xl font-playfair font-bold mb-6 text-cyan-400">
                    Fakta Menarik
                </h2>

                <div class="grid md:grid-cols-2 gap-5">

                    @foreach($biota->fakta_array as $fakta)

                        @if(!empty($fakta))

                        <div class="glass rounded-2xl p-6">

                            <p class="text-white/80 leading-relaxed">
                                ✨ {{ $fakta }}
                            </p>

                        </div>

                        @endif

                    @endforeach

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div>

            <div class="glass rounded-[2rem] p-8 sticky top-28">

                <h2 class="text-3xl font-playfair font-bold mb-8">
                    Habitat & Distribusi
                </h2>

                <div class="space-y-5">

                    @forelse($biota->lokasi_array as $loc)

                    <div class="flex gap-4 items-center">

                        <div class="w-12 h-12 rounded-full bg-cyan-400/10 flex items-center justify-center text-cyan-400">
                            📍
                        </div>

                        <div>

                            <p class="font-bold text-white">
                                {{ $loc['nama'] }}
                            </p>

                            <p class="text-xs text-white/40">
                                {{ $loc['lat'] }}°, {{ $loc['lng'] }}°
                            </p>

                        </div>

                    </div>

                    @empty

                    <p class="text-white/40 italic text-sm">
                        Data distribusi belum tersedia.
                    </p>

                    @endforelse

                </div>

                <!-- STATUS -->
                <div class="mt-10 pt-6 border-t border-white/10">

                    <p class="text-xs uppercase tracking-widest text-white/40 mb-3">
                        Status Konservasi
                    </p>

                    <div class="bg-red-500/10 border border-red-500/30 text-red-400 py-3 rounded-xl text-center font-bold">
                        {{ $biota->status_konservasi }}
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- SPESIES TERKAIT -->
    <div class="mt-24">

        <div class="flex items-center justify-between mb-8">

            <h2 class="text-4xl font-playfair font-bold">
                Spesies Terkait
            </h2>

            <a href="{{ route('katalog.index') }}"
               class="text-cyan-400 hover:text-cyan-300 transition text-sm">
                Lihat Semua →
            </a>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @foreach($spesiesTerkait as $rel)

                <a href="{{ route('katalog.show', $rel->id) }}"
                   class="group rounded-[2rem] overflow-hidden bg-white/[0.03] border border-white/10 hover:border-cyan-400 transition duration-300">

                    <!-- IMAGE -->
                    <div class="relative h-64 overflow-hidden">

                        <img
                            src="{{ $rel->gambar_url }}"
                            alt="{{ $rel->nama_biota }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                        >

                        <div class="absolute inset-0 bg-gradient-to-t from-[#071325] to-transparent opacity-70"></div>

                    </div>

                    <!-- CONTENT -->
                    <div class="p-5">

                        <p class="text-cyan-400 text-[10px] uppercase tracking-[0.2em] font-bold mb-2">
                            {{ $rel->kategori }}
                        </p>

                        <h3 class="text-lg font-bold mb-1 group-hover:text-cyan-300 transition">
                            {{ $rel->nama_biota }}
                        </h3>

                        <p class="text-white/40 italic text-xs">
                            {{ $rel->nama_ilmiah }}
                        </p>

                    </div>

                </a>

            @endforeach

        </div>

    </div>

</section>

<!-- FOOTER -->
<footer class="border-t border-white/5 bg-[#050e1b] py-10 text-center">

    <p class="text-white/20 text-xs tracking-[0.25em] uppercase">
        © 2026 Sahabat Laut · Data KKP RI
    </p>

<!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="mb-2">&copy; 2024 Sahabat Laut. Semua hak dilindungi.</p>
            <p class="text-gray-400">Mari bersama menjaga kelestarian laut Indonesia</p>
        </div>
    </footer>

</body>
</html>