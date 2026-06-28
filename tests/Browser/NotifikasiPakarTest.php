<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Laporan;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use PHPUnit\Framework\Attributes\Test;

class NotifikasiPakarTest extends DuskTestCase
{
    #[Test]
    public function pakar_bisa_membuka_notifikasi_dan_menuju_detail_validasi()
    {
        $pakar = User::where('role', 'pakar')->first();

        $this->assertNotNull(
            $pakar,
            'User pakar tidak ditemukan.'
        );
        $laporan = Laporan::latest()->first();

        $this->assertNotNull(
            $laporan,
            'Tidak ada data laporan.'
        );

        $this->browse(function (Browser $browser) use ($pakar, $laporan) {

            $browser->loginAs($pakar)
                    ->visit('/pakar/dashboard')
                    ->pause(3000);
            $browser->click('.ph-bell')
                    ->pause(2000);
            $browser->assertSee('Laporan Baru Masuk!')
                    ->pause(1000);
            $browser->clickLink('Laporan Baru Masuk!')
                    ->pause(3000);
            $browser->assertPathIs(
                        '/pakar/validasi/' . $laporan->id
                    )
                    ->assertSee('Detail Laporan')
                    ->assertSee($laporan->species);
        });
    }
}