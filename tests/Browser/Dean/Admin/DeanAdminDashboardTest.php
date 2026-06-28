<?php

namespace Tests\Browser\Dean\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeanAdminDashboardTest extends DuskTestCase
{
    public function test_admin_can_login_and_access_dashboard(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visit('/login')
                ->type('input[name="email"]', 'admin@test.com')
                ->type('input[name="password"]', 'password123')
                ->press('Masuk Sekarang')
                ->assertPathBeginsWith('/admin')
                ->assertSee('Selamat datang kembali')
                ->assertSee('Ringkasan Pengguna');
        });
    }
}
