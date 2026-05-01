<?php

namespace App\Http\Controllers;

use App\Models\Biota;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Biota::query();

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_biota', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_ilmiah', 'like', '%' . $request->search . '%')
                  ->orWhere('kategori', 'like', '%' . $request->search . '%');
            });
        }

        // FILTER KATEGORI
        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        // Ambil data (pakai get() aja kalau mau langsung semua tanpa limit pagination)
        $biotas = $query->orderBy('nama_biota')->get();

        // Ambil daftar kategori buat tombol filter
        $kategoris = Biota::select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        return view('katalog.index', compact('biotas', 'kategoris'));
    }

    public function show($id)
    {
        // 1. Ambil data biota yang dipilih
        $biota = Biota::findOrFail($id);

        // 2. Ambil spesies terkait (kategori yang sama, tapi bukan ID ini)
        // Kita ambil 6 data buat slider di bawah
        $spesiesTorkait = Biota::where('kategori', $biota->kategori)
            ->where('id', '!=', $biota->id)
            ->limit(6)
            ->get();

        return view('katalog.detail', compact('biota', 'spesiesTorkait'));
    }
}