<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Biota</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>
body{
    background:#071325;
}
</style>

</head>
<body class="text-white">

<div class="max-w-4xl mx-auto py-10 px-8">

    <h1 class="text-4xl font-bold mb-8">
        Edit Biota
    </h1>

    <form action="{{ route('pakar.biota.update',$biota) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-[#0d1f3e] p-8 rounded-3xl space-y-5">

        @csrf
        @method('PUT')

        <input type="text"
               name="nama_biota"
               value="{{ $biota->nama_biota }}"
               class="w-full p-3 rounded-xl bg-slate-900">

        <input type="text"
               name="nama_ilmiah"
               value="{{ $biota->nama_ilmiah }}"
               class="w-full p-3 rounded-xl bg-slate-900">

        <select name="kategori"
                class="w-full p-3 rounded-xl bg-slate-900">

            @foreach($kategoris as $kategori)

                <option
                    value="{{ $kategori }}"
                    {{ $biota->kategori == $kategori ? 'selected' : '' }}>

                    {{ $kategori }}

                </option>

            @endforeach

        </select>

        <input type="text"
               name="status_konservasi"
               value="{{ $biota->status_konservasi }}"
               class="w-full p-3 rounded-xl bg-slate-900">

        <input type="text"
               name="habitat"
               value="{{ $biota->habitat }}"
               class="w-full p-3 rounded-xl bg-slate-900">

        <textarea
            name="deskripsi"
            rows="5"
            class="w-full p-3 rounded-xl bg-slate-900">{{ $biota->deskripsi }}</textarea>

        <textarea
            name="fakta_menarik"
            rows="4"
            class="w-full p-3 rounded-xl bg-slate-900">{{ $biota->fakta_menarik }}</textarea>

        <input type="text"
               name="lokasi"
               value="{{ $biota->lokasi }}"
               class="w-full p-3 rounded-xl bg-slate-900">

        @if($biota->gambar_url)

        <div>
            <p class="mb-2">Gambar Saat Ini</p>

            <img
                src="{{ $biota->gambar_url }}"
                class="w-64 rounded-xl">
        </div>

        @endif

        <input type="file"
               name="gambar">

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-cyan-400 text-black px-6 py-3 rounded-xl font-bold">

                Update

            </button>

            <a href="{{ route('pakar.biota.index') }}"
               class="bg-gray-600 px-6 py-3 rounded-xl">

                Batal

            </a>

        </div>

    </form>

</div>

</body>
</html>