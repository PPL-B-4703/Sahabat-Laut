<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BeritaTest extends DuskTestCase
{
    /**
     * TC-01-01: Tes Login Admin & Masuk ke Manajemen Berita
     */
    public function testAdminLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'admin@test.com')
                    ->type('password', 'password123')
                    ->press('Masuk Sekarang')
                    ->assertPathIs('/admin/dashboard')
                    ->clickLink('Manajemen Berita');
        });
    }

    /**
     * TC-03-01: Tes Validasi Inputan Judul Kosong (Trigger Pop-up/Pesan Error)
     */
    public function testCreateBeritaFailed()
{
    $this->browse(function (Browser $browser) {
        $browser->visit('/login')

                ->type('email', 'admin@test.com')
                ->type('password', 'password123')
                ->press('Masuk Sekarang')
                ->assertPathIs('/admin/dashboard')
                ->clickLink('Manajemen Berita')

                ->visit('/admin/berita/create')

                ->type('penulis', 'John Doe')
                ->type('isi', 'Test ajaa') 
                ->press('Simpan Berita')
                ->assertPathIs('/admin/berita/create');
    });
}

    /**
     * TC-02-01: Tes Tambah Berita Baru (Valid)
     */
    public function testCreateBeritaSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')

                    ->type('email', 'admin@test.com')
                    ->type('password', 'password123')
                    ->press('Masuk Sekarang')
                    ->assertPathIs('/admin/dashboard')
                    ->clickLink('Manajemen Berita')
            
                    ->visit('/admin/berita/create')
                    
                    ->type('judul', 'test ajaa')
                    ->type('penulis', 'John Doe')
                    ->type('isi', 'Ini buat testing ajaa')
                    ->press('Simpan Berita')

                    ->waitForLocation('/admin/berita')

                    ->assertPathIs('/admin/berita');
        });
    }

    /**
     * TC-04-01: Tes Edit Berita yang Sudah Ada
     */
    public function testEditBerita()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')

                    ->type('email', 'admin@test.com')
                    ->type('password', 'password123')
                    ->press('Masuk Sekarang')
                    ->assertPathIs('/admin/dashboard')
                    ->clickLink('Manajemen Berita')
            
                    ->visit('/admin/berita')

                    ->click('a[title="Edit Berita"]')
                    ->type('judul', 'test edit ajaa')
                    ->press('Simpan Perubahan')
                    ->waitForLocation('/admin/berita')
                    ->assertPathIs('/admin/berita')
                    ->assertSee('test edit ajaa');
        });
    }

    /**
     * TC-06-01: Tes Integrasi - Memastikan Berita Muncul di Landing Page & Scroll Down
     */
    public function testLandingPageCheck()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/') // Buka link utama web
                    ->scrollIntoView('.text-2xl, h2') // Otomatis scroll ke bawah nyari bagian "Berita Terbaru"
                    ->assertSee('Berita Terbaru')
                    ->assertSee('Ini buat testing ajaa') // Cek judulnya ada atau gak
                    ->assertSee('John Doe');
        });
    }

    /**
     * TC-05-01: Tes Hapus Berita
     */
    public function testDeleteBerita()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')

                    ->type('email', 'admin@test.com')
                    ->type('password', 'password123')
                    ->press('Masuk Sekarang')
                    ->assertPathIs('/admin/dashboard')
                    ->clickLink('Manajemen Berita')

                    ->click('button[title="Hapus Berita"]')

                    ->acceptDialog() 
                    ->pause(2000)

                    ->assertDontSee('test edit ajaa');
        });
    }
}