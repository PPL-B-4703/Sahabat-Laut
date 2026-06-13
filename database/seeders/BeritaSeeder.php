<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        Berita::create([
            'judul' => 'Aksi Penyelamatan Terumbu Karang Gili Trawangan',
            'penulis' => 'Ethan Noah',
            'isi' => 'Komunitas Sahabat Laut melakukan restorasi terumbu karang yang rusak akibat jangkar kapal ilegal di perairan Lombok...',
            'gambar' => null,
            'referensi' => 'Dinas Kelautan dan Perikanan NTB',
            'tag' => 'Konservasi, Terumbu Karang',
            'tanggal_publikasi' => now(),
        ]);

        Berita::create([
            'judul' => 'Edukasi Pengurangan Sampah Plastik di Pesisir',
            'penulis' => 'Restu Haikal',
            'isi' => 'Masyarakat pesisir diberikan pelatihan cara mengolah limbah plastik menjadi barang bernilai ekonomis untuk menunjang UMKM lokal...',
            'gambar' => null,
            'referensi' => 'Sahabat Laut Research',
            'tag' => 'Edukasi, Pesisir',
            'tanggal_publikasi' => now()->subDays(1),
        ]);

        Berita::create([
            'judul' => 'Sosialisasi Wilayah Lindung Laut Terbaru',
            'penulis' => 'Fadli Admin',
            'isi' => 'Pemerintah menetapkan zona baru bebas tangkap guna memulihkan populasi ikan lokal di sekitar perairan bahari konservasi...',
            'gambar' => null,
            'referensi' => 'KKP RI',
            'tag' => 'Regulasi, Maritim',
            'tanggal_publikasi' => now()->subDays(3),
        ]);
    }
}