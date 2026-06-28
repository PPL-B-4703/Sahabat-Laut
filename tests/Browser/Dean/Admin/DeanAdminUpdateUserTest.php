<?php

namespace Tests\Browser\Dean\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeanAdminUpdateUserTest extends DuskTestCase
{
    public function test_admin_can_update_user(): void
    {
        $user = User::create([
            'first_name' => 'Old',
            'last_name' => 'Name',
            'email' => 'dean-update-user-'.Str::random(4).'@example.com',
            'password' => 'password123',
            'role' => 'masyarakat',
        ]);

        $this->browse(function (Browser $browser) use ($user): void {
            $browser->visit('/login')
                ->type('input[name="email"]', 'admin@test.com')
                ->type('input[name="password"]', 'password123')
                ->press('Masuk Sekarang')
                ->visit('/admin/users/'.$user->id.'/edit')
                ->waitFor('input[name="first_name"]')
                ->clear('input[name="first_name"]')
                ->type('input[name="first_name"]', 'Updated')
                ->select('select[name="role"]', 'admin')
                ->press('Update User')
                ->waitForText('User berhasil diupdate!')
                ->assertPathIs('/admin/users')
                ->assertSee('User berhasil diupdate!')
                ->type('input[name="search"]', 'Updated')
                ->press('Cari')
                ->waitForText('Updated Name')
                ->assertSee('Updated Name');
        });
    }
}
