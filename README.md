# 🗑️ Sistem Pengaduan dan Monitoring TPS Sampah

<p align="center">
  <strong>Sistem Informasi Pelaporan Kondisi Tempat Penampungan Sementara (TPS) Berbasis Web</strong>
  <br>
  Membantu masyarakat melaporkan kondisi TPS dan memudahkan petugas memantau penanganan sampah secara terstruktur.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-Web%20Framework-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-Backend-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Status-Academic%20Project-blue?style=for-the-badge" alt="Status proyek">
</p>

---

## 📌 Tentang Proyek

**Sistem Pengaduan dan Monitoring TPS Sampah** merupakan aplikasi berbasis web yang dirancang untuk membantu masyarakat menyampaikan laporan kondisi Tempat Penampungan Sementara (TPS) sampah serta membantu petugas dalam melakukan pemantauan dan tindak lanjut laporan.

Melalui aplikasi ini, laporan dapat dilengkapi dengan foto, lokasi, waktu, kategori kondisi, dan keterangan. Petugas dapat memverifikasi laporan, menentukan tingkat urgensi, memperbarui status penanganan, serta melihat riwayat kondisi TPS.

## ✨ Fitur Utama

| Fitur | Deskripsi |
|---|---|
| 📝 Pelaporan TPS | Melaporkan kondisi TPS penuh, hampir penuh, atau sampah meluber. |
| 📷 Foto Laporan | Menyertakan foto sebagai bukti kondisi TPS. |
| 🗺️ Peta Lokasi | Menampilkan lokasi TPS menggunakan peta digital. |
| 📊 Dashboard | Memantau data dan laporan kondisi TPS. |
| 🔎 Verifikasi Laporan | Memeriksa laporan yang dikirimkan masyarakat. |
| 🚦 Tingkat Urgensi | Mengelompokkan laporan berdasarkan tingkat urgensi. |
| 🔄 Status Penanganan | Memantau perkembangan tindak lanjut laporan. |
| 📚 Riwayat TPS | Menyimpan riwayat laporan dan penanganan TPS. |
| 👥 Manajemen Data | Mengelola data TPS, pengguna, petugas, dan laporan. |

## 👥 Hak Akses Pengguna

- **Masyarakat:** membuat laporan dan memantau status laporan.
- **Petugas:** memverifikasi laporan, menentukan urgensi, memperbarui status, dan mencatat tindak lanjut.
- **Admin DLH:** mengelola data sistem dan memantau rekap laporan.

## 🛠️ Teknologi

| Teknologi | Kegunaan |
|---|---|
| Laravel | Framework aplikasi web |
| PHP | Pemrograman backend |
| MySQL | Pengelolaan database |
| Bootstrap | Antarmuka responsif |
| Leaflet.js | Peta interaktif |
| OpenStreetMap | Peta dasar |
| JavaScript | Interaksi antarmuka |
| Git & GitHub | Pengelolaan versi kode |

## ⚙️ Instalasi dan Menjalankan Proyek

### 1. Clone repository

```bash
git clone https://github.com/ekafadilla/proyek2_sampah.git
```

### 2. Masuk ke direktori proyek

```bash
cd proyek2_sampah
```

### 3. Instal dependensi

```bash
composer install
npm install
```

### 4. Konfigurasi environment

Salin file `.env.example` menjadi `.env` menggunakan PowerShell:

```powershell
Copy-Item .env.example .env
```

### 5. Buat application key

```bash
php artisan key:generate
```

### 6. Konfigurasi database

Buat database MySQL terlebih dahulu, kemudian sesuaikan pengaturan koneksi database pada file `.env`.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan nilai konfigurasi dengan lingkungan lokal masing-masing.

### 7. Jalankan migrasi

```bash
php artisan migrate
```

Jalankan langkah ini setelah memastikan migrasi proyek sudah tersedia.

### 8. Jalankan aplikasi

Terminal pertama:

```bash
php artisan serve
```

Terminal kedua:

```bash
npm run dev
```

Buka alamat lokal yang ditampilkan Laravel, biasanya:

```text
http://127.0.0.1:8000
```

## 🔄 Alur Sistem

```text
Masyarakat
    │
    ▼
Membuat Laporan TPS
    │
    ▼
Foto, Lokasi, dan Keterangan
    │
    ▼
Verifikasi oleh Petugas
    │
    ▼
Penentuan Tingkat Urgensi
    │
    ▼
Tindak Lanjut Penanganan
    │
    ▼
Pembaruan Status dan Riwayat TPS
```

## 🧪 Pengujian

Pengujian direncanakan menggunakan metode **Black-Box Testing** untuk memeriksa fungsi sistem, meliputi:

- Registrasi dan login.
- Pengelolaan data TPS.
- Pembuatan laporan dan unggah foto.
- Verifikasi dan pembaruan status laporan.
- Pencatatan tindak lanjut.
- Riwayat laporan dan TPS.
- Hak akses setiap pengguna.

## 🎯 Tujuan Proyek

- Mempermudah masyarakat melaporkan kondisi TPS.
- Membantu petugas memantau laporan dan tindak lanjut.
- Menyediakan dokumentasi riwayat kondisi TPS.
- Mendukung pengelolaan informasi sampah yang lebih terstruktur.

## 🚧 Batasan Sistem

Sistem berfokus pada pelaporan dan monitoring kondisi TPS. Sistem tidak mencakup pengaturan rute kendaraan otomatis, IoT, kecerdasan buatan, atau prediksi volume sampah otomatis.

## 👩‍💻 Tim Pengembang

**Program Studi D3 Teknik Informatika**  
**Politeknik Negeri Indramayu**

| No. | Nama |
|---:|---|
| 1 | Amanda Zulfah |
| 2 | Anggi Kumalasari |
| 3 | Eka Fadilla |
| 4 | Nadifa Aulia |

---

<p align="center">
  <strong>Sistem Informasi Pengaduan dan Monitoring TPS Sampah</strong>
  <br>
  <sub>Proyek Akademik • Teknik Informatika • 2026</sub>
</p>
