# SI PANTAU TPS — Panduan Pemula

Proyek ini dibuat dengan Laravel, PHP, MySQL, Blade, dan Leaflet/OpenStreetMap. Nama file dan bagian yang dibuat khusus untuk proyek menggunakan bahasa Indonesia sebisa mungkin. Beberapa nama bawaan Laravel tetap berbahasa Inggris karena merupakan aturan standar framework; mengubahnya sembarangan dapat membuat aplikasi tidak berjalan.

## 1. Menyiapkan database
1. Jalankan MySQL melalui XAMPP.
2. Buka phpMyAdmin, lalu buat database `si_pantau_tps`.
3. Buka file `.env` dan sesuaikan pengaturan database:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=si_pantau_tps
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan nama pengguna dan kata sandi dengan pengaturan MySQL di laptopmu.

## 2. Menjalankan aplikasi
Buka terminal VS Code pada folder proyek, lalu jalankan satu per satu:

```bash
php artisan key:generate
php artisan config:clear
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Buka alamat yang muncul di terminal, biasanya `http://127.0.0.1:8000`. Jika dependensi belum tersedia, jalankan `composer install` terlebih dahulu.

## 3. Akun contoh untuk uji coba
- Admin: `admin@pantautps.test` / `Admin12345!`
- UPTD: `uptd@pantautps.test` / `Uptd12345!`
- Supir: `supir@pantautps.test` / `Supir12345!`

Akun ini hanya untuk pengujian lokal. Ganti kata sandinya sebelum aplikasi dipakai bersama. Masyarakat dapat membuat akun melalui halaman pendaftaran.

## 4. Contoh nama file proyek
- `PengelolaTpsController.php` — mengatur proses halaman dan laporan.
- `Pengguna.php` — data akun pengguna.
- `Laporan.php` — data pengaduan TPS.
- `FotoLaporan.php` — foto bukti pengaduan.
- `RiwayatStatus.php` — catatan perubahan status.
- `Penugasan.php` — data tugas supir.
- `resources/views/laporan/` — tampilan terkait laporan.
- `resources/views/pengguna/` — tampilan pengelolaan pengguna.
- `resources/views/tata_letak/utama.blade.php` — kerangka tampilan utama.
- `resources/views/beranda.blade.php` — halaman ringkasan setelah masuk.

Nama standar Laravel seperti `routes/web.php`, `Controller.php`, `artisan`, `composer.json`, `resources/js/app.js`, dan `resources/css/app.css` tetap dipertahankan agar alat Laravel bekerja sebagaimana mestinya.

## 5. Catatan sebelum demo
- Aturan urgensi pada versi awal masih sederhana: kondisi meluber menjadi sangat tinggi, penuh menjadi tinggi, dan hampir penuh menjadi sedang. Cocokkan dengan aturan final kelompok.
- Periksa data wilayah dan akun UPTD agar sesuai pembagian wilayah sebenarnya.
- Uji semua peran, unggahan foto, pembatasan akses, perubahan status, dan penugasan sebelum demonstrasi.
- Implementasi ini masih perlu diuji di laptop pengembang; jangan langsung digunakan sebagai aplikasi produksi.
