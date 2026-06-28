<?php
// tests/Browser/CariSpesiesTest.php
// PBI-004 | SC-04-02 / TC-04-02-01

namespace Tests\Browser;
use App\Models\Biota;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CariSpesiesTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * SC-04-02 / TC-04-02-01
     * Mencari spesies dengan kata kunci valid
     *
     * Precondition: User berada di halaman Katalog
     * Steps:
     *   1. User mengetik nama spesies pada kolom pencarian (cth: "Penyu")
     *   2. Klik tombol "Cari Spesies"
     * Expected: Sistem menampilkan hanya spesies yang nama/nama ilmiah/kategorinya
     *           cocok dengan kata kunci, beserta jumlah hasil pencarian
     */
    public function test_mencari_spesies_dengan_kata_kunci_valid(): void
    {
        Biota::create([
            'nama_biota'  => 'Penyu Hijau',
            'nama_ilmiah' => 'Chelonia mydas',
            'kategori'    => 'Penyu',
        ]);

        Biota::create([
            'nama_biota'  => 'Hiu Paus',
            'nama_ilmiah' => 'Rhincodon typus',
            'kategori'    => 'Hiu & Pari',
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/katalog')
            ->type('search', 'Penyu')
            ->press('Cari Spesies')
            ->pause(2000)          // tunggu reload selesai
            ->assertSee('Penyu Hijau')
            ->assertDontSee('Hiu Paus');
        });
    }
}