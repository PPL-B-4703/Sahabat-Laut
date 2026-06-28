<?php

namespace App\Http\Controllers;

use App\Models\Biota;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Biota::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_biota', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_ilmiah', 'like', '%' . $request->search . '%')
                  ->orWhere('kategori', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $biotas = $query->orderBy('nama_biota')->get();

        $kategoris = Biota::select('kategori')
            ->whereNotNull('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        return view('katalog.index', compact('biotas', 'kategoris'));
    }

    public function show(Biota $biota)
    {
        // 🔗 SPESIES TERKAIT (kategori sama, bukan dirinya)
        $spesiesTerkait = Biota::where('kategori', $biota->kategori)
            ->where('id', '!=', $biota->id)
            ->take(6)
            ->get();

        return view('katalog.detail', compact('biota', 'spesiesTerkait'));
    }

    public function exportPdf()
    {
        $userSkarang = auth()->user(); 

        $laporan = Laporan::where('status', 'Terverifikasi')->get(); 
        
        $pdf = Pdf::loadView('pakar.export_pdf', compact('laporan', 'userSkarang'));
        return $pdf->download('Katalog_Biota_Laut_Sahabat_Laut.pdf');
    }

    public function generateCsv()
    {
        $userSkarang = auth()->user();

        $laporan = Laporan::where('status', 'Terverifikasi')->get();
        $csvFileName = 'OpenData_Biota_Laut_' . date('Ymd') . '.csv';
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($laporan) {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, ['Tanggal_Temuan', 'Spesies', 'Aktivitas', 'Lokasi_Spesifik', 'Provinsi']);

            foreach ($laporan as $row) {
                $alamatOri = $row->alamat_lokasi ?? '';
                $alamatArray = explode(', Provinsi ', $alamatOri);
                
                $lokasiBersih = trim($alamatArray[0]);
                $provinsi = !empty($row->prov) ? $row->prov : (isset($alamatArray[1]) ? trim($alamatArray[1]) : '-');
                
                $tanggal = is_object($row->tanggal_temuan) ? $row->tanggal_temuan->format('Y-m-d') : $row->tanggal_temuan;

                fputcsv($file, [
                    $tanggal,
                    $row->species, 
                    $row->aktivitas, 
                    $lokasiBersih, 
                    strtoupper($provinsi)
                ]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}