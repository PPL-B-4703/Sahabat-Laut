<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Laporan; 
use Carbon\Carbon;

class StatistikController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // 1. Ambil nilai filter dari URL (Dropdown)
        $filterSpesies = $request->input('spesies');
        $filterTahun = $request->input('tahun');

        // 2. Query dasar: Tarik data yang HANYA berstatus "Terverifikasi"
        $query = Laporan::where('status', 'Terverifikasi');

        // Jika ada filter Spesies, tambahkan ke query
        if (!empty($filterSpesies)) {
            $query->where('species', $filterSpesies);
        }

        // Jika ada filter Tahun, tambahkan ke query
        if (!empty($filterTahun)) {
            $query->whereYear('tanggal_temuan', $filterTahun);
        }

        // Eksekusi query
        $laporans = $query->get();

        // 3. Hitung statistik
        $total_laporan = $laporans->count();
        
        $total_foto = $laporans->sum(function ($laporan) {
            // Pastikan format array agar tidak error
            $attachments = is_string($laporan->attachments) ? json_decode($laporan->attachments, true) : $laporan->attachments;
            return is_array($attachments) ? count($attachments) : 0;
        });

        // Hitung total kontributor unik dari data yang sudah difilter
        $total_kontributor = $laporans->unique('user_id')->count();

        // 4. Siapkan data untuk Tabel Detail
        $laporan_valid = $laporans->map(function ($item) {
            return [
                'tanggal' => Carbon::parse($item->tanggal_temuan)->translatedFormat('d F Y'),
                'spesies' => $item->species,
                'lokasi' => $item->alamat_lokasi, 
                'aktivitas' => $item->aktivitas,
                'verifikator' => 'Tim Pakar Sahabat Laut' 
            ];
        });

        $data = [
            'total_laporan' => $total_laporan,
            'total_foto' => $total_foto,
            'total_kontributor' => $total_kontributor,
            'laporan_valid' => $laporan_valid,
        ];

        // Data spesifik untuk di-render di Peta
        $dataPeta = $laporans;

        return view('masyarakat.spasial_statistik', compact('user', 'data', 'dataPeta', 'filterSpesies', 'filterTahun'));
    }
}