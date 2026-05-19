<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'species_category' => 'required|string',
            'species_other'    => 'nullable|required_if:species_category,Lainnya|string|max:255',
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

        $species = ($request->species_category === 'Lainnya') 
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
            'status'           => 'Menunggu Verifikasi', 
        ]);

        return redirect()->route('laporan.history')->with('success', 'Laporan berhasil terkirim!');
    }

    public function index()
    {
        $user = Auth::user();
        $laporans = Laporan::where('user_id', auth()->id())->latest()->get();

        return view('masyarakat.history', compact('user', 'laporans'));
    }
    public function show(int $id)
    {
        $user = Auth::user();
        $laporan = Laporan::findOrFail($id);

        if ($laporan->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }

        return view('masyarakat.detail_laporan', compact('user', 'laporan'));
    }
}