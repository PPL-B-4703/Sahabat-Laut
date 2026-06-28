<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PusatBantuanTest extends DuskTestCase
{
    /**
     * TC-01-01: Membuka halaman Pusat Bantuan melalui navbar
     */
    public function testBukaHalamanPusatBantuan()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->pause(1000)

                    ->clickLink('Pusat Bantuan') 
                    
                    ->assertPathIs('/pusat-bantuan')
                    ->assertSee('Pusat Bantuan')
                    ->assertSee('INFORMASI & BANTUAN'); 
        });
    }

    /**
     * TC-02-01: Melihat jawaban dari daftar pertanyaan (Interaktif)
     */
    public function testLihatJawaban()
    {
        $this->browse(function (Browser $browser) {
            // 1. Kunjungi halaman pusat bantuan
            $browser->visit('/pusat-bantuan')
                    ->waitFor('section')
                    ->pause(2000); 
            $browser->script("document.querySelector('section .space-y-5 button').click();");
            $browser->pause(2000);
            $browser->assertSee('Sahabat Laut adalah platform digital yang memungkinkan masyarakat');
        });
    }
}