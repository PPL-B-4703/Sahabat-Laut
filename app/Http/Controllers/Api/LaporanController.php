<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'species_category' => 'required|string',
            'species_other'    => 'nullable|required_if:species_category,Lainnya|string',
            'aktivitas'        => 'required|string',
            'tanggal_temuan'   => 'required|date',
            'provinsi'         => 'required|string',
            'alamat_detail'    => 'required|string',
            'deskripsi_lokasi' => 'required|string',
            'latitude'         => 'required|numeric',
            'longitude'        => 'required|numeric',
            'deskripsi_temuan' => 'required|string',
            'attachments.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $finalSpecies = ($request->species_category === 'Lainnya') 
                        ? $request->species_other 
                        : $request->species_category;

        $alamatLengkap = "{$request->alamat_detail}, Provinsi {$request->provinsi}";

        $fileNames = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('laporan', $name, 'public');
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
            'status'            => 'Menunggu Verifikasi',
        ]);

        $laporan->attachments = collect($laporan->attachments)->map(function ($file) {
            return asset('storage/laporan/' . $file);
        });

        return response()->json([
            'status'  => 'success',
            'message' => 'Laporan berhasil dibuat via API',
            'data'    => $laporan
        ], 201);
    }

    public function index(Request $request)
    {
        $laporans = $request->user()->laporans()->latest()->get()->map(function ($laporan) {
            $laporan->attachments = collect($laporan->attachments)->map(function ($file) {
                return asset('storage/laporan/' . $file);
            });
            return $laporan;
        });

        return response()->json([
            'status' => 'success',
            'data'   => $laporans
        ]);
    }

    public function show(Request $request,int  $id)
    {
        $laporan = Laporan::where('user_id', $request->user()->id)->find($id);

        if (!$laporan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Laporan tidak ditemukan atau Anda tidak memiliki akses.'
            ], 404);
        }

        $laporan->attachments = collect($laporan->attachments)->map(function ($file) {
            return asset('storage/laporan/' . $file);
        });

        return response()->json([
            'status' => 'success',
            'data'   => $laporan
        ]);
    }
}