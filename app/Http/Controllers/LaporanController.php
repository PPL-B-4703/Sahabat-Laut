<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        return view('masyarakat.lapor', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'species_category' => 'required',
            'aktivitas'        => 'required',
            'tanggal_temuan'   => 'required|date',
            'provinsi'         => 'required',
            'alamat_detail'    => 'required|string',
            'latitude'         => 'required',
            'longitude'        => 'required',
            'deskripsi_temuan' => 'required|string',
            'deskripsi_lokasi' => 'required|string', // Validasi deskripsi lokasi
            'attachments.*'    => 'nullable|image|max:5120',
        ]);

        $species = ($request->species_category === 'Lainnya') ? $request->species_other : $request->species_category;
        $alamatLengkap = "{$request->alamat_detail}, Provinsi {$request->provinsi}";

        $fileNames = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $name = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/laporan', $name);
                $fileNames[] = $name;
            }
        }

        Laporan::create([
            'user_id'          => Auth::id(),
            'species'          => $species,
            'tanggal_temuan'   => $request->tanggal_temuan,
            'deskripsi_temuan' => $request->deskripsi_temuan,
            'aktivitas'        => $request->aktivitas,
            'alamat_lokasi'    => $alamatLengkap,
            'deskripsi_lokasi' => $request->deskripsi_lokasi, 
            'latitude'         => $request->latitude,
            'longitude'        => $request->longitude,
            'attachments'      => $fileNames,
        ]);

        return redirect()->route('dashboard')->with('success', 'Laporan berhasil terkirim!');
    }
}