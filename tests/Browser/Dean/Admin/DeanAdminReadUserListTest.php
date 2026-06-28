<?php

namespace Tests\Browser\Dean\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeanAdminReadUserListTest extends DuskTestCase
{
    public function test_admin_can_read_user_list(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visit('/login')
                ->type('input[name="email"]', 'admin@test.com')
                ->type('input[name="password"]', 'password123')
                ->press('Masuk Sekarang')
                ->visit('/admin/users')
                ->waitForText('Manajemen User')
                ->assertSee('Manajemen User')
                ->type('input[name="search"]', 'budi@test.com')
                ->press('Cari')
                ->waitForText('budi@test.com')
                ->assertSee('budi@test.com');
        });
    }
}
