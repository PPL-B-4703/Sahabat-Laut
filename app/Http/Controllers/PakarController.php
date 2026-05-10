<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report; 

class PakarController extends Controller
{
    public function showPakarDashboard()
    {
        $totalLaporan = \App\Models\Report::count();
        $laporanMenunggu = \App\Models\Report::where('status', 'Menunggu Verifikasi')->count();
        $laporanDiproses = \App\Models\Report::where('status', 'Sudah Diproses')->count();
        $recentReports = \App\Models\Report::latest()->take(5)->get();

        return view('pakar.dashboard', compact(
            'totalLaporan', 
            'laporanMenunggu', 
            'laporanDiproses', 
            'recentReports'
        ));
    }

    public function index()
    {
        $reports = \App\Models\Report::latest()->paginate(5);
        return view('pakar.index_validasi', compact('reports'));
    }

    public function show($id)
    {
        $report = Report::findOrFail($id);
        return view('pakar.detail_validasi', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        return redirect()->route('pakar.validasi')->with('success', 'Berhasil update validasi');
    }

    public function editProfile()
    {
        $user = auth()->user(); 
        return view('pakar.edit_profile', compact('user'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Terverifikasi,Ditolak',
            'koreksi' => 'nullable|string|max:1000',
        ]);

        $report = Report::findOrFail($id);
        $report->status = $request->status;
        $report->koreksi = $request->koreksi;
        $report->save();
        return redirect()->route('pakar.validasi')->with('success', 'Validasi laporan berhasil disimpan!');
    }
}