<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use App\Models\Laporan;
use Illuminate\Support\Facades\DB;
use App\Notifications\LaporanBaruNotification;

class PakarController extends Controller
{
    public function showPakarDashboard()
    {
        $totalLaporan = Laporan::count();
        $laporanMenunggu = Laporan::where('status', 'Menunggu Verifikasi')->count();
        $laporanSelesai = Laporan::whereIn('status', ['Terverifikasi', 'Ditolak'])->count();
        $recentReports = Laporan::latest()->take(5)->get();

        // --- LOGIC TAMBAHAN UNTUK GRAFIK PROVINSI ---
        // Mengambil data alamat_lokasi, memecah string untuk mendapatkan nama Provinsi, lalu menghitungnya
        $laporanPerProvinsi = Laporan::select('alamat_lokasi', DB::raw('count(*) as total'))
            ->groupBy('alamat_lokasi')
            ->get();

        $provinsiData = [];
        foreach ($laporanPerProvinsi as $item) {
            // Memecah teks "Nama Lokasi, Provinsi Jawa Barat" mengambil bagian setelah kata "Provinsi "
            $parts = explode(', Provinsi ', $item->alamat_lokasi);
            $namaProvinsi = $parts[1] ?? 'Luar Provinsi / Tidak Diketahui';
            
            if (!isset($provinsiData[$namaProvinsi])) {
                $provinsiData[$namaProvinsi] = 0;
            }
            $provinsiData[$namaProvinsi] += $item->total;
        }

        // Ambil maksimal 5-7 provinsi teratas untuk grafik agar tidak terlalu penuh
        arsort($provinsiData);
        $provinsiData = array_slice($provinsiData, 0, 7, true);

        $chartLabels = array_keys($provinsiData);
        $chartValues = array_values($provinsiData);
        // --------------------------------------------

        return view('pakar.dashboard', compact(
            'totalLaporan', 
            'laporanMenunggu', 
            'laporanSelesai', 
            'recentReports',
            'chartLabels',
            'chartValues'
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

        $userMasyarakat = $report->user; 

        if ($userMasyarakat) {
            $userMasyarakat->notify(new LaporanBaruNotification($report, 'status_diperbarui'));
        }

        // ===============================================================================

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
        $laporan = \App\Models\Laporan::all();
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
            
            fputcsv($file, ['ID_Laporan', 'Tanggal_Temuan', 'Spesies', 'Aktivitas', 'Lokasi_Spesifik', 'Provinsi', 'Status_Validasi', 'Deskripsi_Temuan']);

            foreach ($laporan as $row) {
                $alamatOri = $row->alamat_lokasi ?? '';
                $alamatArray = explode(', Provinsi ', $alamatOri);
                
                $lokasiBersih = trim($alamatArray[0]);
                $provinsi = !empty($row->prov) ? $row->prov : (isset($alamatArray[1]) ? trim($alamatArray[1]) : '-');
                
                $tanggal = is_object($row->tanggal_temuan) ? $row->tanggal_temuan->format('Y-m-d') : $row->tanggal_temuan;

                fputcsv($file, [
                    $row->id, 
                    $tanggal,
                    $row->species, 
                    $row->aktivitas, 
                    $lokasiBersih, 
                    strtoupper($provinsi),
                    $row->status, 
                    $row->deskripsi_temuan
                ]);
            }
            fclose($file);
        };

        return \Illuminate\Support\Facades\Response::stream($callback, 200, $headers);
            }
        
    public function bulkVerify(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'koreksi' => 'nullable|string'
        ]);

        \App\Models\Laporan::whereIn('id', $request->ids)->update([
            'status' => 'Terverifikasi',
            'koreksi' => $request->koreksi
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Mantap! ' . count($request->ids) . ' laporan berhasil diverifikasi.'
        ]);
    }
}