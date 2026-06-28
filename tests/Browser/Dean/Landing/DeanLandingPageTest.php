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
        $user = User::create([
            'first_name' => 'Dean',
            'last_name' => 'Masyarakat',
            'email' => 'dean-masyarakat-'.Str::random(4).'@example.com',
            'password' => 'password123',
            'role' => 'masyarakat',
        ]);

        $this->browse(function (Browser $browser) use ($user): void {
            $browser->visit('/login')
                ->type('input[name="email"]', $user->email)
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
