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

        @php
            $totalUsers = \App\Models\User::count();
            $adminUsers = \App\Models\User::where('role', 'admin')->count();
            $pakarUsers = \App\Models\User::where('role', 'pakar')->count();
            $masyarakatUsers = \App\Models\User::where('role', 'masyarakat')->count();
            $totalLaporanCount = \App\Models\Laporan::count();
        @endphp

        <div class="bg-slate-900 border border-slate-800 rounded-lg p-6">
            <h3 class="text-slate-300 font-medium mb-4">Ringkasan Pengguna</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm border border-slate-800 rounded-lg">
                    <tbody class="divide-y divide-slate-800">
                        <tr class="bg-slate-950/40">
                            <td class="px-6 py-4 font-medium text-slate-200">Total User</td>
                            <td class="px-6 py-4 text-slate-100">{{ $totalUsers }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-medium text-slate-200">Admin</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-red-900/40 px-3 py-1 text-sm font-semibold text-red-300">{{ $adminUsers }}</span>
                            </td>
                        </tr>
                        <tr class="bg-slate-950/40">
                            <td class="px-6 py-4 font-medium text-slate-200">Pakar</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-blue-900/40 px-3 py-1 text-sm font-semibold text-blue-300">{{ $pakarUsers }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-medium text-slate-200">Masyarakat</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-green-900/40 px-3 py-1 text-sm font-semibold text-green-300">{{ $masyarakatUsers }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Laporan Recap Section -->
        <div class="bg-slate-900 border border-slate-800 rounded-lg p-6">
            <h3 class="text-lg font-bold text-white mb-6">📊 Rekapan Laporan Masuk</h3>
            
            @php
                $laporans = \App\Models\Laporan::latest()->take(10)->get();
                $laporanStats = \App\Models\Laporan::selectRaw('status, COUNT(*) as count')->groupBy('status')->get();
                $statusMapping = [
                    'Menunggu Verifikasi' => 'pending',
                    'Terverifikasi' => 'diproses',
                    'Ditolak' => 'selesai',
                ];
                $statusCounts = [
                    'pending' => 0,
                    'diproses' => 0,
                    'selesai' => 0,
                ];

                foreach ($laporanStats as $item) {
                    if (isset($statusMapping[$item->status])) {
                        $statusCounts[$statusMapping[$item->status]] = $item->count;
                    }
                }
            @endphp

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div class="text-sm text-slate-400">Jumlah laporan berdasarkan status dan daftar laporan terbaru.</div>
                <div class="inline-flex items-center rounded-full bg-yellow-900/30 px-4 py-2 text-sm font-semibold text-yellow-300 border border-yellow-800">
                    Total Laporan: {{ $totalLaporanCount }}
                </div>
            </div>

            @if($laporans->count() > 0)
                <!-- Status Overview -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    @foreach(['pending' => 'Pending', 'diproses' => 'Diproses', 'selesai' => 'Selesai'] as $statusKey => $statusLabel)
                        @php
                            $colors = [
                                'pending' => 'bg-yellow-900/30 text-yellow-400',
                                'diproses' => 'bg-blue-900/30 text-blue-400',
                                'selesai' => 'bg-green-900/30 text-green-400'
                            ];
                        @endphp
                        <div class="bg-slate-800 rounded-lg p-4 border border-slate-700">
                            <p class="text-slate-400 text-sm mb-2">{{ $statusLabel }}</p>
                            <p class="text-2xl font-bold {{ $colors[$statusKey] ?? '' }}">{{ $statusCounts[$statusKey] }}</p>
                        </div>
                    @endforeach
                </div>

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
                                        @if($laporan->status === 'Menunggu Verifikasi') bg-yellow-900/30 text-yellow-400
                                        @elseif($laporan->status === 'Terverifikasi') bg-blue-900/30 text-blue-400
                                        @else bg-green-900/30 text-green-400
                                        @endif">
                                        {{ $laporan->status }}
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