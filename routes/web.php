<?php

use Illuminate\Support\Facades\Route;

// Routes for orang_tua before_login
Route::get('/', function () {
    return view('orang_tua.before_login.home');
})->name('home');

Route::prefix('orang_tua/before_login')->group(function () {
    Route::get('/home', function () {
        return view('orang_tua.before_login.home');
    })->name('orang_tua.before_login.home');
    Route::get('/dokumentasi', function () {
        return view('orang_tua.before_login.dokumentasi');
    })->name('orang_tua.before_login.dokumentasi');
    Route::get('/jadwal', function () {
        return view('orang_tua.before_login.jadwal');
    })->name('orang_tua.before_login.jadwal');
    Route::get('/profil_kader', function () {
        return view('orang_tua.before_login.profil_kader');
    })->name('orang_tua.before_login.profil_kader');
});

Route::get('/orang_tua/dashboard', function () {
    return view('orang_tua.dashboard');
})->name('orang_tua.dashboard');


// Routes for admin
Route::prefix('admin')->group(function () {
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
});

// Routes for kader
Route::prefix('kader')->group(function () {
    Route::get('/dashboard', function () {
        return view('kader.dashboard');
    })->name('kader.dashboard');

    Route::get('/konsultasi', function () {
        return view('kader.konsultasi');
    })->name('kader.konsultasi');

    Route::get('/perkembangan_bayi', function () {
        return view('kader.perkembangan_bayi');
    })->name('kader.perkembangan_bayi');

    Route::get('/presensi_bayi', function () {
        return view('kader.presensi_bayi');
    })->name('kader.presensi_bayi');
});
