<?php

namespace Tests\Browser\Dean\Admin;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeanAdminUpdateUserTest extends DuskTestCase
{
    public function test_admin_can_update_user(): void
    {
        $user = User::firstOrCreate([
            'email' => 'andi@test.com',
        ], [
            'first_name' => 'Andi',
            'last_name' => 'Santoso',
            'password' => 'password123',
            'role' => 'masyarakat',
            'phone_number' => '081234567890',
        ]);

        $newPhone = '08'.rand(10000000, 99999999);

        $this->browse(function (Browser $browser) use ($user, $newPhone): void {
            $browser->visit('/login')
                ->type('input[name="email"]', 'admin@test.com')
                ->type('input[name="password"]', 'password123')
                ->press('Masuk Sekarang')
                ->visit('/admin/users/'.$user->id.'/edit')
                ->waitFor('input[name="first_name"]')
                ->type('input[name="phone_number"]', $newPhone)
                ->select('select[name="role"]', 'masyarakat')
                ->press('Update User')
                ->waitForText('User berhasil diupdate!')
                ->assertPathIs('/admin/users')
                ->assertSee('User berhasil diupdate!')
                ->type('input[name="search"]', 'andi@test.com')
                ->press('Cari')
                ->waitForText('andi@test.com')
                ->assertSee('andi@test.com')
                ->assertSee($newPhone);
        });
    }
}
