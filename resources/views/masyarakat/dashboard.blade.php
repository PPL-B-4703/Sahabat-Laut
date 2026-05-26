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
            /* UBAH .png / .jpg SESUAI NAMA FILE ASLI LU DI FOLDER PUBLIC/IMAGES */
            background-image: url("{{ asset('images/bg-dashboard.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            background-color: #004d6b; 
        }
        .glass-text { color: white; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4); }
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
        }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.1); }
        ::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.3); border-radius: 10px; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="overflow-x-hidden min-h-screen">

    <div class="relative w-full min-h-screen">
        
        <header class="fixed top-0 left-0 w-full h-[100px] flex items-center justify-between px-12 z-[100] bg-transparent">
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/logo.png') }}" class="w-12 h-12 object-contain mix-blend-multiply" alt="Logo">
                <h1 class="font-['Work_Sans'] font-semibold text-white text-3xl tracking-tight glass-text">Sahabat Laut</h1>
            </div>

            <nav class="hidden md:flex gap-10">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'text-blue-200 font-bold border-b-2 border-blue-200' : 'text-white/80 font-medium hover:text-white' }} pb-1 transition-all">Beranda</a>
                <a href="#" class="{{ request()->is('katalog*') ? 'text-blue-200 font-bold border-b-2 border-blue-200' : 'text-white/80 font-medium hover:text-white' }} pb-1 transition-all">Katalog</a>
            </nav>

            <div class="flex items-center gap-8">
                <a href="{{ route('masyarakat.profil.edit') }}" class="flex items-center gap-3 glass-card hover:bg-white/20 transition-all p-1 pr-4 rounded-full cursor-pointer">
                    <div class="w-10 h-10 rounded-full border-2 border-white bg-white overflow-hidden shadow-lg">
                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->first_name . ' ' . $user->last_name).'&background=random' }}" alt="Profile" class="w-full h-full object-cover">
                    </div>
                    <span class="font-semibold text-white text-sm glass-text">{{ $user->first_name }} {{ $user->last_name }}</span>
                </a>

                <button class="relative p-2 rounded-full hover:bg-white/10 transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute top-1.5 right-1.5 block h-2.5 w-2.5 rounded-full bg-red-600 border-2 border-transparent"></span>
                </button>
            </div>
        </header>

        <div class="flex items-start pt-[120px] px-10 pb-10 gap-8 min-h-screen">
            
            <aside class="w-72 h-fit sticky top-[120px] rounded-[32px] overflow-hidden glass-card p-8 flex flex-col z-20 text-white">
                <nav class="flex flex-col gap-8">
                    <a href="#" class="flex items-center gap-4 text-white font-bold transition-all underline underline-offset-8 decoration-2 drop-shadow-md">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('laporan.create') }}" class="flex items-center gap-4 text-white/70 hover:text-white transition-all group">
                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                        <span>Kirim Laporan</span>
                    </a>
                    <a href="{{ route('laporan.history') }}" class="flex items-center gap-4 text-white/70 hover:text-white transition-all group">
                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        <span>History Laporan</span>
                    </a>
                </nav>

                <form action="{{ route('logout') }}" method="POST" class="mt-12 pt-6 border-t border-white/20">
                    @csrf
                    <button type="submit" class="flex items-center gap-4 text-white/70 hover:text-red-400 w-full transition-all group">
                        <svg class="w-6 h-6 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span>Logout</span>
                    </button>
                </form>
            </aside>

            <div class="flex-1 grid grid-cols-1 xl:grid-cols-3 gap-8">
                
                <div class="xl:col-span-2 flex flex-col gap-8">

                    <div class="glass-card rounded-[24px] p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-white font-bold text-lg glass-text">Laporan Tervalidasi Terbaru</h3>
                        </div>
                        <div class="w-full overflow-hidden rounded-xl bg-white/5 border border-white/10">
                            <table class="w-full text-left text-sm text-white">
                                <thead class="bg-white/10 font-semibold border-b border-white/20">
                                    <tr>
                                        <th class="px-6 py-4">TANGGAL</th>
                                        <th class="px-6 py-4">SPESIES</th>
                                        <th class="px-6 py-4">LOKASI (PROVINSI)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($laporanValid as $laporan)
                                    <tr class="border-b border-white/10 hover:bg-white/10 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $laporan['tanggal'] }}</td>
                                        <td class="px-6 py-4 capitalize">{{ $laporan['spesies'] }}</td>
                                        <td class="px-6 py-4">{{ $laporan['provinsi'] }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-8 text-center text-white/60 italic">Belum ada laporan tervalidasi.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <a href="{{ route('masyarakat.statistik') }}" class="relative w-full h-[220px] rounded-[24px] overflow-hidden group border border-white/20 shadow-xl block cursor-pointer">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" 
                             style="background-image: url('https://images.unsplash.com/photo-1524661135-423995f22d0b?q=80&w=1000&auto=format&fit=crop');">
                        </div>
                        <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition-colors backdrop-blur-[2px]"></div>
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-white">
                            <div class="w-14 h-14 bg-blue-500/80 rounded-full flex items-center justify-center mb-3 shadow-[0_0_20px_rgba(59,130,246,0.8)]">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                            </div>
                            <h3 class="text-2xl font-bold tracking-wide drop-shadow-lg">Eksplor Peta Statistik Spasial</h3>
                            <p class="text-sm text-white/80 mt-1 font-medium">Lihat detail persebaran seluruh biota laut</p>
                        </div>
                    </a>

                    <div class="glass-card rounded-[24px] p-6 flex items-center justify-between">
                        <div>
                            <h3 class="text-white font-bold text-xl drop-shadow-md">Kontribusi Laporan Hari Ini</h3>
                            <p class="text-white/70 text-sm mt-1">Terima kasih telah aktif memantau perairan kita.</p>
                        </div>
                        <div class="w-20 h-20 bg-white/20 rounded-2xl border border-white/30 flex items-center justify-center shadow-inner">
                            <span class="text-4xl font-bold text-white drop-shadow-md">{{ $laporanHarian }}</span>
                        </div>
                    </div>

                </div>

                <div class="flex flex-col gap-8">
                    
                    <div class="glass-card rounded-[24px] p-6">
                        <h3 class="text-white font-bold text-lg mb-6 glass-text">Tracking Laporan Terakhir</h3>
                        
                        @if($laporanTerakhir)
                            <div class="w-full bg-white/10 rounded-xl p-5 border border-white/10">
                                <p class="text-xs text-white/60 mb-1 font-semibold uppercase">{{ \Carbon\Carbon::parse($laporanTerakhir->created_at)->diffForHumans() }}</p>
                                <h4 class="text-white font-bold text-base capitalize mb-4 truncate">{{ $laporanTerakhir->species }}</h4>
                                
                                @php
                                    $bgColor = 'bg-yellow-400';
                                    $textColor = 'text-yellow-900';
                                    $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
                                    
                                    if ($laporanTerakhir->status == 'Terverifikasi') {
                                        $bgColor = 'bg-green-400';
                                        $textColor = 'text-green-900';
                                        $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
                                    } elseif ($laporanTerakhir->status == 'Ditolak') {
                                        $bgColor = 'bg-red-400';
                                        $textColor = 'text-red-900';
                                        $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
                                    }
                                @endphp
                                
                                <div class="flex items-center gap-3">
                                    <div class="{{ $bgColor }} w-10 h-10 rounded-full flex items-center justify-center shadow-lg">
                                        <svg class="w-6 h-6 {{ $textColor }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $icon !!}</svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-xs text-white/80">Status Saat Ini</p>
                                        <p class="text-sm font-bold text-white">{{ $laporanTerakhir->status }}</p>
                                    </div>
                                </div>
                                
                                <a href="{{ route('laporan.show', $laporanTerakhir->id) }}" class="mt-5 block w-full py-2 bg-white/10 hover:bg-white/20 text-center rounded-lg text-white text-sm font-semibold transition-colors">Lihat Detail Laporan</a>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 text-white/40 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                <p class="text-white/60 text-sm">Anda belum pernah membuat laporan.</p>
                            </div>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>
</body>
</html>