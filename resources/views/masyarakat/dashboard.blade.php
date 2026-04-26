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
    </style>
</head>
<body class="overflow-x-hidden min-h-screen">

    <div class="relative w-full min-h-screen">
        
        <header class="fixed top-0 left-0 w-full h-[100px] flex items-center justify-between px-12 z-50 bg-transparent border-b border-white/10">
            <div class="flex items-center gap-4">
                <img src="{{ asset('storage/images/logo.png') }}" class="w-12 h-12 object-contain mix-blend-multiply" alt="Logo">
                <h1 class="font-['Work_Sans'] font-semibold text-white text-3xl tracking-tight glass-text">Sahabat Laut</h1>
            </div>

            <nav class="hidden md:flex gap-10">
                <a href="{{ route('dashboard') }}" 
                   class="{{ request()->routeIs('dashboard') ? 'text-blue-200 font-bold border-b-2 border-blue-200' : 'text-white/80 font-medium hover:text-white' }} pb-1 transition-all">
                    Beranda
                </a>
                <a href="#" 
                   class="{{ request()->is('katalog*') ? 'text-blue-200 font-bold border-b-2 border-blue-200' : 'text-white/80 font-medium hover:text-white' }} pb-1 transition-all">
                    Katalog
                </a>
            </nav>

            <div class="flex items-center gap-8">
                <div class="flex items-center gap-3 bg-white/10 p-1 pr-4 rounded-full border border-white/20 backdrop-blur-sm">
                    <div class="w-10 h-10 rounded-full border-2 border-[#925fe2] bg-white overflow-hidden shadow-lg">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->first_name) }}&background=random" alt="Profile">
                    </div>
                    <span class="font-semibold text-white text-sm glass-text">
                        {{ $user->first_name }} {{ $user->last_name }}
                    </span>
                </div>

                <button class="relative p-2 rounded-full hover:bg-white/10 transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute top-1.5 right-1.5 block h-2.5 w-2.5 rounded-full bg-red-600 border-2 border-[#0077a9]"></span>
                </button>
            </div>
        </header>

        <div class="flex pt-[130px] px-10 pb-10 gap-10 min-h-screen">
            
            <aside class="w-72 h-[700px] sticky top-[130px] rounded-[32px] overflow-hidden backdrop-blur-xl bg-black/20 shadow-2xl border border-white/20 p-8 flex flex-col justify-between transition-all">
                <nav class="flex flex-col gap-10">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-4 {{ request()->routeIs('dashboard') ? 'text-white font-bold' : 'text-white/60' }} group">
                        <div class="p-2 {{ request()->routeIs('dashboard') ? 'bg-white/30' : 'bg-white/10' }} rounded-lg group-hover:bg-white/50 transition-all shadow-md">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                        </div>
                        <span class="glass-text">Home Page</span>
                    </a>
                    
                    <a href="{{ route('laporan.create') }}" class="flex items-center gap-4 {{ request()->routeIs('laporan.create') ? 'text-white font-bold' : 'text-white/60' }} hover:text-white transition-all group font-medium">
                        <div class="p-2 {{ request()->routeIs('laporan.create') ? 'bg-white/30' : 'bg-transparent' }} rounded-lg group-hover:bg-white/40 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </div>
                        <span class="{{ request()->routeIs('laporan.create') ? 'glass-text' : 'group-hover:glass-text' }}">Kirim Laporan</span>
                    </a>

                    <a href="#" class="flex items-center gap-4 text-white/60 hover:text-white transition-all group font-medium">
                        <div class="p-2 bg-transparent rounded-lg group-hover:bg-white/40 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </div>
                        <span class="group-hover:glass-text">History Laporan</span>
                    </a>
                </nav>

                <form action="{{ route('logout') }}" method="POST" class="pt-6 border-t border-white/10">
                    @csrf
                    <button type="submit" class="flex items-center gap-4 text-white/60 hover:text-red-400 w-full transition-all group font-medium">
                        <div class="p-2 bg-transparent rounded-lg group-hover:bg-red-400/20 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </div>
                        <span>Logout</span>
                    </button>
                </form>
            </aside>

            <main class="flex-1 min-h-[700px] rounded-[32px] bg-white/5 backdrop-blur-sm border border-white/10 p-10">
                <div class="w-full h-full border-2 border-dashed border-white/10 rounded-[24px] flex items-center justify-center">
                    <p class="text-white/20 font-medium text-lg">Area Konten Utama (Development)</p>
                </div>
            </main>

            <aside class="w-80 min-h-[700px] rounded-[32px] bg-white/5 backdrop-blur-sm border border-white/10 p-8 flex items-center justify-center">
                 <div class="h-full w-full border-2 border-dashed border-white/10 rounded-[24px] flex items-center justify-center">
                    <p class="text-white/20 font-medium text-lg text-center">Area Berita<br>(Development)</p>
                </div>
            </aside>

        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>