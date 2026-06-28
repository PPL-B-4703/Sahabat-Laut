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
        $user = User::create([
            'first_name' => 'Read',
            'last_name' => 'User',
            'email' => 'dean-read-user-'.Str::random(4).'@example.com',
            'password' => 'password123',
            'role' => 'masyarakat',
        ]);

        $this->browse(function (Browser $browser) use ($user): void {
            $browser->visit('/login')
                ->type('input[name="email"]', 'admin@test.com')
                ->type('input[name="password"]', 'password123')
                ->press('Masuk Sekarang')
                ->visit('/admin/users')
                ->waitForText('Manajemen User')
                ->assertSee('Manajemen User')
                ->type('input[name="search"]', $user->email)
                ->press('Cari')
                ->waitForText($user->email)
                ->assertSee($user->email)
                ->assertSee('Read User');
        });
    }
}
