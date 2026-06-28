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
                    ->assertPathIs('/pakar/dashboard')
                    ->assertSee('Dashboard');
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
        $this->withoutMiddleware();

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

        $this->actingAs(\App\Models\User::find(2))
             ->post('/pakar/validasi/bulk-verify', [
                 'ids' => [$laporan1->id, $laporan2->id],
                 'koreksi' => 'Validasi massal via tes'
             ])->assertStatus(200);

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
            
            $browser->clickAtXPath('//div[@x-data and contains(.,"Status")]//button')
                    ->pause(500); 

            $browser->waitForText('Terverifikasi')
                    ->clickAtXPath('//div[contains(text(), "Terverifikasi")]')
                    
                    ->type('koreksi', 'Data biota sesuai dengan panduan konservasi.')
                    
                    ->script("document.getElementById('pernyataan').checked = true;");

            $browser->press('SIMPAN VALIDASI')
                    ->waitForLocation('/pakar/validasi');

            $laporan = \App\Models\Laporan::find(1);
            $this->assertEquals('Terverifikasi', $laporan->status, 'Status laporan di database tidak berubah!');
            
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
            \App\Models\Laporan::where('id', 1)->update(['status' => 'Menunggu Verifikasi']);

            $browserPakar->loginAs(\App\Models\User::find(2))
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
            
            $browser->visit('/logout')
                    ->loginAs(User::where('role', 'masyarakat')->first())
                    ->visit('/masyarakat/lapor/1')
                    ->pause(2000)
                    ->assertSee('Terverifikasi')
                    ->assertSee('Edukasi: Pastikan biota laut tidak disentuh langsung.');
        });
    }
}
