# Paket Revisi SI PANTAU TPS — Mengikuti Mockup

Paket ini berisi pembaruan tampilan dashboard, navigasi berdasarkan peran, form laporan dengan foto opsional, dan seeder data demonstrasi.

## Akun demonstrasi
- Admin: `admin@pantautps.test` / `Admin12345!`
- UPTD: `uptd@pantautps.test` / `Uptd12345!`
- Supir: `supir@pantautps.test` / `Supir12345!`
- Masyarakat: `masyarakat@pantautps.test` / `Warga12345!`
- Masyarakat tambahan: `warga2@pantautps.test` dan `warga3@pantautps.test` / `Warga12345!`

Akun yang sudah ada tidak ditimpa oleh seeder karena menggunakan `firstOrCreate`.

## Cara menerapkan ke proyek yang sudah ada
1. Cadangkan folder proyek `SI_PANTAU_TPS` terlebih dahulu.
2. Ekstrak paket revisi ke folder proyek `C:\xampp\htdocs\SI_PANTAU_TPS`, pilih **replace** jika ditanya untuk berkas yang ada.
3. Jangan mengganti atau menghapus file `.env` yang sudah dikonfigurasi dan jangan menghapus folder `vendor`.
4. Dari terminal di folder proyek, jalankan `php artisan db:seed` untuk menambahkan data demonstrasi.
5. Jalankan `php artisan serve`, lalu buka `http://127.0.0.1:8000`.

**Jangan jalankan `php artisan migrate:fresh`** karena perintah itu menghapus tabel dan data yang sudah ada.

Data laporan, TPS, dan penugasan dalam seeder merupakan data dummy untuk demonstrasi, bukan laporan operasional nyata. Foto tidak disertakan dan bersifat opsional saat membuat laporan.
