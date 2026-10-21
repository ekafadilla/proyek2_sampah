<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengelolaTpsController;

// Beranda publik; pengguna yang sudah masuk diarahkan ke dashboard.
Route::get('/', [PengelolaTpsController::class, 'home'])->name('home');

// Autentikasi
Route::get('/login', [PengelolaTpsController::class, 'formLogin'])->name('login');
Route::post('/login', [PengelolaTpsController::class, 'prosesLogin'])->name('login.store');
Route::post('/logout', [PengelolaTpsController::class, 'logout'])->name('logout');
Route::get('/register', [PengelolaTpsController::class, 'formRegister'])->name('register');
Route::post('/register', [PengelolaTpsController::class, 'prosesRegister'])->name('register.store');

// Dashboard
Route::get('/dashboard', [PengelolaTpsController::class, 'dashboard'])->name('dashboard');

// Data TPS
Route::get('/data-tps', [PengelolaTpsController::class, 'dataTps'])
    ->name('data-tps');

Route::get('/data-tps', [PengelolaTpsController::class, 'dataTps'])
    ->name('data_tps.daftar');

Route::post('/data-tps', [PengelolaTpsController::class, 'simpanTps'])
    ->name('data-tps.simpan');

// Laporan
Route::get('/laporan', [PengelolaTpsController::class, 'laporan'])->name('laporan.index');
Route::get('/laporan/buat', [PengelolaTpsController::class, 'buatLaporan'])->name('laporan.buat');
Route::post('/laporan', [PengelolaTpsController::class, 'simpanLaporan'])->name('laporan.simpan');
Route::get('/laporan-saya', [PengelolaTpsController::class, 'laporanSaya'])->name('laporan.saya');
Route::get('/laporan/{laporan}', [PengelolaTpsController::class, 'detailLaporan'])->whereNumber('laporan')->name('laporan.detail');
Route::patch('/laporan/{laporan}/status', [PengelolaTpsController::class, 'ubahStatusLaporan'])->whereNumber('laporan')->name('laporan.status');
Route::post('/laporan/{laporan}/tugaskan', [PengelolaTpsController::class, 'tugaskanLaporan'])->whereNumber('laporan')->name('laporan.tugaskan');

// Tugas supir
Route::get('/tugas-saya', [PengelolaTpsController::class, 'tugasSaya'])->name('tugas.saya');
Route::patch('/tugas/{laporan}/status', [PengelolaTpsController::class, 'ubahStatusTugas'])->whereNumber('laporan')->name('tugas.status');

// Pengguna dan rekapitulasi
Route::get('/pengguna', [PengelolaTpsController::class, 'pengguna'])->name('pengguna.index');
Route::post('/pengguna', [PengelolaTpsController::class, 'simpanPengguna'])->name('pengguna.simpan');
Route::get('/rekapitulasi', [PengelolaTpsController::class, 'rekapitulasi'])->name('rekapitulasi');
