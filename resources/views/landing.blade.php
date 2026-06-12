<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sahabat Laut - Lihat Laut dengan Jelas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        /* Mencegah elemen berkedip sebelum Alpine.js termuat */
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-white">
    
    <div x-data="{
            activeSlide: 0,
            slides: @js([
                asset('images/backgrounds/Background-Landing.jpg'),
                asset('images/backgrounds/Background-Landing2.jpg'),
                asset('images/backgrounds/Background-Landing3.jpg'),
                asset('images/backgrounds/Background-Landing4.jpg'),
                asset('images/backgrounds/Background-Landing5.jpg')
            ]),
            next() { this.activeSlide = (this.activeSlide === this.slides.length - 1) ? 0 : this.activeSlide + 1; },
            prev() { this.activeSlide = (this.activeSlide === 0) ? this.slides.length - 1 : this.activeSlide - 1; }
         }"
         x-init="setInterval(() => next(), 5000)"
         class="relative min-h-screen overflow-hidden bg-gray-900">

        <div class="absolute inset-0 z-0 flex transition-transform duration-700 ease-in-out h-full"
             :style="`transform: translateX(-${activeSlide * 100}%);`">

            <template x-for="(slide, index) in slides" :key="index">
                <div class="w-full h-full min-w-full flex-shrink-0 bg-cover bg-center bg-no-repeat"
                     :style="`background-image: url('${slide}');`">
                </div>
            </template>
        </div>

        <div class="absolute inset-0 bg-black/25 z-10"></div>

        <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 z-30 p-2 text-white/50 hover:text-white transition">
            <svg class="w-10 h-10 drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </button>
        <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 z-30 p-2 text-white/50 hover:text-white transition">
            <svg class="w-10 h-10 drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>

        <header class="relative z-20">
            <nav class="w-full px-6 md:px-12 py-4 flex justify-between items-center">
                <div class="text-2xl font-bold text-white drop-shadow-lg">
                    Sahabat Laut
                </div>
                <div class="hidden md:flex gap-16">
                    <a href="{{ route('katalog.index') }}" class="text-white hover:text-cyan-200 font-medium transition drop-shadow-md px-4 py-2 border border-white/30 rounded-lg hover:border-cyan-200">Katalog</a>
                    <a href="{{ route('regulasi') }}" class="text-white hover:text-cyan-200 px-4 py-2 border border-white/30 rounded-lg">Regulasi</a>
                    <a href="{{ route('faq.index') }}" class="text-white hover:text-cyan-200 font-medium transition drop-shadow-md px-4 py-2 border border-white/30 rounded-lg hover:border-cyan-200">Pusat Bantuan</a>
                </div>
                <div class="flex items-center gap-4">
                    <button class="md:hidden text-white drop-shadow-md">☰</button>
                    <a href="{{ route('login') }}" class="bg-white text-blue-600 px-6 py-2 rounded-lg hover:bg-white/90 font-medium transition">
                        Login
                    </a>
                </div>
            </nav>
        </header>

        <section class="relative z-20 flex flex-col justify-start pt-20 pointer-events-none" style="height: calc(100vh - 80px);">
            <div class="w-full px-6 md:px-12 py-8 pointer-events-auto">
                <div class="space-y-6 max-w-2xl">
                    <h1 class="text-5xl md:text-6xl font-bold text-white leading-tight drop-shadow-2xl">
                        Lihat Laut dengan <span class="text-cyan-200">Jelas</span>
                    </h1>
                    <p class="text-lg text-white leading-relaxed drop-shadow-lg">
                        Jelajahi keindahan dan kekayaan laut Indonesia. Pelajari ekosistem laut, spesies laut, dan cara menjaganya bersama Sahabat Laut.
                    </p>
                    <div class="flex gap-4 pt-4">
                        <a href="/login" class="bg-white text-blue-600 px-8 py-3 rounded-lg hover:bg-white/90 font-semibold transition">
                            Mulai Sekarang
                        </a>
                    </div>
                </div>
            </div>

            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10 pointer-events-auto">
                <div class="animate-bounce text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>
            </div>
        </section>
    </div>

        <div x-show="openLightbox" 
             x-cloak
             x-transition.opacity.duration.300ms
             class="fixed inset-0 z-[100] flex items-center justify-center bg-black/90 p-4 backdrop-blur-sm"
             @keydown.escape.window="openLightbox = false">
            
            <div class="absolute inset-0 cursor-pointer" @click="openLightbox = false"></div>
            
            <button @click="openLightbox = false" class="absolute top-6 right-6 text-white hover:text-red-400 z-[110]">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <img src="{{ asset('images/biota/penyu.jpg') }}" alt="Gambar Penyu Besar" class="relative z-[105] max-w-full max-h-full rounded-lg shadow-2xl border-2 border-white/20">
        </div>
    </section>


    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-12">
                Mengapa Sahabat Laut?
            </h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center space-y-4 p-6">
                    <p class="text-4xl">📚</p>
                    <h3 class="text-xl font-semibold text-gray-900">Edukasi Laut</h3>
                    <p class="text-gray-600">Pelajari informasi lengkap tentang ekosistem dan spesies laut</p>
                </div>
                <div class="text-center space-y-4 p-6">
                    <p class="text-4xl">🛡️</p>
                    <h3 class="text-xl font-semibold text-gray-900">Konservasi</h3>
                    <p class="text-gray-600">Berkontribusi dalam menjaga kelestarian laut Indonesia</p>
                </div>
                <div class="text-center space-y-4 p-6">
                    <p class="text-4xl">👥</p>
                    <h3 class="text-xl font-semibold text-gray-900">Komunitas</h3>
                    <p class="text-gray-600">Terhubung dengan pecinta laut dari seluruh Indonesia</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-4xl font-bold text-gray-900 mb-12">
                Berita Terbaru
            </h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow p-6 h-64 flex items-center justify-center">
                    <p class="text-gray-400 text-center">Berita akan ditampilkan di sini</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6 h-64 flex items-center justify-center">
                    <p class="text-gray-400 text-center">Berita akan ditampilkan di sini</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6 h-64 flex items-center justify-center">
                    <p class="text-gray-400 text-center">Berita akan ditampilkan di sini</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="mb-2">&copy; 2024 Sahabat Laut. Semua hak dilindungi.</p>
            <p class="text-gray-400">Mari bersama menjaga kelestarian laut Indonesia</p>
        </div>
    </footer>
</body>
</html>