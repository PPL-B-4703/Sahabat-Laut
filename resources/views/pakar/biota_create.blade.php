<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tambah Biota</title>

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
        Tambah Biota
    </h1>

    <form action="{{ route('pakar.biota.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-[#0d1f3e] p-8 rounded-3xl space-y-5">

        @csrf

        <input type="text"
               name="nama_biota"
               placeholder="Nama Biota"
               class="w-full p-3 rounded-xl bg-slate-900">

        <input type="text"
               name="nama_ilmiah"
               placeholder="Nama Ilmiah"
               class="w-full p-3 rounded-xl bg-slate-900">

        <select name="kategori"
                class="w-full p-3 rounded-xl bg-slate-900">

            @foreach($kategoris as $kategori)
                <option value="{{ $kategori }}">
                    {{ $kategori }}
                </option>
            @endforeach

        </select>

        <input type="text"
               name="status_konservasi"
               placeholder="Status Konservasi"
               class="w-full p-3 rounded-xl bg-slate-900">

        <input type="text"
               name="habitat"
               placeholder="Habitat"
               class="w-full p-3 rounded-xl bg-slate-900">

        <textarea
            name="deskripsi"
            rows="5"
            placeholder="Deskripsi"
            class="w-full p-3 rounded-xl bg-slate-900"></textarea>

        <textarea
            name="fakta_menarik"
            rows="4"
            placeholder="Fakta Menarik"
            class="w-full p-3 rounded-xl bg-slate-900"></textarea>

        <input type="text"
               name="lokasi"
               placeholder="Lokasi"
               class="w-full p-3 rounded-xl bg-slate-900">

        <input type="file"
               name="gambar"
               class="w-full">

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-cyan-400 text-black px-6 py-3 rounded-xl font-bold">

                Simpan

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