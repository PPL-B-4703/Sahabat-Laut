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
        $admin = User::create([
            'first_name' => 'Dean',
            'last_name' => 'Admin',
            'email' => 'dean-admin-create-'.Str::random(4).'@example.com',
            'password' => 'password123',
            'role' => 'admin',
        ]);

        $uniqueEmail = 'dean-user-'.Str::random(4).'@example.com';

        $this->browse(function (Browser $browser) use ($admin, $uniqueEmail): void {
            $browser->visit('/login')
                ->type('input[name="email"]', $admin->email)
                ->type('input[name="password"]', 'password123')
                ->press('Masuk Sekarang')
                ->visit('/admin/users')
                ->assertSee('Manajemen User')
                ->click('a[href="'.route('admin.users.create').'"]')
                ->type('input[name="first_name"]', 'Dean')
                ->type('input[name="last_name"]', 'Tester')
                ->type('input[name="email"]', $uniqueEmail)
                ->type('input[name="phone_number"]', '081234567890')
                ->type('input[name="password"]', 'password123')
                ->type('input[name="password_confirmation"]', 'password123')
                ->select('select[name="role"]', 'pakar')
                ->press('Simpan User')
                ->assertPathIs('/admin/users')
                ->assertSee('User berhasil ditambahkan!')
                ->assertSee('Dean Tester');
        });
    }
}
