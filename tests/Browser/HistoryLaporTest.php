<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use PHPUnit\Framework\Attributes\Test;

class HistoryLaporTest extends DuskTestCase
{
    #[Test]
    public function masyarakat_bisa_melihat_detail_laporan()
    {
        $user = User::where('email', 'budi@test.com')->first();

        $this->assertNotNull(
            $user,
            'User Budi tidak ditemukan di database.'
        );

        $this->browse(function (Browser $browser) use ($user) {

            $browser->loginAs($user)
                    ->visit('/masyarakat/riwayat')
                    ->waitForText('Riwayat Laporan', 15)
                    ->assertSee('Mamalia Laut')
                    ->clickLink('Detail')

                    ->pause(3000);
            $url = $browser->driver->getCurrentURL();

            $this->assertMatchesRegularExpression(
                '#/masyarakat/lapor/\d+$#',
                parse_url($url, PHP_URL_PATH)
            );
            $browser->assertSee('Mamalia Laut');
            
        });
    }
}