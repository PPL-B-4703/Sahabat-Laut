<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class WorkflowTest extends DuskTestCase
{
    /**
     * Skenario 1: Login Admin dan akses dashboard.
     * Jalankan setelah Chrome/Chromium terinstal.
     */
    public function test_admin_can_login_and_access_dashboard(): void
    {
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Sahabat',
            'email' => 'admin-'.Str::random(4).'@example.com',
            'password' => 'password123',
            'role' => 'admin',
        ]);

        $this->browse(function (Browser $browser) use ($admin): void {
            $browser->visit('/login')
                ->type('email', $admin->email)
                ->type('password', 'password123')
                ->press('Masuk Sekarang')
                ->assertPathBeginsWith('/admin')
                ->assertSee('Selamat datang kembali')
                ->assertSee('Ringkasan Pengguna');
        });
    }

    /**
     * Skenario 2: CRUD User dipisah menjadi 6 case.
     * C = Create, R = Read, U = Update, D = Delete.
     */
    public function test_admin_can_create_user(): void
    {
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Sahabat',
            'email' => 'admin2-'.Str::random(4).'@example.com',
            'password' => 'password123',
            'role' => 'admin',
        ]);

        $uniqueEmail = 'dusk-user-'.Str::random(4).'@example.com';

        $this->browse(function (Browser $browser) use ($admin, $uniqueEmail): void {
            $browser->visit('/login')
                ->type('email', $admin->email)
                ->type('password', 'password123')
                ->press('Masuk Sekarang')
                ->visit('/admin/users')
                ->assertSee('Manajemen User')
                ->click('a[href="'.route('admin.users.create').'"]')
                ->type('input[name="first_name"]', 'Dusk')
                ->type('input[name="last_name"]', 'Tester')
                ->type('input[name="email"]', $uniqueEmail)
                ->type('input[name="phone_number"]', '081234567890')
                ->type('input[name="password"]', 'password123')
                ->type('input[name="password_confirmation"]', 'password123')
                ->select('select[name="role"]', 'pakar')
                ->press('Simpan User')
                ->assertPathIs('/admin/users')
                ->assertSee('User berhasil ditambahkan!')
                ->assertSee('Dusk Tester');
        });
    }

    public function test_admin_can_read_user_list(): void
    {
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Sahabat',
            'email' => 'admin3-'.Str::random(4).'@example.com',
            'password' => 'password123',
            'role' => 'admin',
        ]);

        $user = User::create([
            'first_name' => 'Read',
            'last_name' => 'User',
            'email' => 'read-user-'.Str::random(4).'@example.com',
            'password' => 'password123',
            'role' => 'masyarakat',
        ]);

        $this->browse(function (Browser $browser) use ($admin, $user): void {
            $browser->visit('/login')
                ->type('email', $admin->email)
                ->type('password', 'password123')
                ->press('Masuk Sekarang')
                ->visit('/admin/users')
                ->assertSee('Manajemen User')
                ->assertSee($user->email)
                ->assertSee('Read User');
        });
    }

    public function test_admin_can_update_user(): void
    {
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Sahabat',
            'email' => 'admin4-'.Str::random(4).'@example.com',
            'password' => 'password123',
            'role' => 'admin',
        ]);

        $user = User::create([
            'first_name' => 'Old',
            'last_name' => 'Name',
            'email' => 'update-user-'.Str::random(4).'@example.com',
            'password' => 'password123',
            'role' => 'masyarakat',
        ]);

        $this->browse(function (Browser $browser) use ($admin, $user): void {
            $browser->visit('/login')
                ->type('email', $admin->email)
                ->type('password', 'password123')
                ->press('Masuk Sekarang')
                ->visit('/admin/users/'.$user->id.'/edit')
                ->clear('input[name="first_name"]')
                ->type('input[name="first_name"]', 'Updated')
                ->select('select[name="role"]', 'admin')
                ->press('Update User')
                ->assertPathIs('/admin/users')
                ->assertSee('User berhasil diupdate!')
                ->assertSee('Updated Name');
        });
    }

    public function test_admin_can_delete_user(): void
    {
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Sahabat',
            'email' => 'admin5-'.Str::random(4).'@example.com',
            'password' => 'password123',
            'role' => 'admin',
        ]);

        $user = User::create([
            'first_name' => 'Delete',
            'last_name' => 'User',
            'email' => 'delete-user-'.Str::random(4).'@example.com',
            'password' => 'password123',
            'role' => 'masyarakat',
        ]);

        $this->browse(function (Browser $browser) use ($admin, $user): void {
            $browser->visit('/login')
                ->type('email', $admin->email)
                ->type('password', 'password123')
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

    /**
     * Skenario 3: Login masyarakat dan akses beranda.
     * Jalankan setelah Chrome/Chromium terinstal.
     */
    public function test_masyarakat_can_login_and_access_beranda(): void
    {
        $user = User::create([
            'first_name' => 'Masyarakat',
            'last_name' => 'Tester',
            'email' => 'masyarakat-'.Str::random(4).'@example.com',
            'password' => 'password123',
            'role' => 'masyarakat',
        ]);

        $this->browse(function (Browser $browser) use ($user): void {
            $browser->visit('/login')
                ->type('input[name="email"]', $user->email)
                ->type('input[name="password"]', 'password123')
                ->press('Masuk Sekarang')
                ->assertPathBeginsWith('/masyarakat')
                ->assertSee('Dashboard')
                ->visit('/beranda')
                ->assertSee('Lihat Laut dengan Jelas')
                ->assertSee('Sahabat Laut');
        });
    }
}
