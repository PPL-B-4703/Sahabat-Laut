# Sahabat Laut - README Branch Testing

> Dokumen ini khusus untuk branch `Testing` dan menjelaskan tujuan, struktur, dan alur kerja pengujian pada branch tersebut.

## 1. Tujuan Branch Testing

Branch `Testing` dibuat untuk memisahkan kode pengembangan dan eksperimen dari branch `main` yang lebih stabil.

Fokus utama branch ini:

- mengembangkan fitur baru tanpa memengaruhi produksi,
- menguji skenario dan alur validasi laporan,
- mengevaluasi integrasi frontend-backend,
- memeriksa stabilitas migrasi dan seed data,
- mendokumentasikan perubahan pengujian yang berbeda dari branch `main`.

## 2. Perbedaan dengan Branch `main`

- `main` berisi kode yang dianggap stabil dan siap digunakan oleh pengguna akhir.
- `Testing` berisi percobaan fitur, kode tambahan untuk pengujian, dan dokumentasi khusus pengujian.
- README di branch `main` bersifat umum dan berorientasi setup aplikasi.
- README di branch `Testing` ini berorientasi pada proses testing, verifikasi, dan skenario uji.

## 3. Komponen Utama untuk Testing

Branch ini umumnya memerhatikan beberapa area berikut:

- `tests/` — pengujian unit dan fitur Laravel.
- `database/migrations/` dan `database/seeders/` — memastikan skema data dan seed dapat diverifikasi.
- `app/Http/Controllers/` — alur validasi laporan, manajemen konten, dan autentikasi.
- `resources/js/` dan `resources/css/` — pemeriksaan perubahan frontend terhadap tampilan dan fungsi.
- `routes/web.php` dan `routes/api.php` — memastikan semua rute testing berfungsi.

## 4. Instruksi Setup Lokal untuk Testing

Langkah yang sama seperti setup di branch `main`, dengan tambahan perhatian pada data test:

1. Pastikan berada di branch `Testing`:
    ```bash
    git checkout Testing
    ```
2. Install dependensi jika belum:
    ```bash
    composer install
    npm install
    ```
3. Siapkan file `.env` dan konfigurasi database khusus testing jika diperlukan.
4. Jalankan migrasi dan seed data:
    ```bash
    php artisan migrate:fresh --seed
    ```
5. Buat symbolic link storage jika belum:
    ```bash
    php artisan storage:link
    ```
6. Jalankan server lokal:
    ```bash
    php artisan serve
    npm run dev
    ```

> Jika ingin menggunakan database khusus untuk testing, gunakan pengaturan terpisah di `.env.testing` dan jalankan perintah yang sesuai.

## 5. Rencana Pengujian

Pada branch `Testing`, beberapa rencana pengujian yang disarankan:

- uji alur pelaporan mandiri dengan berbagai jenis input dan gambar,
- uji validasi laporan oleh pakar dengan status laporan yang berubah,
- verifikasi tampilan katalog biota laut dan filter pencarian,
- uji notifikasi status laporan kepada pelapor,
- jalankan pengujian unit/fungsional di direktori `tests/`.

### Contoh perintah pengujian

```bash
php artisan test
```

Jika ada skrip testing tambahan di masa depan, dokumentasikan di file ini atau pada branch `Testing`.

## 6. Lampiran SPS Test Case

Dokumentasi test case yang sudah dilakukan dapat dilihat di spreadsheet berikut:

- SPS Test Case: https://docs.google.com/spreadsheets/d/1alVf683kGJs23A1mt88X4zc5sh5AFu_CIrDhOcs28-Q/edit?usp=sharing

Spreadsheet tersebut berisi daftar test case, status pelaksanaan, dan hasil verifikasi untuk setiap skenario.

## 7. Batasan dan Catatan Khusus Branch Testing

- Branch ini tidak otomatis menjadi branch produksi.
- Hasil eksperimen dan kode sementara di `Testing` harus diverifikasi sebelum digabungkan ke `main`.
- README di branch ini tidak mengubah fungsionalitas runtime, tetapi membantu tim memahami tujuan uji.
