<?php
// tests/Browser/TambahSpesiesTest.php
// PBI-005 | SC-05-02 / TC-05-02-01

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;

class TambahSpesiesTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * SC-05-02 / TC-05-02-01
     * Menambah spesies baru
     *
     * Precondition: Pakar telah login dan berada di Dashboard Pakar
     * Steps:
     *   1. Pakar memilih menu "Kelola Katalog" di sidebar
     *   2. Klik tombol "+ Tambah Biota"
     *   3. Pakar mengisi seluruh field yang dibutuhkan dan mengunggah foto
     *   4. Menekan tombol "Simpan"
     * Expected: Data spesies baru tersimpan ke database dan langsung tampil
     *           di halaman Kelola Biota maupun Katalog publik
     */
    public function test_pakar_menambah_spesies_baru(): void
    {
        $pakar = User::create([
            'first_name' => 'Dr. Agung',
            'last_name'  => 'Pakar',
            'email'      => 'pakar@test.com',
            'password'   => Hash::make('password123'),
            'role'       => 'pakar',
        ]);

        $this->browse(function (Browser $browser) use ($pakar) {
            $browser->loginAs($pakar)
                    ->visit('/pakar/dashboard')
                    ->clickLink('Kelola Katalog')           // FIX: teks sidebar = "Kelola Katalog", bukan "Kelola Biota"
                    ->assertPathIs('/pakar/biota')
                    ->clickLink('+ Tambah Biota')           // <a href="{{ route('pakar.biota.create') }}">
                    ->assertPathIs('/pakar/biota/create')
                    ->type('nama_biota', 'Penyu Lekang')
                    ->type('nama_ilmiah', 'Lepidochelys olivacea')
                    ->select('kategori', 'Penyu')
                    ->type('status_konservasi', 'Appendix I')
                    ->type('habitat', 'Pantai berpasir tropis')
                    ->press('Simpan')                       // button text di blade = "Simpan"
                    ->waitForLocation('/pakar/biota')
                    ->assertSee('Spesies berhasil ditambahkan!')  // flash message dari controller
                    ->assertSee('Penyu Lekang');                  // spesies muncul di tabel kelola biota

            // Tampil juga di katalog publik
            $browser->visit('/katalog')
                    ->assertSee('Penyu Lekang');
        });
    }
}