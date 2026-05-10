<?php

namespace App\Http\Controllers;

use App\Models\Biota;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Biota::query();

        // 🔍 SEARCH (nama, ilmiah, kategori)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_biota', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_ilmiah', 'like', '%' . $request->search . '%')
                  ->orWhere('kategori', 'like', '%' . $request->search . '%');
            });
        }

        // 🎯 FILTER KATEGORI
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // 📊 AMBIL SEMUA DATA (tanpa pagination)
        $biotas = $query->orderBy('nama_biota')->get();

        // 📂 LIST KATEGORI (buat filter button)
        $kategoris = Biota::select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        return view('katalog.index', compact('biotas', 'kategoris'));
    }

    // 🔥 PAKE ROUTE MODEL BINDING (LEBIH BERSIH)
    public function show(Biota $biota)
    {
        // 🔗 SPESIES TERKAIT (kategori sama, bukan dirinya)
        $spesiesTerkait = Biota::where('kategori', $biota->kategori)
            ->where('id', '!=', $biota->id)
            ->take(6)
            ->get();

        return view('katalog.detail', compact('biota', 'spesiesTerkait'));
    }
}