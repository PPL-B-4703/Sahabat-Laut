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
        $admin = User::create([
            'first_name' => 'Dean',
            'last_name' => 'Admin',
            'email' => 'dean-admin-dashboard-'.Str::random(4).'@example.com',
            'password' => 'password123',
            'role' => 'admin',
        ]);

        $this->browse(function (Browser $browser) use ($admin): void {
            $browser->visit('/login')
                ->type('input[name="email"]', $admin->email)
                ->type('input[name="password"]', 'password123')
                ->press('Masuk Sekarang')
                ->assertPathBeginsWith('/admin')
                ->assertSee('Selamat datang kembali')
                ->assertSee('Ringkasan Pengguna');
        });
    }
}
