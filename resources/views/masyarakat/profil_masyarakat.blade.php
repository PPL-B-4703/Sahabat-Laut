<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Sahabat Laut</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background-image: url("{{ asset('./images/background.jpg') }}");
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

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.1); }
        ::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.3); border-radius: 10px; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="overflow-x-hidden min-h-screen">

    <div class="relative w-full min-h-screen">
        
        <!-- HEADER / NAVBAR -->
        <header class="fixed top-0 left-0 w-full h-[100px] flex items-center justify-between px-12 z-[100] bg-[#0077a9]/10 backdrop-blur-md border-b border-white/10">
            <div class="flex items-center gap-4">
                <img src="{{ asset('./images/logo.png') }}" class="w-12 h-12 object-contain mix-blend-multiply" alt="Logo">
                <h1 class="font-['Work_Sans'] font-semibold text-white text-3xl tracking-tight glass-text">Sahabat Laut</h1>
            </div>

            <nav class="hidden md:flex gap-10">
                <a href="{{ route('dashboard') }}" class="text-white/80 font-medium hover:text-white pb-1 transition-all">
                    Beranda
                </a>
                <a href="#" class="text-white/80 font-medium hover:text-white pb-1 transition-all">
                    Katalog
                </a>
            </nav>

            <div class="flex items-center gap-8">
                <!-- Tombol Profil (Active State karena sedang di halaman profil) -->
                <a href="{{ route('masyarakat.profil.edit') }}" class="flex items-center gap-3 bg-white/20 transition-all p-1 pr-4 rounded-full border border-white/40 backdrop-blur-sm shadow-[0_0_15px_rgba(255,255,255,0.2)]">
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

        <div class="flex items-start pt-[130px] px-10 pb-10 gap-8 min-h-screen">
            
            <!-- SIDEBAR KIRI -->
            <aside class="w-72 h-fit sticky top-[120px] rounded-[32px] overflow-hidden backdrop-blur-xl bg-black/20 border border-white/20 p-8 flex flex-col z-20 text-white shadow-2xl">
                <nav class="flex flex-col gap-10">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-4 text-white/60 hover:text-white transition-all group">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Home Page</span>
                    </a>

                    <a href="{{ route('laporan.create') }}" class="flex items-center gap-4 text-white/60 hover:text-white transition-all group">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                        </svg>
                        <span>Kirim Laporan</span>
                    </a>

                    <a href="{{ route('laporan.history') }}" class="flex items-center gap-4 text-white/60 hover:text-white transition-all group">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        <span>History Laporan</span>
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

                <!-- BUNGKUS KEDUA CARD DENGAN FORM UTAMA -->
                <form action="{{ route('masyarakat.profil.update') }}" method="POST" enctype="multipart/form-data" class="flex-1 flex gap-8" x-data="{ photoPreview: null }">
                    @csrf
                    @method('PUT')

                        <!-- CARD INFO PROFIL TENGAH -->
                <aside class="w-80 min-h-[700px] rounded-[32px] bg-white/5 backdrop-blur-md border border-white/20 p-8 flex flex-col items-center shadow-2xl text-white">
                    
                    <!-- FOTO PROFIL BISA DIKLIK (Dengan efek Hover & Preview Alpine.js) -->
                    <label class="relative w-32 h-32 rounded-full border-4 border-[#0077a9] overflow-hidden mb-6 bg-white shadow-lg group cursor-pointer block">
                        
                        <!-- Input File (Hidden) yang membaca gambar untuk preview -->
                        <input type="file" name="avatar" accept=".jpg, .jpeg, .png" class="hidden" 
                               @change="const reader = new FileReader(); reader.onload = (e) => photoPreview = e.target.result; reader.readAsDataURL($event.target.files[0])">

                        <!-- Foto Asli dari Database (Sembunyi jika ada preview) -->
                        <img x-show="!photoPreview" 
                             src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->first_name . ' ' . $user->last_name).'&background=random' }}" 
                             alt="Profile" class="w-full h-full object-cover">
                        
                        <!-- Foto Preview (Muncul saat user milih file baru) -->
                        <img x-show="photoPreview" :src="photoPreview" alt="Profile Preview" class="w-full h-full object-cover" style="display: none;">

                        <!-- EFEK HOVER GELAP (Hanya muncul saat disorot kursor) -->
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center">
                            <svg class="w-6 h-6 text-white mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="text-[10px] font-semibold text-white text-center tracking-wider">UBAH<br>FOTO</span>
                        </div>
                    </label>
                    
                    <h2 class="text-2xl font-bold mb-8 glass-text text-center">{{ $user->first_name }} {{ $user->last_name }}</h2>
                    
                    <div class="w-full flex flex-col gap-5 text-sm text-white/80">
                        <div class="flex items-center gap-4 bg-black/10 p-3 rounded-xl border border-white/10 overflow-hidden">
                            <svg class="w-5 h-5 text-blue-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <span class="font-medium truncate">{{ $user->phone_number ?? 'Belum ada nomor HP' }}</span>
                        </div>
                        <div class="flex items-center gap-4 bg-black/10 p-3 rounded-xl border border-white/10 overflow-hidden">
                            <svg class="w-5 h-5 text-blue-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span class="font-medium truncate">{{ $user->email }}</span>
                        </div>
                    </div>
                </aside>

                <!-- FORM UBAH PROFIL KANAN (Hanya Input Text) -->
                <main class="flex-1 min-h-[700px] rounded-[32px] bg-white/5 backdrop-blur-md border border-white/20 p-10 relative shadow-2xl text-white">
                    <h2 class="text-3xl font-bold mb-8 glass-text border-b border-white/10 pb-4">Ubah Profil</h2>

                    <!-- Notifikasi Balasan Controller -->
                    @if(session('success'))
                        <div class="mb-6 bg-green-500/20 border border-green-500/50 text-green-200 px-4 py-3 rounded-xl text-sm font-medium backdrop-blur-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 bg-red-500/20 border border-red-500/50 text-red-200 px-4 py-3 rounded-xl text-sm font-medium backdrop-blur-sm">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="h-[64px] border border-white/30 rounded-xl px-4 flex flex-col justify-center bg-black/20 focus-within:border-blue-400 transition-colors shadow-inner">
                            <label class="text-[11px] text-white/60 font-medium uppercase tracking-wider mb-1">First Name</label>
                            <input type="text" name="first_name" value="{{ $user->first_name }}" class="bg-transparent text-white font-medium outline-none w-full text-base placeholder-white/30">
                        </div>
                        
                        <div class="h-[64px] border border-white/30 rounded-xl px-4 flex flex-col justify-center bg-black/20 focus-within:border-blue-400 transition-colors shadow-inner">
                            <label class="text-[11px] text-white/60 font-medium uppercase tracking-wider mb-1">Last Name</label>
                            <input type="text" name="last_name" value="{{ $user->last_name }}" class="bg-transparent text-white font-medium outline-none w-full text-base placeholder-white/30">
                        </div>

                        <div class="h-[64px] border border-white/30 rounded-xl px-4 flex flex-col justify-center bg-black/20 focus-within:border-blue-400 transition-colors shadow-inner">
                            <label class="text-[11px] text-white/60 font-medium uppercase tracking-wider mb-1">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="bg-transparent text-white font-medium outline-none w-full text-base placeholder-white/30">
                        </div>

                        <div class="h-[64px] border border-white/30 rounded-xl px-4 flex flex-col justify-center bg-black/20 focus-within:border-blue-400 transition-colors shadow-inner">
                            <label class="text-[11px] text-white/60 font-medium uppercase tracking-wider mb-1">Password Baru</label>
                            <input type="password" name="password" placeholder="Kosongkan jika tidak diubah" class="bg-transparent text-white font-medium outline-none w-full text-base placeholder-white/30">
                        </div>

                        <div class="h-[64px] border border-white/30 rounded-xl px-4 flex flex-col justify-center bg-black/20 focus-within:border-blue-400 transition-colors shadow-inner md:col-span-2">
                            <label class="text-[11px] text-white/60 font-medium uppercase tracking-wider mb-1">Nomor HP</label>
                            <input type="text" name="phone" value="{{ $user->phone_number }}" placeholder="Masukkan nomor HP" class="bg-transparent text-white font-medium outline-none w-full text-base placeholder-white/30">
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="absolute bottom-10 right-10">
                        <button type="submit" class="px-10 py-3.5 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 rounded-xl font-bold text-white transition-all shadow-[0_4px_15px_rgba(59,130,246,0.5)] transform hover:-translate-y-1">
                            Simpan Perubahan
                        </button>
                    </div>
                </main>
            </form>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>