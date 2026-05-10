<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PakarController extends Controller
{
    public function dashboard()
    {
        return view('pakar.dashboard'); 
    }

    public function index()
    {
        return view('pakar.index_validasi');
    }

    public function show($id)
    {
        $semua_laporan = [
            1 => [
                'nama' => 'Gatot Doer', 'tgl' => '10 Mei 2026', 'spesies' => 'Penyu Hijau',
                'prov' => 'Jawa Barat', 'lokasi' => 'Pangandaran', 'aktivitas' => 'Pemantauan',
                'status' => 'Menunggu Verifikasi', 
                'img' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800'
            ],
            2 => [
                'nama' => 'Rusdi Got', 'tgl' => '08 Mei 2026', 'spesies' => 'Dugong',
                'prov' => 'Papua Barat', 'lokasi' => 'Raja Ampat', 'aktivitas' => 'Pemantauan',
                'status' => 'Terverifikasi',
                'img' => 'https://images.unsplash.com/photo-1583212292454-1fe6229603b7?auto=format&fit=crop&w=800'
            ],
            3 => [
                'nama' => 'Amba Tukam', 'tgl' => '07 Mei 2026', 'spesies' => 'Hiu Paus',
                'prov' => 'Bali', 'lokasi' => 'Pantai Sanur', 'aktivitas' => 'Pemantauan',
                'status' => 'Ditolak',
                'img' => 'https://images.unsplash.com/photo-1560271300-d83115501ae4?auto=format&fit=crop&w=800'
            ],
            4 => [
                'nama' => 'Goblil Super', 'tgl' => '05 Mei 2026', 'spesies' => 'Penyu Sisik',
                'prov' => 'Banten', 'lokasi' => 'Ujung Kulon', 'aktivitas' => 'Pemantauan',
                'status' => 'Sudah Diproses',
                'img' => 'https://images.unsplash.com/photo-1437622368342-7a3d73a34c8f?auto=format&fit=crop&w=800'
            ],
        ];

        $data = $semua_laporan[$id] ?? $semua_laporan[1];
        return view('pakar.detail_validasi', compact('data'));
    }
}