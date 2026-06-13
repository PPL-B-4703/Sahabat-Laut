@extends('admin.layouts.app') @section('content')
<div class="p-6 bg-[#07132b] min-h-screen text-white">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold tracking-wide">Manajemen Berita</h1>
            <p class="text-sm text-gray-400 mt-1">Kelola publikasi artikel dan informasi Sahabat Laut</p>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2 transition-colors">
            <span>+</span> Tambah Berita
        </a>
    </div>

    <div class="flex gap-4 mb-4">
        <form action="{{ route('admin.berita.index') }}" method="GET" class="relative w-64">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="bg-[#0b1e42] text-white border border-gray-700 rounded-lg pl-10 pr-4 py-2 text-sm w-full focus:outline-none focus:border-blue-500">
        </form>
    </div>

    <div class="bg-[#0b1e42] rounded-xl overflow-hidden border border-gray-800 shadow-2xl">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-800 text-gray-400 text-sm bg-[#0d234d]">
                    <th class="p-4 w-[30%]">Judul Berita</th>
                    <th class="p-4 w-[20%]">Tanggal Publikasi</th>
                    <th class="p-4 w-[15%]">Penulis</th>
                    <th class="p-4 w-[25%]">Tag</th>
                    <th class="p-4 w-[15%] text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-800">
                @forelse($beritas as $b)
                <tr class="hover:bg-[#0f254e] transition-colors">
                    <td class="p-4 font-medium text-gray-200">{{ $b->judul }}</td>
                    <td class="p-4 text-gray-400">{{ date('d M Y', strtotime($b->tanggal_publikasi)) }}</td>
                    <td class="p-4 text-gray-300">{{ $b->penulis }}</td>
                    <td class="p-4"><span class="text-xs bg-blue-950 text-blue-400 px-2 py-1 rounded border border-blue-800">{{ $b->tag ?? '-' }}</span></td>
                    <td class="p-4 flex justify-center gap-4">
                        <a href="{{ route('admin.berita.edit', $b->id) }}" class="text-blue-400 hover:text-blue-300 transition-colors" title="Edit Berita">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                        </a>
                        <form action="{{ route('admin.berita.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus berita ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-400 transition-colors" title="Hapus Berita">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-500">Belum ada data berita atau pencarian tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectAllCheckbox = document.getElementById('select-all');
        const rowCheckboxes = document.querySelectorAll('.row-checkbox');

        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                rowCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const allChecked = Array.from(rowCheckboxes).every(cb => cb.checked);
                    selectAllCheckbox.checked = allChecked;
                });
            });
        }
    });
</script>
@endsection