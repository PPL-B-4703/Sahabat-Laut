<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regulasi - Sahabat Laut</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: #07192b;
        }

        .hero {
            background:
                linear-gradient(to right, rgba(7,25,43,0.92), rgba(7,25,43,0.55)),
                url('https://images.unsplash.com/photo-1518837695005-2083093ee35b?q=80&w=1800');
            background-size: cover;
            background-position: center;
        }

        .glass {
            background: rgba(255,255,255,0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.08);
        }
    </style>
</head>

<body class="text-white">

<!-- NAVBAR -->
<nav class="fixed top-0 left-0 w-full z-50 px-10 py-6 flex justify-between items-center bg-black/20 backdrop-blur-md border-b border-white/5">

    <h1 class="font-bold text-2xl tracking-tight">
        Sahabat <span class="text-cyan-400">Laut</span>
    </h1>

    <div class="space-x-8 text-sm font-medium">
        <a href="/"
           class="text-white/70 hover:text-white transition">
            Beranda
        </a>

        <a href="/katalog"
           class="text-white/70 hover:text-white transition">
            Katalog
        </a>

        <a href="/regulasi"
           class="text-cyan-400 font-bold">
            Regulasi
        </a>
    </div>

</nav>

<!-- HERO -->
<section class="hero min-h-[55vh] flex items-center px-10 pt-24">

    <div class="max-w-3xl">

        <p class="uppercase tracking-[0.3em] text-cyan-400 text-xs font-bold mb-5">
            Dasar Hukum Konservasi
        </p>

        <h1 class="text-6xl md:text-7xl font-extrabold leading-tight mb-6">
            Library <span class="text-cyan-400">Regulasi</span>
        </h1>

        <p class="text-white/60 text-lg leading-relaxed">
            Kumpulan regulasi resmi pemerintah Indonesia terkait perlindungan,
            konservasi, dan pemanfaatan biota laut yang dilindungi.
        </p>

    </div>

</section>

<!-- CONTENT -->
<section class="px-6 md:px-10 py-20 bg-[#06111d]">

    <div class="max-w-7xl mx-auto">

        <!-- CARD -->
        <div class="glass rounded-[2rem] overflow-hidden shadow-2xl">

            <!-- HEADER -->
            <div class="p-8 border-b border-white/10">

                <p class="text-cyan-400 uppercase tracking-[0.25em] text-xs font-bold mb-3">
                    Regulasi Resmi
                </p>

                <h2 class="text-3xl md:text-4xl font-bold leading-tight mb-4">
                    PERMEN KP Nomor 106 Tahun 2018
                </h2>

                <p class="text-white/55 leading-relaxed max-w-4xl">
                    Penetapan Jenis Ikan yang Dilindungi dan aturan konservasi
                    spesies laut di wilayah Indonesia berdasarkan ketentuan
                    Kementerian Kelautan dan Perikanan Republik Indonesia.
                </p>

            </div>

            <!-- PDF -->
            <div class="bg-white">

                <iframe
                    src="{{ asset('peraturan.pdf') }}"
                    class="w-full h-[950px]">
                </iframe>

            </div>

        </div>

    </div>

</section>

<!-- FOOTER -->
<footer class="border-t border-white/5 bg-[#050e1b] py-10 text-center">

    <p class="text-white/20 text-xs tracking-[0.25em] uppercase">
        © 2026 Sahabat Laut · Data KKP RI
    </p>

</footer>

</body>
</html>