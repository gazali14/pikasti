<?php

use App\Http\Controllers\AdminPresensi;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\HalamanJadwalController;
use App\Http\Controllers\ProfilKaderController;
use App\Http\Controllers\HalamanDokumentasiController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\AdminKelolaKaderController;
use App\Http\Controllers\AdminKelolaJadwalController;

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

    // Route::get('/kelola_jadwal', function () {
    //     return view('admin.kelola_jadwal');
    // })->name('admin.kelola_jadwal');

    Route::get('/jadwal/search', [AdminKelolaJadwalController::class, 'search'])->name('jadwal.search');
    Route::resource('admin/jadwal', AdminKelolaJadwalController::class);
    Route::put('/jadwal/{id}', [AdminKelolaJadwalController::class, 'update'])->name('jadwal.update');
    Route::get('/kelola_jadwal', [AdminKelolaJadwalController::class, 'index'])->name('jadwal.indeks');
    Route::post('/jadwal', [AdminKelolaJadwalController::class, 'store'])->name("jadwal.store");
    Route::delete('/jadwal/{jadwal}', [AdminKelolaJadwalController::class, 'destroy'])->name("jadwal.destroy");

    // Menambahkan rute untuk pencarian jadwal
    Route::get('/jadwal/search', [AdminKelolaJadwalController::class, 'search'])->name('jadwal.search');



    // Route::get('/kelola_kader', function () {
    //     return view('admin.kelola_kader');
    // })->name('admin.kelola_kader');

  

    Route::get('/kelola_kader', [AdminKelolaKaderController::class, 'index'])->name('admin.kelola_kader.index');
    Route::post('/kelola_kader', [AdminKelolaKaderController::class, 'store'])->name('admin.kelola_kader.store');
    Route::get('/kelola_kader/{id}/edit', [AdminKelolaKaderController::class, 'edit'])->name('admin.kelola_kader.edit');
    Route::delete('/kelola_kader/{id}', [AdminKelolaKaderController::class, 'destroy'])->name('admin.kelola_kader.destroy');

    // Route::get('/presensi_kader', function () {
    //     return view('admin.presensi_kader');
    // })->name('admin.presensi_kader');
    Route::get('/presensi_kader', [KegiatanController::class, 'index'])->name('admin.presensi_kader');

    Route::get('/admin/cek-presensi-bayi/{id}', [AdminPresensi::class, 'cekPresensiBayi'])->name('cek.presensi.bayi');

    Route::get('/dokumentasi', function () {
        return view('admin.dokumentasi');
    })->name('admin.dokumentasi');

    // Route::post();
    // Route untuk menyimpan data presensi
    Route::post('/save-presensi', [AdminPresensi::class, 'savePresensi'])->name('presensi.store');

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

    Route::get('/dokumentasi', [HalamanDokumentasiController::class, 'index'])->name('orang_tua.before_login.dokumentasi');

    Route::get('/jadwal', [HalamanJadwalController::class, 'index'])->name('orang_tua.before_login.jadwal');

    Route::get('/profil_kader', [ProfilKaderController::class, 'index'])->name('orang_tua.before_login.profil_kader');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});