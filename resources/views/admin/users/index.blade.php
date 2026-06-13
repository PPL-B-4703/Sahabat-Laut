@extends('admin.layouts.app')

@section('title', 'Manajemen User')
@section('page_title', 'Manajemen User')

@section('content')
    <!-- Header with Add Button -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <p class="text-slate-400 text-sm">Kelola semua user dalam sistem</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition-all shadow-lg">
            + Tambah Pengguna
        </a>
    </div>

    <!-- Flash Messages -->
    @if ($message = Session::get('success'))
        <div class="mb-6 p-4 bg-green-900/30 border border-green-600/50 rounded-lg">
            <p class="text-green-400 font-medium">✓ {{ $message }}</p>
        </div>
    @endif

    <!-- Search and Filter -->
    <div class="mb-6 flex gap-4">
        <form method="GET" class="flex gap-4 flex-1">
            <input 
                type="text" 
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari pengguna..." 
                class="flex-1 px-4 py-3 bg-slate-800 border border-slate-700 rounded-lg text-slate-100 placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-colors"
            >
            <select 
                name="role"
                class="px-6 py-3 bg-slate-800 border border-slate-700 text-slate-300 hover:bg-slate-700 rounded-lg transition-colors font-medium"
                onchange="this.form.submit()"
            >
                <option value="">Semua Role</option>
                @foreach($roles as $role)
                    <option value="{{ $role }}" @selected(request('role') === $role)>{{ ucfirst($role) }}</option>
                @endforeach
            </select>
            <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors font-medium">
                Cari
            </button>
            @if(request('search') || request('role'))
                <a href="{{ route('admin.users.index') }}" class="px-6 py-3 bg-slate-700 hover:bg-slate-600 text-slate-300 rounded-lg transition-colors font-medium">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Users Table -->
    <div class="bg-slate-900 border border-slate-800 rounded-lg overflow-hidden">
        @if ($users->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-800 border-b border-slate-700">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-bold text-slate-300">
                                <input type="checkbox" class="rounded border-slate-600 bg-slate-700">
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-slate-300">Nama</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-slate-300">Tanggal Pembuatan</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-slate-300">Nomor HP</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-slate-300">Email</th>
                            <th class="px-6 py-4 text-center text-sm font-bold text-slate-300">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @foreach ($users as $index => $user)
                            <tr class="hover:bg-slate-800/50 transition-all">
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="rounded border-slate-600 bg-slate-700">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-slate-100">{{ $user->first_name }} {{ $user->last_name }}</div>
                                    <div class="text-xs text-slate-500">
                                        @if ($user->role === 'admin')
                                            <span class="inline-block px-2 py-1 rounded bg-red-900/30 text-red-400">Admin</span>
                                        @elseif ($user->role === 'pakar')
                                            <span class="inline-block px-2 py-1 rounded bg-blue-900/30 text-blue-400">Pakar</span>
                                        @else
                                            <span class="inline-block px-2 py-1 rounded bg-green-900/30 text-green-400">Masyarakat</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-400">{{ $user->created_at->format('d Maret, Y') }}</td>
                                <td class="px-6 py-4 text-sm text-slate-400">{{ $user->phone_number ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-slate-400">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center justify-center w-8 h-8 bg-blue-600 hover:bg-blue-700 text-white rounded transition-all" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25z"/>
                                                <path d="M20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center w-8 h-8 bg-red-600 hover:bg-red-700 text-white rounded transition-all" title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-9l-1 1H5v2h14V4z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 bg-slate-800 border-t border-slate-700">
                <div class="flex justify-between items-center text-sm text-slate-400">
                    <span>Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }}</span>
                    <div class="space-x-2">
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-slate-400 mb-4">Belum ada user dalam sistem</p>
                <a href="{{ route('admin.users.create') }}" class="text-blue-400 hover:text-blue-300 font-medium">
                    Tambah user pertama Anda
                </a>
            </div>
        @endif
    </div>
@endsection
