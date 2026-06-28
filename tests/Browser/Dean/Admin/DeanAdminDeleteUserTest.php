<?php

namespace Tests\Browser\Dean\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeanAdminDeleteUserTest extends DuskTestCase
{
    public function test_admin_can_delete_user(): void
    {
        $admin = User::create([
            'first_name' => 'Dean',
            'last_name' => 'Admin',
            'email' => 'dean-admin-delete-'.Str::random(4).'@example.com',
            'password' => 'password123',
            'role' => 'admin',
        ]);

        $user = User::create([
            'first_name' => 'Delete',
            'last_name' => 'User',
            'email' => 'dean-delete-user-'.Str::random(4).'@example.com',
            'password' => 'password123',
            'role' => 'masyarakat',
        ]);

        $this->browse(function (Browser $browser) use ($admin, $user): void {
            $browser->visit('/login')
                ->type('input[name="email"]', $admin->email)
                ->type('input[name="password"]', 'password123')
                ->press('Masuk Sekarang')
                ->visit('/admin/users')
                ->assertSee($user->email)
                ->click("form[action='/admin/users/{$user->id}'] button[type='submit']")
                ->acceptDialog()
                ->assertPathIs('/admin/users')
                ->assertSee('User berhasil dihapus!')
                ->assertDontSee($user->email);
        });
    }
}
