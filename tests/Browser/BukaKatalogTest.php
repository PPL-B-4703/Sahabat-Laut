<?php
// tests/Browser/BukaKatalogTest.php
// PBI-004 | SC-04-01 / TC-04-01-01

namespace Tests\Browser;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BukaKatalogTest extends DuskTestCase
{
    /**
     * SC-04-01 / TC-04-01-01
     * Membuka halaman katalog
     *
     * Precondition: User berada di halaman Beranda Sahabat Laut (tidak wajib login)
     * Steps:
     *   1. Buka halaman Beranda Sahabat Laut
     *   2. Klik menu "Katalog" pada navbar
     * Expected: Sistem menampilkan seluruh spesies yang tersedia dalam bentuk
     *           grid kartu, lengkap dengan jumlah total spesies
     */
    public function test_membuka_halaman_katalog(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/beranda')
                    ->pause(3000)  // tunggu 3 detik
                    ->screenshot('debug-beranda')  // foto halaman
                    ->clickLink('Katalog')
                    ->assertPathIs('/katalog')
                    ->assertSee('Katalog');
        });
    }
}