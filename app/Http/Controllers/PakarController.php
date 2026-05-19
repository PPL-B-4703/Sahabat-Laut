<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}