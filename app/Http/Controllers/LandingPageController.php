<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->take(3)->get();
        return view('landing', compact('beritas')); 
    }

    public function indexBerita()
    {
        $beritas = Berita::latest()->get();
        return view('berita.index', compact('beritas'));
    }

    public function showBerita($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.show', compact('berita'));
    }
}