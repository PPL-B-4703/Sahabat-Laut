<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
    'user_id', 'species', 'tanggal_temuan', 'deskripsi_temuan', 
    'aktivitas', 'alamat_lokasi', 'deskripsi_lokasi','latitude', 'longitude', 'attachments', 'status'
    ];

    protected $casts = [
        'attachments' => 'array', 
        'tanggal_temuan' => 'date',
    ];
}
