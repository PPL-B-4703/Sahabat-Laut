<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sahabat Laut - Lihat Laut dengan Jelas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">
    <!-- Combined Header + Hero Section with Seamless Background -->
    <div class="relative min-h-screen bg-cover bg-center bg-no-repeat overflow-hidden" style="background-image: url('{{ asset('images/backgrounds/Background-Landing.jpg') }}');">
        <!-- Dark Overlay untuk readability text -->
        <div class="absolute inset-0 bg-black/25"></div>

        <!-- Header -->
        <header class="relative z-20">
            <nav class="w-full px-6 md:px-12 py-4 flex justify-between items-center">
                <div class="text-2xl font-bold text-white drop-shadow-lg">
                    Sahabat Laut
                </div>
                <div class="hidden md:flex gap-16">
                    <a href="#" class="text-white hover:text-cyan-200 font-medium transition drop-shadow-md px-4 py-2 border border-white/30 rounded-lg hover:border-cyan-200">Beranda</a>
                    <a href="#" class="text-white hover:text-cyan-200 font-medium transition drop-shadow-md px-4 py-2 border border-white/30 rounded-lg hover:border-cyan-200">Katalog</a>
                </div>
                <div class="flex items-center gap-4">
                    <button class="md:hidden text-white drop-shadow-md">☰</button>
                    <a href="/login" class="bg-white text-blue-600 px-6 py-2 rounded-lg hover:bg-white/90 font-medium transition">
                        Login
                    </a>
                </div>
            </nav>
        </header>

        <!-- Hero Section Content -->
        <section class="relative z-10 flex flex-col justify-start pt-20" style="height: calc(100vh - 80px);">
            <div class="w-full px-6 md:px-12 py-8">
                <!-- Left Content -->
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

            <!-- Scroll Indicator -->
            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10">
                <div class="animate-bounce text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>
            </div>
        </section>
    </div>

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
            
            <div class="flex justify-between items-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900">
                    Berita Terbaru
                </h2>
                <a href="{{ route('user.berita.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-500 flex items-center gap-1 transition-colors group">
                    Lihat Semua Berita <span class="transform group-hover:translate-x-1 transition-transform"></span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($beritas as $item)
                    <div class="bg-white rounded-xl overflow-hidden shadow-md border border-gray-100 flex flex-col hover:shadow-lg transition-all duration-300">
                        
                        <div class="h-48 w-full bg-gray-200 overflow-hidden relative">
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                        </div>

                        <div class="p-6 flex flex-col flex-grow text-left">
                            <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                                <span>Oleh: <strong class="text-gray-700">{{ $item->penulis }}</strong></span>
                                <span>•</span>
                                <span>{{ \Carbon\Carbon::parse($item->tanggal_publikasi)->format('d M Y') }}</span>
                            </div>

                            <h3 class="font-bold text-lg text-gray-900 line-clamp-2 hover:text-blue-600 transition-colors mb-2">
                                <a href="{{ route('user.berita.show', $item->id) }}">{{ $item->judul }}</a>
                            </h3>
                            
                            <p class="text-sm text-gray-600 line-clamp-3 flex-grow mb-4">
                                {{ strip_tags($item->isi) }}
                            </p>

                            <div class="pt-4 border-t border-gray-100 mt-auto">
                                <a href="{{ route('user.berita.show', $item->id) }}" class="text-xs font-bold text-blue-600 hover:underline inline-flex items-center gap-1">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-3 bg-white rounded-lg shadow p-12 text-center flex flex-col items-center justify-center border border-gray-200">
                        <p class="text-gray-400 font-medium">Belum ada data berita terbaru saat ini.</p>
                        <p class="text-xs text-gray-400 mt-1">Gunakan akun admin untuk menginput publikasi berita baru.</p>
                    </div>
                @endforelse
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