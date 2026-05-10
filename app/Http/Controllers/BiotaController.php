<?php

namespace App\Http\Controllers;

use App\Models\Biota;

class BiotaController extends Controller
{
    public function index()
    {
        $biotas = Biota::all();
        return view('katalog', compact('biotas'));
    }

    public function show($id)
    {
        $biota = Biota::findOrFail($id);
        return view('detail', compact('biota'));
    }
}