<?php

namespace Tests\Browser\Dean\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeanAdminCreateUserTest extends DuskTestCase
{
    public function test_admin_can_create_user(): void
    {
        $uniqueEmail = 'dean-user-'.Str::random(4).'@example.com';

        $this->browse(function (Browser $browser) use ($uniqueEmail): void {
            $browser->visit('/login')
                ->type('input[name="email"]', 'admin@test.com')
                ->type('input[name="password"]', 'password123')
                ->press('Masuk Sekarang')
                ->visit('/admin/users')
                ->waitForText('Manajemen User')
                ->assertSee('Manajemen User')
                ->click('a[href="'.route('admin.users.create').'"]')
                ->waitFor('input[name="first_name"]')
                ->type('input[name="first_name"]', 'Dean')
                ->type('input[name="last_name"]', 'Tester')
                ->type('input[name="email"]', $uniqueEmail)
                ->type('input[name="phone_number"]', '081234567890')
                ->type('input[name="password"]', 'password123')
                ->type('input[name="password_confirmation"]', 'password123')
                ->select('select[name="role"]', 'pakar')
                ->press('Simpan User')
                ->waitForText('User berhasil ditambahkan!')
                ->assertPathIs('/admin/users')
                ->assertSee('User berhasil ditambahkan!')
                ->type('input[name="search"]', $uniqueEmail)
                ->press('Cari')
                ->waitForText($uniqueEmail)
                ->assertSee($uniqueEmail);
        });
    }
}
