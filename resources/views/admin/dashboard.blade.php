@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
    <div class="space-y-8">
        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg p-8 text-white">
            <h1 class="text-3xl font-bold mb-2">Selamat datang kembali, {{ Auth::user()->first_name }}!</h1>
            <p class="text-blue-100">Kelola sistem Sahabat Laut dari sini</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Users -->
            <div class="bg-slate-900 border border-slate-800 rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-slate-300 font-medium">Total User</h3>
                    <div class="p-3 bg-blue-900/30 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M15 19H9a6 6 0 016-6h0a6 6 0 016 6v1H9v-1a4 4 0 00-8 0v1H0" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-white">{{ \App\Models\User::count() }}</p>
            </div>

            <!-- Admin Users -->
            <div class="bg-slate-900 border border-slate-800 rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-slate-300 font-medium">Admin</h3>
                    <div class="p-3 bg-red-900/30 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-white">{{ \App\Models\User::where('role', 'admin')->count() }}</p>
            </div>

            <!-- Expert Users -->
            <div class="bg-slate-900 border border-slate-800 rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-slate-300 font-medium">Pakar</h3>
                    <div class="p-3 bg-green-900/30 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-white">{{ \App\Models\User::where('role', 'pakar')->count() }}</p>
            </div>
        </div>

        <!-- Second Row Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Community Users -->
            <div class="bg-slate-900 border border-slate-800 rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-slate-300 font-medium">Masyarakat</h3>
                    <div class="p-3 bg-purple-900/30 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10h.01M13 16H9m4-14a3 3 0 11-6 0 3 3 0 016 0zM6 16a3 3 0 11-6 0 3 3 0 016 0zm0 0h.01" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-white">{{ \App\Models\User::where('role', 'masyarakat')->count() }}</p>
            </div>

            <!-- Total Reports -->
            <div class="bg-slate-900 border border-slate-800 rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-slate-300 font-medium">Total Laporan</h3>
                    <div class="p-3 bg-yellow-900/30 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-white">{{ \App\Models\Laporan::count() }}</p>
            </div>
        </div>

        <!-- Laporan Recap Section -->
        <div class="bg-slate-900 border border-slate-800 rounded-lg p-6">
            <h3 class="text-lg font-bold text-white mb-6">📊 Rekapan Laporan Masuk</h3>
            
            @php
                $laporans = \App\Models\Laporan::latest()->take(10)->get();
                $laporanStats = \App\Models\Laporan::selectRaw('status, COUNT(*) as count')->groupBy('status')->get();
            @endphp

            <!-- Status Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                @foreach(['pending' => 'Pending', 'diproses' => 'Diproses', 'selesai' => 'Selesai'] as $statusKey => $statusLabel)
                    @php
                        $count = $laporanStats->where('status', $statusKey)->first()->count ?? 0;
                        $colors = [
                            'pending' => 'bg-yellow-900/30 text-yellow-400',
                            'diproses' => 'bg-blue-900/30 text-blue-400',
                            'selesai' => 'bg-green-900/30 text-green-400'
                        ];
                    @endphp
                    <div class="bg-slate-800 rounded-lg p-4 border border-slate-700">
                        <p class="text-slate-400 text-sm mb-2">{{ $statusLabel }}</p>
                        <p class="text-2xl font-bold {{ $colors[$statusKey] ?? '' }}">{{ $count }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Recent Reports -->
            @if($laporans->count() > 0)
                <div class="mt-6">
                    <h4 class="text-sm font-bold text-slate-300 mb-4">Laporan Terbaru</h4>
                    <div class="space-y-3 max-h-96 overflow-y-auto">
                        @foreach($laporans as $laporan)
                            <div class="bg-slate-800 border border-slate-700 rounded-lg p-4">
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <p class="text-white font-medium">{{ $laporan->user->first_name }} {{ $laporan->user->last_name }}</p>
                                        <p class="text-slate-400 text-xs">{{ $laporan->created_at->format('d M Y H:i') }}</p>
                                    </div>
                                    <span class="inline-block px-2 py-1 rounded text-xs font-medium
                                        @if($laporan->status === 'pending') bg-yellow-900/30 text-yellow-400
                                        @elseif($laporan->status === 'diproses') bg-blue-900/30 text-blue-400
                                        @else bg-green-900/30 text-green-400
                                        @endif">
                                        {{ ucfirst($laporan->status) }}
                                    </span>
                                </div>
                                <p class="text-slate-300 text-sm">{{ Str::limit($laporan->deskripsi_temuan, 80) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-slate-400">Belum ada laporan masuk</p>
                </div>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- User Management -->
            <div class="bg-slate-900 border border-slate-800 rounded-lg p-6 hover:border-blue-600 transition-colors">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-white mb-2">Manajemen User</h3>
                        <p class="text-slate-400 text-sm">Kelola user dan role dalam sistem</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M15 19H9a6 6 0 016-6h0a6 6 0 016 6v1H9v-1a4 4 0 00-8 0v1H0" />
                    </svg>
                </div>
                <a href="{{ route('admin.users.index') }}" class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                    Buka Manajemen User
                </a>
            </div>

            <!-- Upcoming Features -->
            <div class="bg-slate-900 border border-slate-800 rounded-lg p-6 hover:border-slate-600 transition-colors">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-400 mb-2">Manajemen Pakar</h3>
                        <p class="text-slate-500 text-sm">Kelola data pakar melalui user management</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <a href="{{ route('admin.users.index') }}" class="inline-block px-4 py-2 bg-slate-700 hover:bg-slate-600 text-slate-300 font-medium rounded-lg transition-colors">
                    Kelola di User Management
                </a>
            </div>
        </div>

        <!-- Info Section -->
        <div class="bg-slate-900 border border-slate-800 rounded-lg p-6">
            <h3 class="text-lg font-bold text-white mb-4">ℹ️ Informasi Sistem</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div>
                    <p class="font-medium text-blue-400 mb-1">Admin</p>
                    <p class="text-slate-400">Memiliki akses penuh untuk mengelola sistem</p>
                </div>
                <div>
                    <p class="font-medium text-green-400 mb-1">Pakar</p>
                    <p class="text-slate-400">Ahli yang dapat merespons laporan masyarakat</p>
                </div>
                <div>
                    <p class="font-medium text-purple-400 mb-1">Masyarakat</p>
                    <p class="text-slate-400">Pengguna umum yang dapat membuat laporan</p>
                </div>
            </div>
        </div>
    </div>
@endsection