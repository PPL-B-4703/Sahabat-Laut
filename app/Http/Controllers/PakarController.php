<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PakarController extends Controller
{
    public function index()
    {
        return view('pakar.dashboard');
    }

    public function validasi()
    {
        return view('pakar.index_validasi');
    }

    public function detail($id)
    {
        return view('pakar.detail_laporan');
    }
}