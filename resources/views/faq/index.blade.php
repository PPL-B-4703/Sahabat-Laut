<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Bantuan - Sahabat Laut</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: #07192b; /* Samain dengan Regulasi */
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

<nav class="fixed top-0 left-0 w-full z-50 px-10 py-6 flex justify-between items-center bg-black/20 backdrop-blur-md border-b border-white/5">

    <h1 class="font-bold text-2xl tracking-tight">
        Sahabat <span class="text-cyan-400">Laut</span>
    </h1>

    <div class="space-x-8 text-sm font-medium">
        <a href="/" class="text-white/70 hover:text-white transition">
            Beranda
        </a>

        <a href="{{ route('katalog.index') }}" class="text-white/70 hover:text-white transition">
            Katalog
        </a>

        <a href="/regulasi" class="text-white/70 hover:text-white transition">
            Regulasi
        </a>

        <a href="{{ route('faq.index') }}" class="text-cyan-400 font-bold">
            Pusat Bantuan
        </a>
    </div>

</nav>

<section class="hero min-h-[45vh] flex items-center px-10 pt-24">
    <div class="max-w-3xl">
        <p class="uppercase tracking-[0.3em] text-cyan-400 text-xs font-bold mb-5">
            Informasi & Bantuan
        </p>

        <h1 class="text-6xl md:text-7xl font-extrabold leading-tight mb-6">
            Pusat <span class="text-cyan-400">Bantuan</span>
        </h1>

        <p class="text-white/60 text-lg leading-relaxed">
            Cari tahu lebih dalam mengenai Sahabat Laut. 
            Temukan jawabanmu dan mari mulai berkontribusi untuk masa depan laut yang lebih sehat.
        </p>
    </div>
</section>

<section class="px-6 md:px-10 py-20 bg-[#06111d]">
    <div class="max-w-4xl mx-auto">
        
        <div class="space-y-5">
            @foreach($faqs as $faq)
            <div class="glass rounded-[1.5rem] overflow-hidden transition-all duration-300 hover:border-cyan-400/30">
                <button onclick="toggleFaq({{ $faq->id }})" class="w-full flex justify-between items-center p-7 text-left hover:bg-white/5 transition-all">
                    <span class="font-bold text-white text-lg">{{ $faq->question }}</span>
                    <svg id="icon-{{ $faq->id }}" class="w-6 h-6 text-cyan-400 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="answer-{{ $faq->id }}" class="hidden p-7 bg-black/20 text-white/70 leading-relaxed border-t border-white/5 italic">
                    {{ $faq->answer }}
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

<footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <p class="mb-2">&copy; 2024 Sahabat Laut. Semua hak dilindungi.</p>
        <p class="text-gray-400">Mari bersama menjaga kelestarian laut Indonesia</p>
    </div>
</footer>

<script>
    function toggleFaq(id) {
        const answer = document.getElementById(`answer-${id}`);
        const icon = document.getElementById(`icon-${id}`);
        answer.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }
</script>

</body>
</html>