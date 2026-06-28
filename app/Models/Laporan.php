<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
    'user_id', 'species', 'tanggal_temuan', 'deskripsi_temuan', 
    'aktivitas', 'alamat_lokasi', 'deskripsi_lokasi','latitude', 'longitude', 'attachments', 'status', 'koreksi'
    ];

    protected $casts = [
        'attachments' => 'array', 
        'tanggal_temuan' => 'date',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
