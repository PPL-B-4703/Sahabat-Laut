# Sahabat Laut

## 1. Gambaran Proyek

Sahabat Laut adalah platform sistem informasi konservasi kelautan berbasis web yang dibuat untuk memperkuat literasi masyarakat dan mendukung partisipasi publik dalam pelestarian biota laut Indonesia.

### Latar belakang

Indonesia dikenal sebagai salah satu negara dengan keanekaragaman hayati laut tertinggi di dunia. Namun, kekayaan ini menghadapi ancaman serius karena:

- eksploitasi komersial dan penangkapan ilegal,
- rendahnya pemahaman publik tentang status perlindungan hukum berbagai spesies,
- beredarnya konten sosial media yang menampilkan jual-beli, pamer tangkapan, atau konsumsi biota laut yang dilindungi,
- mekanisme pelaporan yang masih konvensional, terpusat, dan kurang transparan.

Sahabat Laut hadir sebagai respons terhadap tantangan tersebut dengan menyediakan:

- katalog edukasi interaktif untuk biota laut dilindungi,
- sistem pelaporan mandiri digital bagi masyarakat,
- mekanisme verifikasi oleh pakar kelautan,
- transparansi status laporan dan data observasi.

### Tujuan

Pengembangan Sahabat Laut bertujuan untuk:

- menyediakan akses informasi yang akurat dan mudah dijangkau mengenai status perlindungan hukum biota laut,
- meningkatkan literasi konservasi masyarakat umum,
- memfasilitasi partisipasi aktif masyarakat dalam pemantauan sebaran spesies dilindungi,
- menjamin validitas data lapangan melalui verifikasi oleh tenaga ahli kelautan.

### Output utama

Hasil akhir proyek ini adalah aplikasi web dengan fitur-fitur berikut:

- Katalog Biota Laut — basis data interaktif berisi profil spesies, foto identifikasi, habitat, dan status perlindungan hukum.
- Sistem Pelaporan Mandiri — formulir digital untuk mengirim temuan lapangan dengan bukti visual, deskripsi, dan lokasi.
- Panel Verifikasi Pakar — antarmuka pakar kelautan untuk meninjau dan memvalidasi laporan.
- Dashboard Monitoring & Statistik Spasial — visualisasi peta sebaran dan tren laporan.
- Ekspor Dataset (PDF/CSV) — unduh data laporan tervalidasi untuk riset atau kebijakan.

Fitur pendukung:

- notifikasi status laporan kepada pelapor,
- manajemen profil pengguna dan kontribusi,
- manajemen konten edukasi dan berita oleh admin,
- pusat bantuan dan FAQ interaktif.

### Batasan sistem

- platform hanya mencakup spesies biota laut yang terdaftar dalam regulasi perlindungan di Indonesia,
- validasi laporan bergantung pada ketersediaan pakar yang terdaftar,
- platform tidak memiliki kewenangan hukum untuk menindaklanjuti laporan secara langsung;
  tindak lanjut tetap menjadi tanggung jawab otoritas berwenang (PSDKP/KKP),
- aplikasi ini dikembangkan sebagai web app dan belum mencakup aplikasi mobile native.

---

## 2. Struktur Repository

Struktur penting dalam repositori ini:

- `app/`
    - `Http/Controllers/` — logika permintaan HTTP dan pengontrol aplikasi.
    - `Models/` — model data seperti `Berita`, `Biota`, `Faq`, `Laporan`, `User`.
- `bootstrap/` — bootstrapping aplikasi Laravel.
- `config/` — konfigurasi aplikasi dan layanan.
- `database/`
    - `migrations/` — skema database.
    - `seeders/` — seed data awal.
    - `data_biota.csv` — data biota pendukung.
- `public/` — titik masuk aplikasi web dan aset publik.
- `resources/`
    - `css/` — gaya aplikasi.
    - `js/` — skrip frontend.
    - `views/` — tampilan Blade.
- `routes/`
    - `web.php` — rute web utama.
    - `api.php` — rute API.
- `storage/` — file upload, cache, dan log.
- `tests/` — pengujian unit dan fitur.
- `vendor/` — dependensi Composer.

---

## 3. Cara Akses Website dan Setup

### Persyaratan

- PHP 8.x
- Composer
- Node.js dan npm
- Database (MySQL/MariaDB atau lainnya sesuai konfigurasi `.env`)

### Langkah setup lokal

1. Clone repositori:
    ```bash
    git clone https://github.com/PPL-B-4703/Sahabat-Laut.git
    cd Sahabat-Laut
    ```
2. Install dependensi PHP dan JavaScript:
    ```bash
    composer install
    npm install
    ```
3. Siapkan file lingkungan:
    - Jika tersedia, buat salinan `.env.example` menjadi `.env`.
    - Jika tidak ada `.env.example`, pastikan file `.env` sudah ada.
    - Sesuaikan konfigurasi database dan pengaturan lainnya di file `.env`.
4. Buat kunci aplikasi Laravel:
    ```bash
    php artisan key:generate
    ```
5. Jalankan migrasi dan seed data (opsional):
    ```bash
    php artisan migrate
    php artisan db:seed
    ```
6. Buat symbolic link storage jika diperlukan:
    ```bash
    php artisan storage:link
    ```

### Menjalankan aplikasi

Jalankan backend dan frontend:

- Backend:

    ```bash
    php artisan serve
    ```

- Frontend (Vite dev server):
    ```bash
    npm run dev
    ```

Akses aplikasi di `http://127.0.0.1:8000`.

Jika ingin membuat aset produksi:

```bash
npm run build
```

---

## 4. Penjelasan Branch

Repositori ini menggunakan pemisahan cabang untuk membedakan kode stabil dari kode pengujian:

- `main` — cabang utama untuk kode yang stabil dan siap dijalankan. Dokumentasi README di `main` menjelaskan fungsi utama aplikasi dan langkah setup umum.
- `Testing` — cabang untuk pengembangan fitur testing dan eksperimen. Pada cabang ini, isi README dapat dibuat berbeda untuk menekankan strategi pengujian dan konfigurasi khusus testing.

Catatan:

- `main` fokus pada aplikasi produksi dan alur kerja deployment.
- `Testing` fokus pada pembuatan, verifikasi, dan stabilitas fitur pengujian.

---

## 5. Catatan Tambahan

- Pastikan `.env` berisi detail koneksi database yang benar.
- Jalankan `npm run dev` saat melakukan pengembangan agar perubahan CSS/JS langsung terlihat.
- Jika ada masalah pada file upload atau foto, jalankan `php artisan storage:link`.

## Lisensi

Proyek ini mengikuti lisensi MIT untuk kode sumber yang digunakan.

```

```
