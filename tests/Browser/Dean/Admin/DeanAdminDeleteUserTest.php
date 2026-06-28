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
        $user = User::create([
            'first_name' => 'Delete',
            'last_name' => 'User',
            'email' => 'dean-delete-user-'.Str::random(4).'@example.com',
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
                ->assertSee($user->email)
                ->click("form[action='/admin/users/{$user->id}'] button[type='submit']")
                ->acceptDialog()
                ->waitForText('User berhasil dihapus!')
                ->assertPathIs('/admin/users')
                ->assertSee('User berhasil dihapus!')
                ->type('input[name="search"]', $user->email)
                ->press('Cari')
                ->waitForText('Belum ada user dalam sistem')
                ->assertSee('Belum ada user dalam sistem');
        });
    }
}
