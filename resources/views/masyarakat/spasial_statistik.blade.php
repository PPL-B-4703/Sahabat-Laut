<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spasial Statistik - Sahabat Laut</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            /* PASTIKAN FILE GAMBAR ADA DI FOLDER: public/images/bg-spasial.jpg */
            background-image: url("{{ asset('images/bg-spasial.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-color: #004d6b;
        }
        .glass-text { color: white; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4); }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.1); }
        ::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.3); border-radius: 10px; }
        
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;utf8,<svg fill='white' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
            background-repeat: no-repeat;
            background-position-x: 95%;
            background-position-y: 5px;
        }
    </style>
</head>
<body class="overflow-x-hidden min-h-screen">

    <header class="fixed top-0 left-0 w-full h-[100px] flex items-center justify-between px-12 z-[100] bg-[#0077a9]/10 backdrop-blur-md border-b border-white/10">
        <div class="flex items-center gap-4">
            <img src="{{ asset('images/logo.png') }}" class="w-12 h-12 object-contain mix-blend-multiply" alt="Logo">
            <h1 class="font-['Work_Sans'] font-semibold text-white text-3xl tracking-tight glass-text">Sahabat Laut</h1>
        </div>
        <nav class="hidden md:flex gap-10">
            <a href="{{ route('dashboard') }}" class="text-white/80 font-medium hover:text-white transition-all">Beranda</a>
            <a href="#" class="text-white/80 font-medium hover:text-white transition-all">Katalog</a>
        </nav>
        <div class="flex items-center gap-8">
            <a href="{{ route('masyarakat.profil.edit') }}" class="flex items-center gap-3 bg-white/10 hover:bg-white/20 transition-all p-1 pr-4 rounded-full border border-white/20 backdrop-blur-sm">
                <div class="w-10 h-10 rounded-full border-2 border-white bg-white overflow-hidden shadow-lg">
                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->first_name . ' ' . $user->last_name).'&background=random' }}" alt="Profile">
                </div>
                <span class="font-semibold text-white text-sm glass-text">{{ $user->first_name }} {{ $user->last_name }}</span>
            </a>
        </div>
    </header>

    <main class="pt-[130px] px-12 pb-20 w-full max-w-[1440px] mx-auto flex flex-col gap-10 items-center">
        
        <form method="GET" action="{{ route('masyarakat.statistik') }}" class="w-full flex gap-10 justify-start px-4">
            <div class="flex flex-col gap-2">
                <label class="text-white text-sm font-medium">Spesies <span class="text-red-500">*</span></label>
                <select name="spesies" onchange="this.form.submit()" class="w-[331px] h-[39px] rounded-[5px] border border-[#FFF9F9] bg-transparent text-white px-4 outline-none cursor-pointer">
                    <option class="text-black" value="">Semua Spesies</option>
                    <option class="text-black" value="Mamalia Laut" {{ request('spesies') == 'Mamalia Laut' ? 'selected' : '' }}>Mamalia Laut</option>
                    <option class="text-black" value="Reptil Laut" {{ request('spesies') == 'Reptil Laut' ? 'selected' : '' }}>Reptil Laut</option>
                    <option class="text-black" value="Hiu dan Pari" {{ request('spesies') == 'Hiu dan Pari' ? 'selected' : '' }}>Hiu dan Pari</option>
                    <option class="text-black" value="Ikan Laut" {{ request('spesies') == 'Ikan Laut' ? 'selected' : '' }}>Ikan Laut</option>
                    <option class="text-black" value="Terumbu Karang" {{ request('spesies') == 'Terumbu Karang' ? 'selected' : '' }}>Terumbu Karang</option>
                    <option class="text-black" value="Lainnya" {{ request('spesies') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-white text-sm font-medium">Tahun <span class="text-red-500">*</span></label>
                <select name="tahun" onchange="this.form.submit()" class="w-[331px] h-[39px] rounded-[5px] border border-[#FFF9F9] bg-transparent text-white px-4 outline-none cursor-pointer">
                    <option class="text-black" value="">Semua Tahun</option>
                    <option class="text-black" value="2026" {{ request('tahun') == '2026' ? 'selected' : '' }}>2026</option>
                    <option class="text-black" value="2025" {{ request('tahun') == '2025' ? 'selected' : '' }}>2025</option>
                    <option class="text-black" value="2024" {{ request('tahun') == '2024' ? 'selected' : '' }}>2024</option>
                </select>
            </div>
        </form>

        <div class="w-full flex justify-center gap-8 flex-wrap">
            <div class="w-[328px] h-[104px] rounded-[15px] shadow-[50px_60px_100px_0_rgba(0,0,0,0.05)] flex flex-col items-center justify-center border border-white/20"
                 style="background: linear-gradient(113deg, rgba(255, 255, 255, 0.51) 3.51%, rgba(255, 255, 255, 0.00) 111.71%); backdrop-filter: blur(35px);">
                <p class="text-black font-semibold text-lg text-center leading-tight">Total Laporan<br>tervalidasi</p>
                <p class="text-black font-bold text-2xl mt-1">{{ $data['total_laporan'] }}</p>
            </div>
            <div class="w-[328px] h-[104px] rounded-[15px] shadow-[50px_60px_100px_0_rgba(0,0,0,0.05)] flex flex-col items-center justify-center border border-white/20"
                 style="background: linear-gradient(113deg, rgba(255, 255, 255, 0.51) 3.51%, rgba(255, 255, 255, 0.00) 111.71%); backdrop-filter: blur(35px);">
                <p class="text-black font-semibold text-lg text-center leading-tight">Total Foto<br>Didokumentasikan</p>
                <p class="text-black font-bold text-2xl mt-1">{{ $data['total_foto'] }}</p>
            </div>
            <div class="w-[328px] h-[104px] rounded-[15px] shadow-[50px_60px_100px_0_rgba(0,0,0,0.05)] flex flex-col items-center justify-center border border-white/20"
                 style="background: linear-gradient(113deg, rgba(255, 255, 255, 0.51) 3.51%, rgba(255, 255, 255, 0.00) 111.71%); backdrop-filter: blur(35px);">
                <p class="text-black font-semibold text-lg text-center leading-tight">Total<br>Kontributor</p>
                <p class="text-black font-bold text-2xl mt-1">{{ $data['total_kontributor'] }}</p>
            </div>
        </div>

        <div class="w-full flex flex-col mt-4 px-4">
            <h3 class="text-white font-bold text-2xl mb-6 glass-text text-center tracking-wide">Peta Persebaran Biota Laut (Tervalidasi)</h3>
            <div id="map" class="w-full h-[600px] rounded-[20px] shadow-[0_20px_50px_rgba(0,0,0,0.3)] border border-white/40 z-10"></div>
        </div>

        <div class="w-full px-4 mt-8">
            <div class="w-full bg-white/70 backdrop-blur-md border border-white/40 rounded-[16px] p-8 shadow-xl">
                <h3 class="text-black font-bold text-xl mb-6">Detail Laporan Valid</h3>
                <div class="w-full overflow-hidden rounded-xl border border-black/5">
                    <table class="w-full text-left text-sm text-black">
                        <thead class="bg-white/90 border-b border-black/10 font-bold text-gray-700">
                            <tr>
                                <th class="px-6 py-4">TANGGAL KEJADIAN</th>
                                <th class="px-6 py-4">Spesies</th>
                                <th class="px-6 py-4">Alamat Lokasi</th>
                                <th class="px-6 py-4">Aktivitas</th>
                                <th class="px-6 py-4">Verifikator</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['laporan_valid'] as $laporan)
                            <tr class="border-b border-black/10 hover:bg-black/5 transition-colors font-medium">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $laporan['tanggal'] }}</td>
                                <td class="px-6 py-4 capitalize">{{ $laporan['spesies'] }}</td>
                                <td class="px-6 py-4">{{ $laporan['lokasi'] }}</td>
                                <td class="px-6 py-4">{{ $laporan['aktivitas'] }}</td>
                                <td class="px-6 py-4">{{ $laporan['verifikator'] }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-700 font-semibold italic">Belum ada laporan tervalidasi untuk filter ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi Peta (Titik tengah Indonesia)
            var map = L.map('map').setView([-2.5489, 118.0149], 5);

            // Tambahkan Tile Layer (Peta Dasar)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // Parsing Data JSON dari Controller
            var titikLaporan = @json($dataPeta);

            // Render marker ke peta
            titikLaporan.forEach(function(laporan) {
                if(laporan.latitude && laporan.longitude) {
                    var marker = L.marker([laporan.latitude, laporan.longitude]).addTo(map);
                    
                    // --- LOGIKA BARU: Tampilkan Foto Dokumentasi ---
                    var imageBaseUrl = '/storage/laporan/'; // Folder tempat foto disimpan (sesuai LaporanController)
                    var imageHtml = '';

                    // Cek apakah ada attachments dan formatnya array
                    if(Array.isArray(laporan.attachments) && laporan.attachments.length > 0) {
                        // Bungkus dalam container flexbox agar rapi jika ada banyak foto
                        imageHtml += '<div style="display: flex; gap: 5px; overflow-x: auto; padding-bottom: 5px; margin-top: 5px;">';
                        laporan.attachments.forEach(function(fileName) {
                            var imgUrl = imageBaseUrl + fileName;
                            imageHtml += `<img src="${imgUrl}" alt="Dokumentasi" style="width: 100px; hieght: 75px; object-fit: cover; border-radius: 5px; border: 1px solid #ccc;">`;
                        });
                        imageHtml += '</div>';
                    }

                    // Tampilkan di popup
                    var popupContent = `
                        <div style="font-family: 'Poppins', sans-serif; max-width: 250px;">
                            <b style="font-size: 15px; color: #0077a9; text-transform: capitalize;">${laporan.species}</b><br>
                            <span style="font-size: 13px; color: gray;">${laporan.tanggal_temuan}</span><br>
                            
                            ${imageHtml} {{-- Tampilkan Foto di sini --}}
                            
                            <div style="margin-top: 5px; font-size: 13px; max-height: 100px; overflow-y: auto;">
                                <b>Aktivitas:</b> ${laporan.aktivitas}<br>
                                <b>Lokasi:</b> ${laporan.alamat_lokasi}
                            </div>
                        </div>
                    `;
                    marker.bindPopup(popupContent);
                }
            });
        });
    </script>
</body>
</html>