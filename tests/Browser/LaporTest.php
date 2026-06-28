<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use PHPUnit\Framework\Attributes\Test;

class LaporTest extends DuskTestCase
{
    #[Test]
    public function masyarakat_bisa_mengirim_laporan_lengkap()
    {
        $user = User::where('email', 'budi@test.com')->first();
        $this->assertNotNull(
            $user,
            'User Budi tidak ditemukan di database.'
        );

        $this->browse(function (Browser $browser) use ($user) {

            $browser->loginAs($user)
                    ->visit(route('laporan.create'))
                    ->waitFor('form', 15)
                    ->select('species_category', 'Mamalia Laut')
                    ->select('aktivitas', 'Pemantauan')
                    ->type('tanggal_temuan', now()->format('Y-m-d'))
                    ->type(
                        'deskripsi_temuan',
                        'Ditemukan penyu di pantai dalam kondisi sehat'
                    )
                    ->type('alamat_detail', 'Pantai Pangandaran')
                    ->type('deskripsi_lokasi', 'Dekat area karang');
            $browser->script("
                document.querySelector('input[name=\"provinsi\"]').value = 'Jawa Barat';
                document.querySelector('input[name=\"latitude\"]').value = '-6.91750000';
                document.querySelector('input[name=\"longitude\"]').value = '107.61910000';
            ");
            $browser->attach(
                'attachments[]',
                realpath(__DIR__ . '/penyu.png')
            );
            $browser->press('Kirim Laporan Sekarang')
                    ->pause(5000);

            $browser->assertSee('Mamalia Laut');
        });
    }

    #[Test]
    public function masyarakat_tidak_bisa_mengirim_laporan_jika_spesies_kosong()
    {
        $user = User::where('email', 'budi@test.com')->first();

        $this->assertNotNull(
            $user,
            'User Budi tidak ditemukan di database.'
        );

        $this->browse(function (Browser $browser) use ($user) {

            $browser->loginAs($user)
                    ->visit(route('laporan.create'))
                    ->waitFor('form', 15)
                    ->select('aktivitas', 'Pemantauan')
                    ->type('tanggal_temuan', now()->format('Y-m-d'))
                    ->type(
                        'deskripsi_temuan',
                        'Ditemukan penyu di pantai dalam kondisi sehat'
                    )
                    ->type('alamat_detail', 'Pantai Pangandaran')
                    ->type('deskripsi_lokasi', 'Dekat area karang');
            $browser->script("
                document.querySelector('input[name=\"provinsi\"]').value = 'Jawa Barat';
                document.querySelector('input[name=\"latitude\"]').value = '-6.91750000';
                document.querySelector('input[name=\"longitude\"]').value = '107.61910000';
            ");
            $browser->attach(
                'attachments[]',
                realpath(__DIR__ . '/penyu.png')
            );

            $browser->press('Kirim Laporan Sekarang')
                    ->pause(2000);

            $message = $browser->script("
                return document.querySelector('[name=\"species_category\"]')
                    .validationMessage;
            ");

            $this->assertNotEmpty($message[0]);

            $browser->assertPathIs('/masyarakat/lapor');
        });
    }
}