<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\HalamanJadwalController;
use App\Http\Controllers\ProfilKaderController;
use App\Http\Controllers\HalamanDokumentasiController;

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes for orang_tua before_login
Route::prefix('orang_tua/before_login')->group(function () {
    // Arahkan Home ke HomeController
    Route::get('/home', [HomeController::class, 'index'])->name('orang_tua.before_login.home');
    
    // Route untuk Jadwal
    Route::get('/jadwal', [HalamanJadwalController::class, 'index'])->name('jadwal');
    Route::get('/jadwal/filter', [HalamanJadwalController::class, 'filter'])->name('jadwal.filter');

    // Route untuk Profil Kader
    Route::get('/profil_kader', [ProfilKaderController::class, 'index'])->name('profil_kader');
    
    // Route untuk Dokumentasi
    Route::get('/dokumentasi', [HalamanDokumentasiController::class, 'index'])->name('dokumentasi');

    // Arahkan login ke LoginController
    Route::get('/login', [LoginController::class, 'index'])->name('orang_tua.before_login.login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'login_proses'])->name('login-proses');
});

Route::get('/kader/count-by-month', [KaderController::class, 'countKaderByMonth']);

// Routes for admin
Route::prefix('admin')->middleware('auth:kader')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/kelola_jadwal', function () {
        return view('admin.kelola_jadwal');
    })->name('admin.kelola_jadwal');

    Route::get('/kelola_kader', function () {
        return view('admin.kelola_kader');
    })->name('admin.kelola_kader');

    Route::get('/presensi_kader', function () {
        return view('admin.presensi_kader');
    })->name('admin.presensi_kader');

    Route::get('/dokumentasi', function () {
        return view('admin.dokumentasi');
    })->name('admin.dokumentasi');

    Route::get('/kohort', function () {
        return view('admin.kohort');
    })->name('admin.kohort');
});

// Routes for kader
Route::prefix('kader')->middleware('auth:kader')->group(function () {
    Route::get('/dashboard', function () {
        return view('kader.dashboard');
    })->name('kader.dashboard');

    Route::get('/konsultasi', function () {
        return view('kader.konsultasi');
    })->name('kader.konsultasi');

    Route::get('/kms', function () {
        return view('kader.kms');
    })->name('kader.kms');

    Route::get('/presensi_bayi', function () {
        return view('kader.presensi_bayi');
    })->name('kader.presensi_bayi');

    Route::get('/presensi_bayi', [KaderController::class, 'index'])->name('kader.presensi_bayi');
    Route::get('/cek_presensi/{id_kegiatan}', [KaderController::class, 'cekPresensi'])->name('kader.cek_presensi');
    Route::post('/cek_presensi/search', [KaderController::class, 'search'])->name('kader.cek_presensi.search');
    Route::post('/kader/cek-presensi/save', [KaderController::class, 'savePresensi'])->name('kader.cek_presensi.save');
    Route::get('/kader/presensi-bayi', [KaderController::class, 'presensiBayi'])->name('kader.presensi_bayi');

    Route::get('/laporan', function () {
        return view('kader.laporan');
    })->name('kader.laporan');

    Route::get('/pmt', function () {
        return view('kader.pmt');
    })->name('kader.pmt');

    Route::get('/vitamin', function () {
        return view('kader.vitamin');
    })->name('kader.vitamin');

    Route::get('/vitamin-pmt', function () {
        return view('kader.vitamin-pmt');
    })->name('kader.vitamin-pmt');
});

// Routes for orang_tua after login (Authenticated)
Route::middleware('auth:bayi')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('orang_tua.before_login.home');
    
    Route::get('/dashboard', function () {
        return view('orang_tua.dashboard');
    })->name('orang_tua.dashboard');

    Route::get('/dokumentasi', [HalamanDokumentasiController::class, 'index'])->name('dokumentasi');

    Route::get('/jadwal', [HalamanJadwalController::class, 'index'])->name('jadwal');

    Route::get('/profil_kader', [ProfilKaderController::class, 'index'])->name('profil_kader');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
