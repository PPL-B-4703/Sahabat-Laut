<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }} - Sahabat Laut</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans">

    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('landing') }}" class="text-xl font-bold text-blue-600">Sahabat Laut</a>
            <a href="{{ route('landing') }}" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">&larr; Kembali ke Beranda</a>
        </div>
    </nav>

    <main class="py-12 max-w-4xl mx-auto px-6">
        <article>
            @if($berita->tag)
                <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">{{ $berita->tag }}</span>
            @endif

            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2 mb-4 leading-tight">
                {{ $berita->judul }}
            </h1>

            <div class="flex items-center gap-3 text-sm text-gray-500 mb-8 border-b border-gray-100 pb-4">
                <p>Oleh: <strong class="text-gray-700">{{ $berita->penulis }}</strong></p>
                <span>•</span>
                <p>{{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->format('d F Y') }}</p>
            </div>

            @if($berita->gambar)
                <div class="mb-8 rounded-2xl overflow-hidden shadow-md max-h-[450px] bg-gray-100">
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover">
                </div>
            @endif

            <div class="prose max-w-none text-gray-700 leading-relaxed space-y-6 text-base md:text-lg">
                {!! nl2br(e($berita->isi)) !!}
            </div>

            @if($berita->referensi)
                <div class="mt-12 pt-6 border-t border-gray-200">
                    <h4 class="text-sm font-bold text-gray-900 mb-2">Referensi & Sumber:</h4>
                    <p class="text-sm text-gray-500 italic">{{ $berita->referensi }}</p>
                </div>
            @endif
        </article>
    </main>

    <footer class="bg-gray-900 text-white py-8 mt-20 border-t border-gray-800">
        <div class="max-w-4xl mx-auto px-6 text-center text-sm text-gray-400">
            <p>&copy; 2024 Sahabat Laut. Mari bersama menjaga kelestarian laut Indonesia.</p>
        </div>
    </footer>

</body>
</html>