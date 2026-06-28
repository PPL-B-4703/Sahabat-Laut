<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil UserSeeder agar Admin dan Pakar otomatis terbuat
        $this->call([
            UserSeeder::class,
            FaqSeeder::class,
            BeritaSeeder::class,
        ]);
    }
}
