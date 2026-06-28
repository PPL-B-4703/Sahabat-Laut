<?php
// tests/Browser/EditSpesiesTest.php
// PBI-005 | SC-05-03 / TC-05-03-01

namespace Tests\Browser;

use App\Models\Biota;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;

class EditSpesiesTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * SC-05-03 / TC-05-03-01
     * Mengedit spesies
     *
     * Precondition: Pakar telah login dan berada di halaman "Kelola Biota"
     * Steps:
     *   1. Pakar memilih tombol "Edit" pada salah satu spesies
     *   2. Pakar mengganti deskripsi dan status konservasi
     *   3. Menekan tombol "Update"
     * Expected: Perubahan data tersimpan dan langsung terlihat
     *           di halaman detail maupun katalog publik
     */
    public function test_pakar_mengedit_spesies(): void
    {
        $pakar = User::create([
            'first_name' => 'Dr. Agung',
            'last_name'  => 'Pakar',
            'email'      => 'pakar@test.com',
            'password'   => Hash::make('password123'),
            'role'       => 'pakar',
        ]);

        $biota = Biota::create([
            'nama_biota'        => 'Penyu Hijau',
            'nama_ilmiah'       => 'Chelonia mydas',
            'kategori'          => 'Penyu',
            'status_konservasi' => 'Appendix I',
            'deskripsi'         => 'Deskripsi lama.',
        ]);

        $this->browse(function (Browser $browser) use ($pakar, $biota) {
            $browser->loginAs($pakar)
                    ->visit('/pakar/biota')
                    ->clickLink('Edit')                                  // tombol Edit di row biota ini (satu-satunya row)
                    ->assertPathIs('/pakar/biota/' . $biota->id . '/edit')
                    ->clear('deskripsi')
                    ->type('deskripsi', 'Deskripsi baru hasil edit pakar.')
                    ->clear('status_konservasi')
                    ->type('status_konservasi', 'Vulnerable')
                    ->press('Update')                                    // button text di blade = "Update"
                    ->waitForLocation('/pakar/biota')
                    ->assertSee('Spesies berhasil diperbarui!')          // flash message dari controller
                    ->assertSee('Vulnerable');                           // kolom status_konservasi tampil di tabel

            // Perubahan terlihat di halaman detail publik
            $browser->visit('/katalog/' . $biota->id)
                    ->assertSee('Deskripsi baru hasil edit pakar.')      // deskripsi tampil di detail page
                    ->assertSee('Vulnerable');

            // Perubahan terlihat di katalog
            $browser->visit('/katalog')
                    ->assertSee('Vulnerable');
        });
    }
}