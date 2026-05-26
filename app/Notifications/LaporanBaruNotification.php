<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LaporanBaruNotification extends Notification
{
    use Queueable;

    protected $laporan;
    protected $tipe;

    // Kita passing data laporan dan tipe (untuk pakar / masyarakat)
    public function __construct($laporan, $tipe)
    {
        $this->laporan = $laporan;
        $this->tipe = $tipe;
    }

    public function via($notifiable)
    {
        return ['database']; // Menyimpan notifikasi ke dalam database
    }

    public function toArray($notifiable)
    {
        if ($this->tipe === 'untuk_pakar') {
            return [
                'title' => 'Laporan Baru Masuk!',
                'message' => 'Ada laporan baru mengenai spesies ' . $this->laporan->species . ' yang membutuhkan validasi Anda.',
                'laporan_id' => $this->laporan->id,
                'url' => route('pakar.validasi.show', $this->laporan->id),
            ];
        }

        if ($this->tipe === 'status_diperbarui') {
            return [
                'title' => 'Status Laporan Diperbarui!',
                'message' => 'Laporan Anda mengenai ' . $this->laporan->species . ' kini berstatus: ' . $this->laporan->status . '. Segera cek riwayat laporan Anda.',
                'laporan_id' => $this->laporan->id,
                'url' => route('laporan.show', $this->laporan->id),
            ];
        }

        // Default untuk masyarakat saat pertama kali kirim laporan
        return [
            'title' => 'Laporan Berhasil Terkirim',
            'message' => 'Laporan Anda mengenai ' . $this->laporan->species . ' telah diterima dan sedang menunggu verifikasi pakar.',
            'laporan_id' => $this->laporan->id,
            'url' => route('laporan.show', $this->laporan->id),
        ];
    }
}