<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'species_category' => 'required|string',
            'species_other'    => 'nullable|required_if:species_category,Lainnya',
            'aktivitas'        => 'required|string',
            'tanggal_temuan'   => 'required|date',
            'provinsi'         => 'required|string',
            'alamat_detail'    => 'required|string',
            'latitude'         => 'required|numeric',
            'longitude'        => 'required|numeric',
            'deskripsi_temuan' => 'required|string',
            'deskripsi_lokasi' => 'required|string', // Validasi wajib di API
            'attachments.*'    => 'nullable|image|max:5120',
        ]);

        $finalSpecies = ($request->species_category === 'Lainnya') ? $request->species_other : $request->species_category;
        $alamatLengkap = "{$request->alamat_detail}, Provinsi {$request->provinsi}";

        $fileNames = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $name = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/laporan', $name);
                $fileNames[] = $name;
            }
        }

        $laporan = Laporan::create([
            'user_id'           => $request->user()->id,
            'species'           => $finalSpecies,
            'tanggal_temuan'    => $request->tanggal_temuan,
            'deskripsi_temuan'  => $request->deskripsi_temuan,
            'aktivitas'         => $request->aktivitas,
            'alamat_lokasi'     => $alamatLengkap,
            'deskripsi_lokasi'  => $request->deskripsi_lokasi, 
            'latitude'          => $request->latitude,
            'longitude'         => $request->longitude,
            'attachments'       => $fileNames,
        ]);

        return response()->json(['status' => 'success', 'data' => $laporan], 201);
    }

    public function index(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data'   => $request->user()->laporans()->latest()->get()
        ]);
    }
}