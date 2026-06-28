<?php
// tests/Browser/ResetPencarianTest.php
// PBI-004 | SC-04-03 / TC-04-03-01

namespace Tests\Browser;
use App\Models\Biota;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ResetPencarianTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * SC-04-03 / TC-04-03-01
     * Mereset hasil pencarian spesies
     *
     * Precondition: User telah melakukan pencarian dan/atau filter kategori
     *               sehingga hasil katalog sudah tersaring
     * Steps:
     *   1. Lakukan pencarian atau filter kategori
     *   2. Klik "Semua" pada pill kategori atau kosongkan kolom pencarian
     *      lalu klik "Cari Spesies"
     * Expected: Sistem menampilkan kembali seluruh spesies tanpa filter apapun
     */
    public function test_mereset_hasil_pencarian_spesies(): void
    {
        Biota::create([
            'nama_biota' => 'Penyu Hijau',
            'kategori'   => 'Penyu',
        ]);

        Biota::create([
            'nama_biota' => 'Hiu Paus',
            'kategori'   => 'Hiu & Pari',
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/katalog')
                    ->type('search', 'Penyu')
                    ->press('Cari Spesies')
                    ->pause(2000)
                    ->assertDontSee('Hiu Paus')
                    ->clickLink('Reset')
                    ->pause(2000)
                    ->assertPathIs('/katalog')
                    ->assertSee('Penyu Hijau')
                    ->assertSee('Hiu Paus');
        });
    }
}