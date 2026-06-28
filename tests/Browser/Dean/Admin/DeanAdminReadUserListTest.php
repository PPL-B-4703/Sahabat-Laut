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
        $admin = User::create([
            'first_name' => 'Dean',
            'last_name' => 'Admin',
            'email' => 'dean-admin-read-'.Str::random(4).'@example.com',
            'password' => 'password123',
            'role' => 'admin',
        ]);

        $user = User::create([
            'first_name' => 'Read',
            'last_name' => 'User',
            'email' => 'dean-read-user-'.Str::random(4).'@example.com',
            'password' => 'password123',
            'role' => 'masyarakat',
        ]);

        $this->browse(function (Browser $browser) use ($admin, $user): void {
            $browser->visit('/login')
                ->type('input[name="email"]', $admin->email)
                ->type('input[name="password"]', 'password123')
                ->press('Masuk Sekarang')
                ->visit('/admin/users')
                ->assertSee('Manajemen User')
                ->assertSee($user->email)
                ->assertSee('Read User');
        });
    }
}
