<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Biota</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>
body{
    background:#071325;
}
</style>

</head>
<body class="text-white">

<div class="max-w-7xl mx-auto px-8 py-10">

    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-4xl font-bold">
                Kelola Biota Laut
            </h1>

            <p class="text-white/50 mt-2">
                Total Spesies : {{ $totalCount }}
            </p>
        </div>

        <a href="{{ route('pakar.biota.create') }}"
           class="bg-cyan-400 text-slate-900 px-5 py-3 rounded-xl font-bold hover:bg-cyan-300">
            + Tambah Biota
        </a>

    </div>

    @if(session('success'))
    <div class="bg-green-500/20 border border-green-500 text-green-300 p-4 rounded-xl mb-6">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-[#0d1f3e] rounded-3xl overflow-hidden border border-white/10">

        <table class="w-full">

            <thead class="bg-black/20">
                <tr>
                    <th class="p-4 text-left">Nama</th>
                    <th class="p-4 text-left">Ilmiah</th>
                    <th class="p-4 text-left">Kategori</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($biotas as $biota)

                <tr class="border-t border-white/10">

                    <td class="p-4">
                        {{ $biota->nama_biota }}
                    </td>

                    <td class="p-4 italic text-white/60">
                        {{ $biota->nama_ilmiah }}
                    </td>

                    <td class="p-4">
                        {{ $biota->kategori }}
                    </td>

                    <td class="p-4">
                        {{ $biota->status_konservasi }}
                    </td>

                    <td class="p-4">

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('pakar.biota.edit',$biota) }}"
                               class="bg-yellow-500 px-4 py-2 rounded-lg text-black font-bold">

                                Edit

                            </a>

                            <form action="{{ route('pakar.biota.destroy',$biota) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Yakin hapus spesies?')"
                                    class="bg-red-600 px-4 py-2 rounded-lg font-bold">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    <div class="mt-6">
        {{ $biotas->links() }}
    </div>

</div>

</body>
</html>