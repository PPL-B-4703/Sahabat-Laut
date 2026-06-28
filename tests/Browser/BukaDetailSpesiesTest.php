<?php
// tests/Browser/BukaDetailSpesiesTest.php
// PBI-005 | SC-05-01 / TC-05-01-01

namespace Tests\Browser;

use App\Models\Biota;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BukaDetailSpesiesTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * SC-05-01 / TC-05-01-01
     * Membuka detail spesies
     *
     * Precondition: User berada di halaman Katalog
     * Steps:
     *   1. User memilih salah satu kartu spesies dari katalog
     * Expected: Sistem menampilkan nama biota, nama ilmiah, deskripsi,
     *           habitat, dan status konservasi secara lengkap
     */
    public function test_membuka_detail_spesies(): void
    {
        $biota = Biota::create([
            'nama_biota'        => 'Penyu Hijau',
            'nama_ilmiah'       => 'Chelonia mydas',
            'kategori'          => 'Penyu',
            'habitat'           => 'Pantai berpasir',
            'status_konservasi' => 'Appendix I',
            'deskripsi'         => 'Penyu herbivora terbesar.',
        ]);

        $this->browse(function (Browser $browser) use ($biota) {
            $browser->visit('/katalog')
                    ->clickLink('Penyu Hijau')
                    ->assertPathIs('/katalog/' . $biota->id)
                    ->assertSee('Penyu Hijau')
                    ->assertSee('Chelonia mydas')
                    ->assertSee('Penyu herbivora terbesar.')
                    ->assertSee('Appendix I');  // status konservasi tampil di card kanan
        });
    }
}