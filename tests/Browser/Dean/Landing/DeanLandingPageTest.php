<?php

namespace Tests\Browser\Dean\Landing;

use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeanLandingPageTest extends DuskTestCase
{
    public function test_masyarakat_can_login_and_access_beranda(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visit('/login')
                ->type('input[name="email"]', 'budi@test.com')
                ->type('input[name="password"]', 'password123')
                ->press('Masuk Sekarang')
                ->assertPathBeginsWith('/masyarakat')
                ->assertSee('Dashboard')
                ->visit('/beranda')
                ->assertSee('Lihat Laut dengan Jelas')
                ->assertSee('Sahabat Laut');
        });
    }
}
