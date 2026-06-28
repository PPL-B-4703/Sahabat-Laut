<?php

namespace App\Http\Controllers;

use App\Models\Biota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PakarBiotaController extends Controller
{
    // Daftar semua biota
    public function index()
    {
        $biotas = Biota::orderBy('kategori')
            ->orderBy('nama_biota')
            ->paginate(15);

        $totalCount = Biota::count();

        return view('pakar.biota_index', compact('biotas', 'totalCount'));
    }

    // Form tambah biota
    public function create()
    {
        $kategoris = ['Penyu', 'Mamalia Laut', 'Hiu & Pari', 'Lainnya'];

        return view('pakar.biota_create', compact('kategoris'));
    }

    // Simpan biota baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_biota'        => 'required|string|max:255',
            'nama_ilmiah'       => 'nullable|string|max:255',
            'kategori'          => 'required|in:Penyu,Mamalia Laut,Hiu & Pari,Lainnya',
            'habitat'           => 'nullable|string|max:255',
            'status_konservasi' => 'nullable|string|max:100',
            'deskripsi'         => 'nullable|string',
            'fakta_menarik'     => 'nullable|string',
            'lokasi'            => 'nullable|string',
            'gambar'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $gambarUrl = null;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');

            $filename = Str::slug($request->nama_biota)
                . '-' . time()
                . '.' . $file->getClientOriginalExtension();

            $file->storeAs('public/biotas', $filename);

            $gambarUrl = '/storage/biotas/' . $filename;
        }

        Biota::create([
            'nama_biota'        => $request->nama_biota,
            'nama_ilmiah'       => $request->nama_ilmiah,
            'kategori'          => $request->kategori,
            'habitat'           => $request->habitat,
            'status_konservasi' => $request->status_konservasi,
            'deskripsi'         => $request->deskripsi,
            'fakta_menarik'     => $request->fakta_menarik,
            'lokasi'            => $request->lokasi,
            'gambar_url'        => $gambarUrl,
        ]);

        return redirect()
            ->route('pakar.biota.index')
            ->with('success', 'Spesies berhasil ditambahkan!');
    }

    // DETAIL BIOTA
    public function show(Biota $biotum)
    {
        return view('pakar.biota_show', [
            'biota' => $biotum
        ]);
    }

    // Form edit
    public function edit(Biota $biotum)
    {
        $kategoris = ['Penyu', 'Mamalia Laut', 'Hiu & Pari', 'Lainnya'];

        return view('pakar.biota_edit', [
            'biota' => $biotum,
            'kategoris' => $kategoris
        ]);
    }

    // Update biota
    public function update(Request $request, Biota $biotum)
    {
        $request->validate([
            'nama_biota'        => 'required|string|max:255',
            'nama_ilmiah'       => 'nullable|string|max:255',
            'kategori'          => 'required|in:Penyu,Mamalia Laut,Hiu & Pari,Lainnya',
            'habitat'           => 'nullable|string|max:255',
            'status_konservasi' => 'nullable|string|max:100',
            'deskripsi'         => 'nullable|string',
            'fakta_menarik'     => 'nullable|string',
            'lokasi'            => 'nullable|string',
            'gambar'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $gambarUrl = $biotum->gambar_url;

        if ($request->hasFile('gambar')) {

            if (
                $biotum->gambar_url &&
                str_starts_with($biotum->gambar_url, '/storage/')
            ) {
                $oldPath = str_replace(
                    '/storage/',
                    'public/',
                    $biotum->gambar_url
                );

                Storage::delete($oldPath);
            }

            $file = $request->file('gambar');

            $filename = Str::slug($request->nama_biota)
                . '-' . time()
                . '.' . $file->getClientOriginalExtension();

            $file->storeAs('public/biotas', $filename);

            $gambarUrl = '/storage/biotas/' . $filename;
        }

        $biotum->update([
            'nama_biota'        => $request->nama_biota,
            'nama_ilmiah'       => $request->nama_ilmiah,
            'kategori'          => $request->kategori,
            'habitat'           => $request->habitat,
            'status_konservasi' => $request->status_konservasi,
            'deskripsi'         => $request->deskripsi,
            'fakta_menarik'     => $request->fakta_menarik,
            'lokasi'            => $request->lokasi,
            'gambar_url'        => $gambarUrl,
        ]);

        return redirect()
            ->route('pakar.biota.index')
            ->with('success', 'Spesies berhasil diperbarui!');
    }

    // Hapus biota
    public function destroy(Biota $biotum)
    {
        if (
            $biotum->gambar_url &&
            str_starts_with($biotum->gambar_url, '/storage/')
        ) {
            $oldPath = str_replace(
                '/storage/',
                'public/',
                $biotum->gambar_url
            );

            Storage::delete($oldPath);
        }

        $biotum->delete();

        return redirect()
            ->route('pakar.biota.index')
            ->with('success', 'Spesies berhasil dihapus!');
    }
}