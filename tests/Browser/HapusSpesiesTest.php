<?php
// tests/Browser/HapusSpesiesTest.php
// PBI-005 | SC-05-04 / TC-05-04-01

namespace Tests\Browser;

use App\Models\Biota;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;

class HapusSpesiesTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * SC-05-04 / TC-05-04-01
     * Menghapus spesies
     *
     * Precondition: Pakar telah login dan berada di halaman "Kelola Biota"
     * Steps:
     *   1. Pakar memilih tombol "Hapus" pada spesies yang diinginkan
     *   2. Muncul popup confirm browser
     *   3. Pakar memilih "OK" pada popup
     * Expected: Data spesies terhapus dari database dan tidak lagi muncul
     *           di Kelola Biota maupun Katalog publik
     */
    public function test_pakar_menghapus_spesies(): void
    {
        $pakar = User::create([
            'first_name' => 'Dr. Agung',
            'last_name'  => 'Pakar',
            'email'      => 'pakar@test.com',
            'password'   => Hash::make('password123'),
            'role'       => 'pakar',
        ]);

        $biota = Biota::create([
            'nama_biota' => 'Spesies Akan Dihapus',
            'kategori'   => 'Lainnya',
        ]);

        $this->browse(function (Browser $browser) use ($pakar, $biota) {
            $browser->loginAs($pakar)
                    ->visit('/pakar/biota')
                    ->assertSee('Spesies Akan Dihapus')
                    ->press('Hapus')        // klik hapus dulu
                    ->pause(500)            // tunggu dialog muncul
                    ->acceptDialog()        // baru accept
                    ->pause(2000)           // tunggu reload
                    ->assertDontSee('Spesies Akan Dihapus');
                // Tidak muncul di katalog publik
            $browser->visit('/katalog')
                    ->assertDontSee('Spesies Akan Dihapus');
        });

        // Pastiin record benar-benar terhapus dari DB
        $this->assertDatabaseMissing('biotas', ['id' => $biota->id]);
    }
}