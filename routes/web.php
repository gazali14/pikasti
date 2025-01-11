<?php

use App\Models\Bayi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPresensi;
use App\Http\Controllers\KMSController;
use App\Http\Controllers\PMTController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KohortController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\VitaminController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\ProfilKaderController;
use App\Http\Controllers\HalamanJadwalController;
use App\Http\Controllers\DashboardKaderController;
use App\Http\Controllers\KehadiranKaderController;
use App\Http\Controllers\AdminKelolaKaderController;
use App\Http\Controllers\AdminKelolaJadwalController;
use App\Http\Controllers\HalamanDokumentasiController;
use App\Http\Controllers\AdminKelolaDokumentasiController;
use App\Http\Controllers\HalamanDashboardOrangTuaController;


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

Route::get('/admin/count-by-month', [KehadiranKaderController::class, 'countKaderByMonth']);

// Routes for admin
Route::prefix('admin')->middleware('auth:kader')->group(function () {
    Route::get('/dashboard', function () {
        $selectedKader = Auth::guard('kader')->user();
        return view('admin.dashboard', compact('selectedKader'));
    })->name('admin.dashboard');

    // Route::get('/kelola_jadwal', function () {
    //     return view('admin.kelola_jadwal');
    // })->name('admin.kelola_jadwal');

    Route::get('/jadwal/search', [AdminKelolaJadwalController::class, 'search'])->name('jadwal.search');
    Route::resource('jadwal', AdminKelolaJadwalController::class);
    Route::put('/jadwal/{id}', [AdminKelolaJadwalController::class, 'update'])->name('jadwal.update');
    Route::get('/kelola_jadwal', [AdminKelolaJadwalController::class, 'index'])->name('jadwal.indeks');
    Route::post('/jadwal', [AdminKelolaJadwalController::class, 'store'])->name("jadwal.store");
    Route::delete('/jadwal/{jadwal}', [AdminKelolaJadwalController::class, 'destroy'])->name("jadwal.destroy");

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
    //Route::get('/presensi_kader', [KegiatanController::class, 'index'])->name('admin.presensi_kader');
    Route::get('/presensi_kader', [KehadiranKaderController::class, 'index'])->name('admin.presensi_kader');
    Route::get('/cek_presensi_kader/{id_kegiatan}', [KehadiranKaderController::class, 'cekPresensiKader'])->name('admin.cek_presensi_kader');
    //Route::post('/cek_presensi_kader/search', [KehadiranKaderController::class, 'search'])->name('admin.cek_presensi_kader.search');
    Route::post('/admin/cek-presensi-kader/save', [KehadiranKaderController::class, 'savePresensi'])->name('admin.cek_presensi_kader.save');

    Route::get('/admin/cek-presensi-bayi/{id}', [AdminPresensi::class, 'cekPresensiBayi'])->name('cek.presensi.bayi');

    // Semua route RESTful sudah didefinisikan oleh Route::resource
    Route::resource('dokumentasi', AdminKelolaDokumentasiController::class);


    // Route::post();
    // Route untuk menyimpan data presensi
    Route::post('/save-presensi', [AdminPresensi::class, 'savePresensi'])->name('presensi.store');

    // Route::get('/kohort', function () {
    //     return view('admin.kohort');
    // })->name('admin.kohort');

     // KohortRoute::get('/admin/kohort', [KohortController::class, 'index'])->name('admin.kohort.index');
    
    Route::get('/kohort', [KohortController::class, 'index'])->name('admin.kohort.index');
    Route::post('/kohort/search', [KohortController::class, 'search'])->name('admin.kohort.search');
    Route::post('/kohort', [KohortController::class, 'store'])->name('admin.kohort.store');
    Route::get('/kohort/{nik}/edit', [KohortController::class, 'edit'])->name('admin.kohort.edit');
    Route::put('/kohort/{nik}', [KohortController::class, 'update'])->name('admin.kohort.update');
});

// Routes for kader
Route::prefix('kader')->middleware('auth:kader')->group(function () {
    Route::get('/dashboard', [DashboardKaderController::class, 'index'])->name('kader.dashboard');

    Route::get('/konsultasi', function () {
        return view('kader.konsultasi');
    })->name('kader.konsultasi');
    
   // Rute untuk menampilkan halaman konsultasi
     // Route untuk dropdown nama bayi
     Route::get('/bayi', [KonsultasiController::class, 'getBayi']);
     Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi.index'); // Halaman utama
     Route::get('/konsultasi/{nik}', [KonsultasiController::class, 'show'])->name('konsultasi.show'); // Tampilkan data berdasarkan NIK
     Route::post('/konsultasi', [KonsultasiController::class, 'store'])->name('konsultasi.store'); // Simpan data
     Route::delete('/konsultasi/{id}', [KonsultasiController::class, 'destroy'])->name('konsultasi.destroy'); // Hapus data
     Route::put('/konsultasi/{id}', [KonsultasiController::class, 'update'])->name('konsultasi.update');
   

    Route::get('/kms', function () {
        return view('kader.kms');
    })->name('kader.kms');

    Route::get('/bayi', function () {
        return response()->json(Bayi::all());
    });

    // Route untuk dropdown nama bayi
    Route::get('/bayi', [KMSController::class, 'getBayi']);
    Route::get('/kms', [KMSController::class, 'index'])->name('kms.index'); // Halaman utama
    Route::get('/kms/{nik}', [KMSController::class, 'show'])->name('kms.show'); // Tampilkan data berdasarkan NIK
    Route::post('/kms', [KMSController::class, 'store'])->name('kms.store'); // Simpan data
    Route::delete('/kms/{id}', [KMSController::class, 'destroy'])->name('kms.destroy'); // Hapus data
    Route::put('/kms/{id}', [KMSController::class, 'update'])->name('kms.update');


    Route::get('/presensi_bayi', function () {
        return view('kader.presensi_bayi');
    })->name('kader.presensi_bayi');

    Route::get('/presensi_bayi', [KaderController::class, 'index'])->name('kader.presensi_bayi');
    Route::get('/cek_presensi/{id_kegiatan}', [KaderController::class, 'cekPresensi'])->name('kader.cek_presensi');
    //Route::post('/cek_presensi/search', [KaderController::class, 'search'])->name('kader.cek_presensi.search');
    Route::post('/kader/cek-presensi/save', [KaderController::class, 'savePresensi'])->name('kader.cek_presensi.save');
    Route::get('/kader/presensi-bayi', [KaderController::class, 'presensiBayi'])->name('kader.presensi_bayi');



    Route::get('/pmt', function () {
        return view('kader.pmt');
    })->name('kader.pmt');

    // Route untuk dropdown nama bayi
   Route::get('/bayi', [PMTController::class, 'getBayi']);
   Route::get('/pmt', [PMTController::class, 'index'])->name('pmt.index'); // Halaman utama
   Route::get('/pmt/{nik}', [PMTController::class, 'show'])->name('pmt.show'); // Tampilkan data berdasarkan NIK
   Route::post('/pmt', [PMTController::class, 'store'])->name('pmt.store'); // Simpan data
   Route::delete('/pmt/{id}', [PMTController::class, 'destroy'])->name('pmt.destroy'); // Hapus data
   Route::put('/pmt/{id}', [PMTController::class, 'update'])->name('pmt.update');
    

    Route::get('/vitamin', function () {
        return view('kader.vitamin');
    })->name('kader.vitamin');


   // Route untuk dropdown nama bayi
   Route::get('/bayi', [VitaminController::class, 'getBayi']);
   Route::get('/vitamin', [VitaminController::class, 'index'])->name('vitamin.index'); // Halaman utama
   Route::get('/vitamin/{nik}', [VitaminController::class, 'show'])->name('vitamin.show'); // Tampilkan data berdasarkan NIK
   Route::post('/vitamin', [VitaminController::class, 'store'])->name('vitamin.store'); // Simpan data
   Route::delete('/vitamin/{id}', [VitaminController::class, 'destroy'])->name('vitamin.destroy'); // Hapus data
   Route::put('/vitamin/{id}', [VitaminController::class, 'update'])->name('vitamin.update');

    Route::get('/vitamin-pmt', function () {
        return view('kader.vitamin-pmt');
    })->name('kader.vitamin-pmt');


    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export', [LaporanController::class, 'exportLaporan'])->name('laporan.export');

});

// Routes for orang_tua after login (Authenticated)
Route::middleware('auth:bayi')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('orang_tua.before_login.home');

    Route::get('/dashboard', function () {
        return view('orang_tua.dashboard');
    })->name('orang_tua.dashboard');

    Route::get('/dashboard', [HalamanDashboardOrangTuaController::class, 'index'])->name('orang_tua.dashboard');

    Route::get('/dokumentasi', [HalamanDokumentasiController::class, 'index'])->name('orang_tua.before_login.dokumentasi');

    Route::get('/jadwal', [HalamanJadwalController::class, 'index'])->name('orang_tua.before_login.jadwal');

    Route::get('/profil_kader', [ProfilKaderController::class, 'index'])->name('orang_tua.before_login.profil_kader');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
