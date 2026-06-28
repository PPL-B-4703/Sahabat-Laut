<?php
// tests/Browser/BukaRegulasiTest.php
// PBI-006 | SC-06-01 / TC-06-01-01

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BukaRegulasiTest extends DuskTestCase
{
    /**
     * SC-06-01 / TC-06-01-01
     * Membuka halaman regulasi
     *
     * Precondition: User berada di halaman Beranda Sahabat Laut
     * Steps:
     *   1. Buka halaman Beranda Sahabat Laut
     *   2. Navigasi ke halaman Regulasi melalui navbar
     * Expected: Sistem menampilkan halaman Regulasi yang berisi
     *           daftar dokumen PDF Permen KP
     */
    public function test_membuka_halaman_regulasi(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/beranda')
                    ->clickLink('Regulasi')
                    ->assertPathIs('/regulasi')
                    ->assertSee('Regulasi');
        });
    }
}