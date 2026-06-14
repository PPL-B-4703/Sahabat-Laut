<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Biota;

class BiotaSeeder extends Seeder
{
    public function run(): void
    {
        // kosongin tabel dulu
        Biota::truncate();

        $file = database_path('data_biota.csv');

        $handle = fopen($file, 'r');

        // skip header
        fgetcsv($handle, 0, ",");

        while (($row = fgetcsv($handle, 0, ",")) !== false) {

            if(count($row) < 8) continue;

            Biota::create([
                'nama_biota' => $row[1],
                'nama_ilmiah' => $row[2],
                'kategori' => $row[0],
                'habitat' => 'Perairan Indonesia',
                'status_konservasi' => $row[3],
                'deskripsi' => $row[4],
                'fakta_menarik' => $row[5],
                'lokasi' => $row[6],
                'gambar_url' => $row[7],
            ]);
        }

        fclose($handle);
    }
}