<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use App\Models\Laporan;

class PakarController extends Controller
{
    public function showPakarDashboard()
    {
        $totalLaporan = \App\Models\Laporan::count();
        $laporanMenunggu = \App\Models\Laporan::where('status', 'Menunggu Verifikasi')->count();
        $laporanSelesai = \App\Models\Laporan::whereIn('status', ['Terverifikasi', 'Ditolak'])->count();
        $recentReports = \App\Models\Laporan::latest()->take(5)->get();

        return view('pakar.dashboard', compact(
            'totalLaporan', 
            'laporanMenunggu', 
            'laporanSelesai', 
            'recentReports'
        ));
    }

    public function index()
    {
        $reports = Laporan::latest()->paginate(5);
        return view('pakar.index_validasi', compact('reports'));
    }

    public function show($id)
    {
        $report = Laporan::findOrFail($id);
        return view('pakar.detail_validasi', compact('report'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Terverifikasi,Ditolak',
            'koreksi' => 'nullable|string|max:1000',
        ]);

        $report = Laporan::findOrFail($id);

        if ($report->status !== 'Menunggu Verifikasi') {
            return redirect()->back()->with('error', 'Laporan ini sudah divalidasi!');
        }

        $report->status = $request->status;
        $report->koreksi = $request->koreksi;
        $report->save();

        return redirect()->route('pakar.validasi')->with('success', 'Validasi laporan berhasil disimpan!');
    }

    public function editProfile()
    {
        $user = auth()->user(); 
        return view('pakar.edit_profile', compact('user'));
    }

    public function exportLaporan(\Illuminate\Http\Request $request)
    {
        if (!$request->has('ids') || empty($request->ids)) {
            return redirect()->back()->with('error', 'Pilih minimal satu laporan.');
        }

        $laporan = \App\Models\Laporan::whereIn('id', $request->ids)->get();
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pakar.export_pdf', compact('laporan'));
        return $pdf->download('Laporan_Validasi_Pakar.pdf');
    }

    public function generateDataset()
    {
        $laporan = \App\Models\Laporan::all(); // Narik semua data buat riset pakar
        $csvFileName = 'Dataset_Biota_Laut_Pakar_' . date('Ymd') . '.csv';
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($laporan) {
            $file = fopen('php://output', 'w');
            
            // Header CSV disesuaikan dengan standar open data
            fputcsv($file, ['ID_Laporan', 'Tanggal_Temuan', 'Spesies', 'Aktivitas', 'Lokasi_Spesifik', 'Provinsi', 'Status_Validasi', 'Deskripsi_Temuan']);

            foreach ($laporan as $row) {
                // Logic aman buat misahin Lokasi dan Provinsi
                $alamatOri = $row->alamat_lokasi ?? '';
                $alamatArray = explode(', Provinsi ', $alamatOri);
                
                $lokasiBersih = trim($alamatArray[0]);
                // Kalau $row->prov kosong, ambil dari potongan alamat. Kalau masih kosong juga, kasih '-'
                $provinsi = !empty($row->prov) ? $row->prov : (isset($alamatArray[1]) ? trim($alamatArray[1]) : '-');
                
                // Rapihin format tanggal
                $tanggal = is_object($row->tanggal_temuan) ? $row->tanggal_temuan->format('Y-m-d') : $row->tanggal_temuan;

                fputcsv($file, [
                    $row->id, 
                    $tanggal,
                    $row->species, 
                    $row->aktivitas, 
                    $lokasiBersih, 
                    strtoupper($provinsi), // Dibikin huruf kapital semua biar seragam 
                    $row->status, 
                    $row->deskripsi_temuan
                ]);
            }
            fclose($file);
        };

        return \Illuminate\Support\Facades\Response::stream($callback, 200, $headers);
    }
}