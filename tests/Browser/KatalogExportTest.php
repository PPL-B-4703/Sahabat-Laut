<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use PHPUnit\Framework\Attributes\Test;

class KatalogExportTest extends DuskTestCase
{
    #[Test]
    public function AksesTamuDitolak()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/katalog')
                    ->clickLink('Unduh PDF') 
                    ->waitForLocation('/login')
                    ->assertPathIs('/login');
        });
    }

   #[Test]
    public function EksporPDF()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('role', 'masyarakat')->first())
                    ->visit('/katalog')
                    ->clickLink('Unduh PDF') 
                    ->pause(2000);

            $files = glob(base_path('tests/Browser/downloads/*.pdf'));
            $this->assertGreaterThan(0, count($files), 'File PDF tidak ditemukan di folder download!');
            
            foreach ($files as $file) {
                unlink($file);
            } 
        });
    }

    #[Test]
    public function EksporDatasetCSV()
    {
        $this->browse(function (Browser $browser) {
            $downloadPath = base_path('tests/Browser/downloads');
            array_map('unlink', glob("$downloadPath/*.csv"));

            $browser->loginAs(User::where('role', 'masyarakat')->first())
                    ->visit('/katalog')
                    ->clickLink('Unduh Dataset (CSV)')
                    ->pause(3000);

            $files = glob("$downloadPath/*.csv");
            
            $this->assertGreaterThan(
                0, 
                count($files), 
                'Gagal: File CSV tidak ditemukan di folder download!'
            );

            foreach ($files as $file) {
                unlink($file);
            }
        });
    }
}