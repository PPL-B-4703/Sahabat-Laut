<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatistikController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // DUMMY DATA: Nanti diganti dengan query asli dari tabel Manajemen Pakar
        $data = [
            'total_laporan' => 124,
            'total_foto' => 342,
            'total_kontributor' => 56,
            'laporan_valid' => [
                ['tanggal' => '23 April 2026', 'spesies' => 'Mamalia Laut', 'provinsi' => 'Bali', 'aktivitas' => 'Pemantauan', 'verifikator' => 'Dr. A (Pakar)'],
                ['tanggal' => '23 April 2026', 'spesies' => 'Mamalia Laut', 'provinsi' => 'NTT', 'aktivitas' => 'Ancaman Lingkungan', 'verifikator' => 'Dr. A (Pakar)'],
                ['tanggal' => '23 April 2026', 'spesies' => 'Mamalia Laut', 'provinsi' => 'Aceh', 'aktivitas' => 'Kondisi Satwa', 'verifikator' => 'Dr. A (Pakar)'],
                ['tanggal' => '23 April 2026', 'spesies' => 'Mamalia Laut', 'provinsi' => 'Mentawai', 'aktivitas' => 'Pemantauan', 'verifikator' => 'Dr. A (Pakar)'],
            ]
        ];

        return view('masyarakat.spasial_statistik', compact('user', 'data'));
    }
}