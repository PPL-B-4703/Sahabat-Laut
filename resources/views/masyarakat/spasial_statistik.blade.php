<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spasial Statistik - Sahabat Laut</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            /* PATH BACKGROUND DIPERBARUI MENGGUNAKAN ASSET */
            background-image: url("{{ asset('storage/images/bg-spasial.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-color: #004d6b; /* Warna cadangan kalau gambar telat muat */
        }
        .glass-text { color: white; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4); }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.1); }
        ::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.3); border-radius: 10px; }
        
        /* Custom CSS Dropdown Select Arrow White */
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

    <!-- HEADER -->
    <header class="fixed top-0 left-0 w-full h-[100px] flex items-center justify-between px-12 z-[100] bg-[#0077a9]/10 backdrop-blur-md border-b border-white/10">
        <div class="flex items-center gap-4">
            <img src="{{ asset('storage/images/logo.png') }}" class="w-12 h-12 object-contain mix-blend-multiply" alt="Logo">
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

    <!-- MAIN CONTENT -->
    <main class="pt-[130px] px-12 pb-20 w-full max-w-[1440px] mx-auto flex flex-col gap-10 items-center">
        
        <!-- SECTION 1: DROPDOWNS -->
        <div class="w-full flex gap-10 justify-start px-4">
            <div class="flex flex-col gap-2">
                <label class="text-white text-sm font-medium">Spesies <span class="text-red-500">*</span></label>
                <!-- DROPDOWN SPESIES SUDAH DILENGKAPI -->
                <select class="w-[331px] h-[39px] rounded-[5px] border border-[#FFF9F9] bg-transparent text-white px-4 outline-none cursor-pointer">
                    <option class="text-black" value="">Semua Spesies</option>
                    <option class="text-black" value="mamalia">Mamalia Laut</option>
                    <option class="text-black" value="reptil">Reptil Laut</option>
                    <option class="text-black" value="hiu_pari">Hiu dan Pari</option>
                    <option class="text-black" value="ikan">Ikan laut</option>
                    <option class="text-black" value="terumbu_karang">Terumbu Karang</option>
                    <option class="text-black" value="lainnya">Lainnya</option>
                </select>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-white text-sm font-medium">Tahun <span class="text-red-500">*</span></label>
                <select class="w-[331px] h-[39px] rounded-[5px] border border-[#FFF9F9] bg-transparent text-white px-4 outline-none cursor-pointer">
                    <option class="text-black" value="2026">2026</option>
                    <option class="text-black" value="2025">2025</option>
                </select>
            </div>
        </div>

        <!-- SECTION 2: 3 SUMMARY CARDS -->
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

        <!-- SECTION 3: CHARTS -->
        <div class="w-full flex justify-center gap-8 flex-wrap lg:flex-nowrap">
            
            <div class="w-[467px] h-[650px] rounded-[12px] border-[0.5px] border-[#C9DBF9] p-[25px] flex flex-col items-center shadow-xl"
                 style="background: rgba(255, 255, 255, 0.62);">
                <h3 class="text-black font-bold text-sm self-start w-full mb-[103px]">Rasio Kondisi Temuan Mamalia Laut</h3>
                
                <div class="w-[232px] h-[232px] rounded-full relative flex items-center justify-center shadow-inner"
                     style="background: conic-gradient(#111 0% 65%, #ff0000 65% 87%, #e5e7eb 87% 100%);">
                    <div class="w-[160px] h-[160px] bg-[#f0f4f8] rounded-full absolute mix-blend-screen"></div>
                </div>

                <div class="w-full flex flex-col gap-3 mt-auto mb-5 text-sm font-semibold text-black/80">
                    <div class="flex justify-between items-center"><span class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-[#111]"></div> Kelestarian</span> <span>65%</span></div>
                    <div class="flex justify-between items-center"><span class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-[#ff0000]"></div> Ancaman</span> <span>22%</span></div>
                    <div class="flex justify-between items-center"><span class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-[#e5e7eb]"></div> Pemantauan</span> <span>13%</span></div>
                </div>
            </div>

            <div class="w-[627px] h-[653px] rounded-[12px] border border-[#E4E2FF] p-[20px_16px_16px_16px] flex flex-col shadow-xl"
                 style="background: rgba(255, 255, 255, 0.62);">
                <h3 class="text-black font-bold text-sm mb-8">Temuan Tervalidasi Mamalia Laut</h3>
                
                <div class="flex-1 w-full flex flex-col justify-between border-l border-b border-black/20 pb-4 relative">
                    <div class="absolute inset-0 flex justify-between px-10">
                        <div class="h-full border-l border-dashed border-black/10"></div>
                        <div class="h-full border-l border-dashed border-black/10"></div>
                        <div class="h-full border-l border-dashed border-black/10"></div>
                        <div class="h-full border-l border-dashed border-black/10"></div>
                    </div>

                    <div class="w-full flex items-center gap-4 z-10 mt-4">
                        <span class="w-20 text-xs text-right text-black font-medium">Bali</span>
                        <div class="h-[35px] rounded-r-md flex items-center px-3" style="width: 85%; background: rgba(137, 121, 255, 0.8);">
                            <span class="text-xs text-white absolute right-[-25px] text-black">180</span>
                        </div>
                    </div>
                    <div class="w-full flex items-center gap-4 z-10">
                        <span class="w-20 text-xs text-right text-black font-medium">Papua Barat</span>
                        <div class="h-[35px] rounded-r-md flex items-center px-3" style="width: 65%; background: rgba(137, 121, 255, 0.8);">
                            <span class="text-xs text-white absolute right-[-25px] text-black">145</span>
                        </div>
                    </div>
                    <div class="w-full flex items-center gap-4 z-10">
                        <span class="w-20 text-xs text-right text-black font-medium">Sulawesi Utara</span>
                        <div class="h-[35px] rounded-r-md flex items-center px-3" style="width: 50%; background: rgba(137, 121, 255, 0.8);">
                            <span class="text-xs text-white absolute right-[-25px] text-black">108</span>
                        </div>
                    </div>
                    <div class="w-full flex items-center gap-4 z-10">
                        <span class="w-20 text-xs text-right text-black font-medium">NTT</span>
                        <div class="h-[35px] rounded-r-md flex items-center px-3" style="width: 40%; background: rgba(137, 121, 255, 0.8);">
                        </div>
                    </div>
                    <div class="w-full flex items-center gap-4 z-10 mb-4">
                        <span class="w-20 text-xs text-right text-black font-medium">Aceh</span>
                        <div class="h-[35px] rounded-r-md flex items-center px-3" style="width: 15%; background: rgba(137, 121, 255, 0.8);">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 4: TABLE -->
        <div class="w-full bg-white/60 backdrop-blur-md border border-white/40 rounded-[12px] p-6 shadow-xl mt-4">
            <h3 class="text-black font-bold text-lg mb-4">Detail Laporan Valid</h3>
            <div class="w-full overflow-hidden rounded-xl">
                <table class="w-full text-left text-sm text-black">
                    <thead class="bg-white border-b border-black/10 font-bold">
                        <tr>
                            <th class="px-6 py-4">TANGGAL KEJADIAN</th>
                            <th class="px-6 py-4">Spesies</th>
                            <th class="px-6 py-4">Provinsi</th>
                            <th class="px-6 py-4">Aktivitas</th>
                            <th class="px-6 py-4">Verifikator</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['laporan_valid'] as $laporan)
                        <tr class="border-b border-black/10 hover:bg-black/5 transition-colors font-medium">
                            <td class="px-6 py-4">{{ $laporan['tanggal'] }}</td>
                            <td class="px-6 py-4">{{ $laporan['spesies'] }}</td>
                            <td class="px-6 py-4">{{ $laporan['provinsi'] }}</td>
                            <td class="px-6 py-4">{{ $laporan['aktivitas'] }}</td>
                            <td class="px-6 py-4">{{ $laporan['verifikator'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </main>

</body>
</html>