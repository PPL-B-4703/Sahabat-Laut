<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## 🚀 Panduan Instalasi (Local Setup)

Ikuti langkah-langkah di bawah ini setelah melakukan `git clone` untuk menjalankan proyek:

### 1. Install Library & Package
Jalankan perintah ini secara berurutan di terminal:

```bash
composer install
npm install
npm install -D tailwindcss@^4.0.0

> [!IMPORTANT]
> Jika muncul file `tailwind.config.js` dan `postcss.config.js` setelah instalasi Tailwind di atas, segera **HAPUS** kedua file tersebut.

### 2. Konfigurasi Storage
Jika gambar/aset tidak terbaca, hubungkan folder storage dengan perintah:

```bash
php artisan storage:link
```

### 3. Cara Menjalankan Aplikasi
Buka **dua terminal** terpisah dan jalankan perintah berikut:

* **Terminal 1 (Backend):**
    ```bash
    php artisan serve
    ```

* **Terminal 2 (Frontend):**
    ```bash
    npm run build
    npm run dev
    ```

---

## 📝 Catatan Tambahan
- Pastikan konfigurasi `.env` sudah sesuai (DB Connection, dll).
- Jika ada perubahan pada CSS/JS, pastikan terminal `npm run dev` tetap berjalan.

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
```