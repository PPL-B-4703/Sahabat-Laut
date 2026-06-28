<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class PanelVerifikasiTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testLoginPakar()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'pakar@test.com')
                    ->type('password', 'password123')
                    ->press('Masuk Sekarang')
                    ->pause(1000)
                    ->waitForLocation('/pakar/dashboard')
                    // Tambahkan assertion di bawah ini:
                    ->assertPathIs('/pakar/dashboard')
                    ->assertSee('Dashboard'); // Ganti 'Dashboard' dengan teks yang ada di menu/halaman pakar
        });
    }

    public function testValidasiCheckbox()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(2))
                    ->visit('/pakar/validasi')
                    ->check('input[onclick="toggleSemua(this)"]') 
                    ->assertChecked('input[onclick="toggleSemua(this)"]');
        });
    }

    public function testValidasiMassal()
    {
        // Menambahkan ini akan menonaktifkan semua middleware (termasuk CSRF) selama tes ini
        $this->withoutMiddleware();

        // 1. Persiapan Data
        $dataDummy = [
            'user_id'          => 1, 
            'species'          => 'Penyu Hijau',
            'tanggal_temuan'   => '2026-06-28',
            'deskripsi_temuan' => 'Ditemukan di pesisir pantai',
            'aktivitas'        => 'Observasi',
            'alamat_lokasi'    => 'Jl. Pantai Indah No. 1, Provinsi Jawa Barat',
            'deskripsi_lokasi' => 'Lokasi terbuka dekat batu karang',
            'latitude'         => -6.9147,
            'longitude'        => 107.6098,
            'status'           => 'Menunggu Verifikasi',
        ];

        $laporan1 = \App\Models\Laporan::create($dataDummy);
        $laporan2 = \App\Models\Laporan::create($dataDummy);

        // 2. Aksi
        $this->actingAs(\App\Models\User::find(2))
             ->post('/pakar/validasi/bulk-verify', [
                 'ids' => [$laporan1->id, $laporan2->id],
                 'koreksi' => 'Validasi massal via tes'
             ])->assertStatus(200);

        // 3. Assertion
        $this->assertEquals('Terverifikasi', $laporan1->fresh()->status, 'Laporan 1 gagal terupdate!');
        $this->assertEquals('Terverifikasi', $laporan2->fresh()->status, 'Laporan 2 gagal terupdate!');
        
        $laporan1->delete();
        $laporan2->delete();
    }

    #[Test]
    public function testValidasiTunggal()
    {
        $this->browse(function (Browser $browser) {
            \App\Models\Laporan::where('id', 1)->update(['status' => 'Menunggu Verifikasi']);

            $browser->loginAs(\App\Models\User::find(2))
                    ->visit('/pakar/validasi/1')
                    ->waitForText('SIMPAN VALIDASI', 10);
            
            // 1. Klik tombol dropdown status menggunakan XPath yang lebih aman
            // Kita cari button yang berada di dalam div status
            $browser->clickAtXPath('//div[@x-data and contains(.,"Status")]//button')
                    ->pause(500); // Tunggu sebentar agar dropdown muncul

            // 2. Pilih "Terverifikasi"
            // Kita cari elemen div yang berisi teks "Terverifikasi" dan klik
            $browser->waitForText('Terverifikasi')
                    ->clickAtXPath('//div[contains(text(), "Terverifikasi")]')
                    
                    // 3. Input Koreksi
                    ->type('koreksi', 'Data biota sesuai dengan panduan konservasi.')
                    
                    // 4. Checkbox
                    ->script("document.getElementById('pernyataan').checked = true;");

            // 5. Simpan
            $browser->press('SIMPAN VALIDASI')
                    ->waitForLocation('/pakar/validasi');

            // 6. Assert
            $laporan = \App\Models\Laporan::find(1);
            $this->assertEquals('Terverifikasi', $laporan->status, 'Status laporan di database tidak berubah!');
            
            // Ganti baris 83 dengan ini:
            $browser->assertPathIs('/pakar/validasi'); 
        });
    }

    public function StatistikDashboardTerupdate()
    {
        $this->browse(function (Browser $browser) {
            \App\Models\Laporan::where('id', 1)->update(['status' => 'Menunggu Verifikasi']);

            $browser->loginAs(\App\Models\User::find(2))
                    ->visit('/pakar/validasi/1')
                    ->clickAtXPath('//button[contains(., "Terverifikasi")]')
                    ->waitForText('Terverifikasi')
                    ->clickAtXPath('//div[contains(text(), "Terverifikasi")]')
                    ->script('document.getElementById("pernyataan").click();');
            
            $browser->press('SIMPAN VALIDASI')
                    ->waitForLocation('/pakar/validasi');

            $browser->visit('/pakar/dashboard');

            $browser->waitFor('h3', 10);

            $count = $browser->script("return document.querySelectorAll('h3')[2].innerText;")[0];

            $this->assertGreaterThan(0, (int)$count, "Statistik Laporan Selesai harus lebih dari 0");
        });
    }

    public function test_AlurFeedbackEdukatif()
    {
        $this->browse(function (Browser $browserPakar, Browser $browserMasyarakat) {
            // --- STEP 1: Pakar memberikan feedback (TC-14-01-01) ---
            \App\Models\Laporan::where('id', 1)->update(['status' => 'Menunggu Verifikasi']);

            $browserPakar->loginAs(\App\Models\User::find(2)) // ID Pakar
                        ->visit('/pakar/validasi/1')
                        ->clickAtXPath('//button[contains(., "Terverifikasi")]')
                        ->waitForText('Terverifikasi')
                        ->clickAtXPath('//div[contains(text(), "Terverifikasi")]')
                        ->type('koreksi', 'Edukasi: Pastikan biota laut tidak disentuh langsung.')
                        ->script('document.getElementById("pernyataan").click();');
            
            $browserPakar->press('SIMPAN VALIDASI')
                        ->waitForLocation('/pakar/validasi');

            $browserMasyarakat->visit('/logout') 
                              ->loginAs(\App\Models\User::where('role', 'masyarakat')->first()) 
                              ->visit('/masyarakat/lapor/1')
                              ->pause(2000)
                              ->assertSee('Edukasi: Pastikan biota laut tidak disentuh langsung.');
            });
    }

    public function test_MasyarakatMenerimaFeedback()
    {
        $this->browse(function (Browser $browser) {
            // Kita asumsikan laporan id 1 sudah diupdate oleh test sebelumnya
            
            $browser->visit('/logout')
                    ->loginAs(User::where('role', 'masyarakat')->first())
                    ->visit('/masyarakat/lapor/1')
                    ->pause(2000)
                    ->assertSee('Terverifikasi')
                    ->assertSee('Edukasi: Pastikan biota laut tidak disentuh langsung.');
        });
    }
}
