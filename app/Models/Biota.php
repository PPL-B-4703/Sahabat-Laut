<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biota extends Model
{
    use HasFactory;

    protected $table = 'biotas';

    protected $fillable = [
        'nama_biota',
        'nama_ilmiah',
        'kategori',
        'habitat',
        'status_konservasi',
        'deskripsi',
        'fakta_menarik',
        'lokasi',
        'gambar_url',
    ];

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */

    public function getFaktaArrayAttribute()
    {
        if (!$this->fakta_menarik) return [];

        return array_filter(
            array_map('trim', explode('|', $this->fakta_menarik))
        );
    }

    public function getHabitatArrayAttribute()
    {
        if (!$this->habitat) return [];

        return array_filter(
            array_map('trim', explode('|', $this->habitat))
        );
    }

    public function getLokasiArrayAttribute()
    {
        if (!$this->lokasi) return [];

        $items = explode('|', $this->lokasi);

        return collect($items)->map(function ($item) {
            $part = explode(',', $item);

            return [
                'nama' => $part[0] ?? '',
                'lat'  => $part[1] ?? '',
                'lng'  => $part[2] ?? '',
            ];
        })->toArray();
    }

    /*
    |--------------------------------------------------------------------------
    | ATTRIBUTE TAMBAHAN
    |--------------------------------------------------------------------------
    */

    public function getEmojiAttribute()
    {
        return match ($this->kategori) {
            'Penyu' => '🐢',
            'Mamalia Laut' => '🐬',
            'Hiu & Pari' => '🦈',
            default => '🐠',
        };
    }

    public function getStatusColorAttribute()
    {
        $status = strtolower($this->status_konservasi);

        if (str_contains($status, 'appendix i')) return '#ef4444';
        if (str_contains($status, 'appendix ii')) return '#f59e0b';
        if (str_contains($status, 'critical')) return '#dc2626';
        if (str_contains($status, 'endangered')) return '#ea580c';
        if (str_contains($status, 'vulnerable')) return '#eab308';

        return '#22c55e';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATED SPECIES
    |--------------------------------------------------------------------------
    */

    public function spesiesTorkait($limit = 6)
    {
        return self::where('kategori', $this->kategori)
            ->where('id', '!=', $this->id)
            ->inRandomOrder()
            ->take($limit)
            ->get();
    }
}