<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sahabat Laut - Lihat Laut dengan Jelas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">
    <!-- Header -->
    <header class="fixed top-0 w-full bg-gradient-to-r from-blue-500 via-blue-500 to-cyan-500 z-50">
        <nav class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-white">
                🌊 Sahabat Laut
            </div>
            <div class="hidden md:flex gap-8">
                <a href="#" class="text-white hover:text-white/80 font-medium transition">Beranda</a>
                <a href="#" class="text-white hover:text-white/80 font-medium transition">Katalog</a>
            </div>
            <div class="flex items-center gap-4">
                <button class="md:hidden text-white">☰</button>
                <a href="/login" class="bg-white text-blue-600 px-6 py-2 rounded-lg hover:bg-white/90 font-medium transition">
                    Login
                </a>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="pt-20 min-h-screen flex items-center justify-center relative overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('https://via.placeholder.com/1600x900?text=Penyu+di+Laut'); filter: brightness(0.6);">
        </div>
        
        <!-- Ocean Blue Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-blue-500/60 via-blue-500/70 to-cyan-500/60"></div>

        <div class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center relative z-10">
            <!-- Left Content -->
            <div class="space-y-6">
                <h1 class="text-5xl md:text-6xl font-bold text-white leading-tight">
                    Lihat Laut dengan <span class="text-cyan-300">Jelas</span>
                </h1>
                <p class="text-lg text-gray-100 leading-relaxed">
                    Jelajahi keindahan dan kekayaan laut Indonesia. Pelajari ekosistem laut, spesies laut, dan cara menjaganya bersama Sahabat Laut.
                </p>
                <div class="flex gap-4 pt-4">
                    <a href="/login" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 font-semibold transition">
                        Mulai Sekarang
                    </a>
                    <button class="border-2 border-white text-white px-8 py-3 rounded-lg hover:bg-white/10 font-semibold transition">
                        Pelajari Lebih Lanjut
                    </button>
                </div>
            </div>

            <!-- Right Side Empty (fokus ke background image) -->
            <div></div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2">
            <div class="animate-bounce text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </section>

    <!-- Features Section (Optional) -->
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

    <!-- News Section Placeholder -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-4xl font-bold text-gray-900 mb-12">
                Berita Terbaru
            </h2>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- News cards akan ditambahkan di sini -->
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

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="mb-2">&copy; 2024 Sahabat Laut. Semua hak dilindungi.</p>
            <p class="text-gray-400">Mari bersama menjaga kelestarian laut Indonesia</p>
        </div>
    </footer>
</body>
</html>