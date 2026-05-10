<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Masyarakat - Sahabat Laut</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background-image: url("{{ asset('storage/images/background.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            background-color: #004d6b; 
        }

        .glass-text {
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
        }

        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="overflow-x-hidden min-h-screen">

    <div class="relative w-full min-h-screen">
        
        <header class="fixed top-0 left-0 w-full h-[100px] flex items-center justify-between px-12 z-[100] bg-[#0077a9]/10 backdrop-blur-md border-b border-white/10">
            <div class="flex items-center gap-4">
                <img src="{{ asset('storage/images/logo.png') }}" class="w-12 h-12 object-contain mix-blend-multiply" alt="Logo">
                <h1 class="font-['Work_Sans'] font-semibold text-white text-3xl tracking-tight glass-text">Sahabat Laut</h1>
            </div>

            <nav class="hidden md:flex gap-10">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'text-blue-200 font-bold border-b-2 border-blue-200' : 'text-white/80 font-medium hover:text-white' }} pb-1 transition-all">
                    Beranda
                </a>
                <a href="#" class="{{ request()->is('katalog*') ? 'text-blue-200 font-bold border-b-2 border-blue-200' : 'text-white/80 font-medium hover:text-white' }} pb-1 transition-all">
                    Katalog
                </a>
            </nav>

            <div class="flex items-center gap-8">
                <a href="{{ route('masyarakat.profil.edit') }}" class="flex items-center gap-3 bg-white/10 hover:bg-white/20 transition-all p-1 pr-4 rounded-full border border-white/20 backdrop-blur-sm cursor-pointer">
                    <div class="w-10 h-10 rounded-full border-2 border-white bg-white overflow-hidden shadow-lg">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->first_name . ' ' . $user->last_name) }}&background=random" alt="Profile">
                    </div>
                    <span class="font-semibold text-white text-sm glass-text">
                        {{ $user->first_name }} {{ $user->last_name }}
                    </span>
                </a>

                <button class="relative p-2 rounded-full hover:bg-white/10 transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute top-1.5 right-1.5 block h-2.5 w-2.5 rounded-full bg-red-600 border-2 border-[#0077a9]"></span>
                </button>
            </div>
        </header>

        <div class="flex items-start pt-[130px] px-10 pb-10 gap-10 min-h-screen">
            
            <aside class="w-72 h-fit sticky top-[120px] rounded-[32px] overflow-hidden backdrop-blur-xl bg-black/20 border border-white/20 p-8 flex flex-col z-20 text-white shadow-2xl">
                <nav class="flex flex-col gap-10">
                    <a href="#" class="flex items-center gap-4 text-white font-bold transition-all underline underline-offset-8 decoration-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('laporan.create') }}" class="flex items-center gap-4 {{ request()->routeIs('laporan.create') ? 'text-white font-bold' : 'text-white/60 hover:text-white' }} transition-all group">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                        </svg>
                        <span>Kirim Laporan</span>
                    </a>
                    <a href="{{ route('laporan.history') }}" class="flex items-center gap-4 {{ request()->routeIs('laporan.history') ? 'text-white font-bold underline underline-offset-8 decoration-2' : 'text-white/60 hover:text-white' }} transition-all group">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        <span class="{{ request()->routeIs('laporan.history') ? 'glass-text' : '' }}">History Laporan</span>
                    </a>
                    <a href="{{ route('faq.index') }}" class="flex items-center gap-4 {{ request()->routeIs('faq.index') ? 'text-white font-bold underline underline-offset-8 decoration-2' : 'text-white/60 hover:text-white' }} transition-all group">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>FAQ</span>
                    </a>
                </nav>

                <form action="{{ route('logout') }}" method="POST" class="mt-12 pt-6 border-t border-white/10">
                    @csrf
                    <button type="submit" class="flex items-center gap-4 text-white/60 hover:text-red-400 w-full transition-all group">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </aside>

            <div class="flex-1 flex gap-8 flex-col lg:flex-row">
                
                <main class="flex-1 flex flex-col gap-6">
                    <h2 class="text-white font-bold text-xl mb-2 drop-shadow-md">Data statistik spasial</h2>

                    <div class="w-full bg-white/10 backdrop-blur-lg border border-white/20 rounded-[24px] p-6 shadow-xl">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-white font-bold text-lg">Detail Laporan Valid</h3>
                            <button class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-white hover:bg-white/30 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                        </div>
                        
                        <div class="w-full overflow-hidden rounded-xl bg-white/5 border border-white/10">
                            <table class="w-full text-left text-sm text-white">
                                <thead class="bg-white text-black font-semibold">
                                    <tr>
                                        <th class="px-6 py-4">TANGGAL KEJADIAN</th>
                                        <th class="px-6 py-4">Spesies</th>
                                        <th class="px-6 py-4">Provinsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b border-white/10 hover:bg-white/10 transition-colors">
                                        <td class="px-6 py-5">23 April 2026</td>
                                        <td class="px-6 py-5">Mamalia Laut</td>
                                        <td class="px-6 py-5">Bali</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- INI BAGIAN YANG DIUBAH MENJADI <a> -->
                    <a href="{{ route('masyarakat.statistik') }}" class="block w-full bg-white/10 hover:bg-white/20 transition-all backdrop-blur-lg border border-white/20 rounded-[24px] p-8 shadow-xl mt-4 cursor-pointer group">
                        <h3 class="text-white font-bold text-base mb-6">Temuan Tervalidasi Mamalia Laut</h3>
                        
                        <div class="w-full space-y-5">
                            <div class="flex items-center gap-4 text-white text-sm">
                                <span class="w-32 text-right">Bali</span>
                                <div class="flex-1 bg-white/10 rounded-r-md h-10 relative">
                                    <div class="absolute left-0 top-0 h-full bg-blue-500" style="width: 85%;"></div>
                                </div>
                                <span class="w-10 font-bold">180</span>
                            </div>
                            <div class="flex items-center gap-4 text-white text-sm">
                                <span class="w-32 text-right">Papua Barat</span>
                                <div class="flex-1 bg-white/10 rounded-r-md h-10 relative">
                                    <div class="absolute left-0 top-0 h-full bg-blue-500" style="width: 65%;"></div>
                                </div>
                                <span class="w-10 font-bold">145</span>
                            </div>
                            <div class="flex items-center gap-4 text-white text-sm">
                                <span class="w-32 text-right">Sulawesi Utara</span>
                                <div class="flex-1 bg-white/10 rounded-r-md h-10 relative">
                                    <div class="absolute left-0 top-0 h-full bg-blue-500" style="width: 50%;"></div>
                                </div>
                                <span class="w-10 font-bold">120</span>
                            </div>
                        </div>
                    </a>
                    <!-- BATAS BAGIAN YANG DIUBAH -->

                </main>

                <aside class="w-[300px] flex flex-col gap-8 mt-10">
                    
                    <div class="w-full bg-white/10 backdrop-blur-lg border border-white/20 rounded-[24px] p-6 shadow-xl flex flex-col items-center">
                        <div class="w-32 h-32 rounded-full border-4 border-pink-500 p-1 mb-6 shadow-[0_0_20px_rgba(236,72,153,0.5)]">
                            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->first_name . ' ' . $user->last_name).'&background=random' }}" 
                                 alt="Profile" class="w-full h-full object-cover rounded-full">
                        </div>
                        <a href="{{ route('masyarakat.profil.edit') }}" class="w-full py-3 bg-blue-500 hover:bg-blue-600 rounded-xl text-white font-semibold text-sm text-center transition-all shadow-lg transform hover:-translate-y-1">
                            Edit Profil
                        </a>
                    </div>

                    <div class="w-full bg-white/80 backdrop-blur-md border border-white/20 rounded-[24px] p-6 shadow-xl flex flex-col min-h-[220px]">
                        <h3 class="text-black font-bold text-lg mb-auto text-center leading-tight">Kontribusi Laporan<br>Harian</h3>
                        <div class="flex items-center justify-center flex-1">
                            <span class="text-7xl font-bold text-black drop-shadow-sm">12</span>
                        </div>
                    </div>

                </aside>

            </div>

        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>