<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Laporan;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use PHPUnit\Framework\Attributes\Test;

class NotifikasiMasyarakatTest extends DuskTestCase
{
    #[Test]
    public function masyarakat_bisa_membuka_notifikasi_status_laporan()
    {
        $user = User::where('email', 'budi@test.com')->first();

        $this->assertNotNull(
            $user,
            'User Budi tidak ditemukan.'
        );

        $laporan = Laporan::where('user_id', $user->id)
                        ->latest()
                        ->first();

        $this->assertNotNull(
            $laporan,
            'Laporan milik Budi tidak ditemukan.'
        );

        $this->browse(function (Browser $browser) use ($user, $laporan) {
            $browser->loginAs($user)
                    ->visit('/masyarakat/dashboard')
                    ->pause(3000);
            $browser->click('@notification-bell')
                    ->pause(2000);
            $browser->assertSee('Status Laporan Diperbarui!')
                    ->pause(1000);
            $browser->clickLink('Status Laporan Diperbarui!')
                    ->pause(3000);
            $browser->assertPathIs(
                        '/masyarakat/lapor/' . $laporan->id
                    )
                    ->assertSee('Mamalia Laut')
                    ->assertSee('TERVERIFIKASI');
        });
    }
}