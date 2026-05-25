<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kumpulan Berita - Sahabat Laut</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans">

    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('landing') }}" class="text-xl font-bold text-blue-600">Sahabat Laut</a>
            <a href="{{ route('landing') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500 transition-colors">Kembali ke Beranda</a>
        </div>  
    </nav>

    <header class="bg-white border-b border-gray-100 py-12 mb-12">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Semua Berita & Edukasi</h1>
            <p class="text-gray-500 text-sm md:text-base">Jelajahi seluruh informasi, artikel, dan kabar terbaru mengenai konservasi laut Indonesia bersama Sahabat Laut.</p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 pb-24">
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
                    <p class="text-gray-400 font-medium">Belum ada data berita yang dipublikasikan saat ini.</p>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="bg-gray-900 text-white py-12 mt-auto">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="mb-2">&copy; 2024 Sahabat Laut. Semua hak dilindungi.</p>
            <p class="text-gray-400 text-sm">Mari bersama menjaga kelestarian laut Indonesia</p>
        </div>
    </footer>

</body>
</html>