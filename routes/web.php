<?php

use App\Models\Bayi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
use App\Http\Middleware\AdminMiddleware;


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes for orang_tua before_login
Route::prefix('orang_tua/before_login')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('orang_tua.before_login.home');
    Route::get('/jadwal', [HalamanJadwalController::class, 'index'])->name('jadwal');
    Route::get('/jadwal/filter', [HalamanJadwalController::class, 'filter'])->name('jadwal.filter');
    Route::get('/profil_kader', [ProfilKaderController::class, 'index'])->name('profil_kader');
    Route::get('/dokumentasi', [HalamanDokumentasiController::class, 'index'])->name('dokumentasi');

    // Arahkan login ke LoginController
    Route::get('/login', [LoginController::class, 'index'])->name('orang_tua.before_login.login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'login_proses'])->name('login-proses');
    
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
});

Route::get('/admin/count-by-month', [KehadiranKaderController::class, 'countKaderByMonth']);

// Routes for admin
Route::prefix('admin')->middleware('auth:kader')->group(function () {
    // Route untuk dashboard
     // Route untuk dashboard
    Route::get('/dashboard', function () {
        $user = Auth::guard('kader')->user();

        // Cek apakah pengguna adalah admin di dalam controller langsung
        if (!$user->is_admin) {
            return redirect()->route('orang_tua.before_login.login')->withErrors(['error' => 'Anda tidak memiliki akses ke halaman ini!']);
        }

        return view('admin.dashboard', ['selectedKader' => $user]);
    })->name('admin.dashboard');
    
    // Route untuk kelola jadwal
    Route::resource('kelola_jadwal', AdminKelolaJadwalController::class);
    // Route untuk kelola kader
    Route::get('/kelola_kader', [AdminKelolaKaderController::class, 'index'])->name('admin.kelola_kader.index');
    Route::post('/kelola_kader', [AdminKelolaKaderController::class, 'store'])->name('admin.kelola_kader.store');
    Route::get('/kelola_kader/{id}/edit', [AdminKelolaKaderController::class, 'edit'])->name('admin.kelola_kader.edit');
    Route::delete('/kelola_kader/{id}', [AdminKelolaKaderController::class, 'destroy'])->name('admin.kelola_kader.destroy');
    // Route untuk presensi kader
    Route::get('/presensi_kader', [KehadiranKaderController::class, 'index'])->name('admin.presensi_kader');
    Route::get('/cek_presensi_kader/{id_kegiatan}', [KehadiranKaderController::class, 'cekPresensiKader'])->name('admin.cek_presensi_kader');
    Route::post('/admin/cek-presensi-kader/save', [KehadiranKaderController::class, 'savePresensi'])->name('admin.cek_presensi_kader.save');
    Route::get('/admin/presensi-kader/search', [KehadiranKaderController::class, 'searchKegiatanKader'])->name('admin.presensi_kader.searchKegiatanKader');

    // Route untuk dokumentasi
    Route::resource('dokumentasi', AdminKelolaDokumentasiController::class);
    // Route untuk kohort
    Route::get('/kohort', [KohortController::class, 'index'])->name('admin.kohort.index');
    Route::post('/kohort/search', [KohortController::class, 'search'])->name('admin.kohort.search');
    Route::post('/kohort', [KohortController::class, 'store'])->name('admin.kohort.store');
    Route::get('/kohort/{nik}/edit', [KohortController::class, 'edit'])->name('admin.kohort.edit');
    Route::put('/kohort/{nik}', [KohortController::class, 'update'])->name('admin.kohort.update');
});

// Routes for kader
Route::prefix('kader')->middleware('auth:kader')->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::guard('kader')->user();

        // Validasi apakah pengguna adalah admin
        if ($user->is_admin) {
            return redirect()->route('orang_tua.before_login.login')->withErrors(['error' => 'Admin tidak dapat mengakses halaman kader.']);
        }

        // Jika bukan admin, panggil controller untuk melanjutkan logika lainnya
        return app()->call('App\Http\Controllers\DashboardKaderController@index');
    })->name('kader.dashboard');
//Route untuk konsultasi
    Route::get('/konsultasi', function () {
        return view('kader.konsultasi');
    })->name('kader.konsultasi');
    Route::get('/bayi', [KonsultasiController::class, 'getBayi']);
    Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi.index'); // Halaman utama
    Route::get('/konsultasi/{nik}', [KonsultasiController::class, 'show'])->name('konsultasi.show'); // Tampilkan data berdasarkan NIK
    Route::post('/konsultasi', [KonsultasiController::class, 'store'])->name('konsultasi.store'); // Simpan data
    Route::delete('/konsultasi/{id}', [KonsultasiController::class, 'destroy'])->name('konsultasi.destroy'); // Hapus data
    Route::put('/konsultasi/{id}', [KonsultasiController::class, 'update'])->name('konsultasi.update');
    // Route untuk kms
    Route::get('/kms', function () {
        return view('kader.kms');
    })->name('kader.kms');
    Route::get('/bayi', function () {
        return response()->json(Bayi::all());
    });
    Route::get('/bayi', [KMSController::class, 'getBayi']);
    Route::get('/kms', [KMSController::class, 'index'])->name('kms.index'); // Halaman utama
    Route::get('/kms/{nik}', [KMSController::class, 'show'])->name('kms.show'); // Tampilkan data berdasarkan NIK
    Route::post('/kms', [KMSController::class, 'store'])->name('kms.store'); // Simpan data
    Route::delete('/kms/{id}', [KMSController::class, 'destroy'])->name('kms.destroy'); // Hapus data
    Route::put('/kms/{id}', [KMSController::class, 'update'])->name('kms.update');
    //Route untuk presensi bayi
    Route::get('/presensi_bayi', function () {
        return view('kader.presensi_bayi');
    })->name('kader.presensi_bayi');
    Route::get('/presensi_bayi', [KaderController::class, 'index'])->name('kader.presensi_bayi');
    Route::get('/cek_presensi/{id_kegiatan}', [KaderController::class, 'cekPresensi'])->name('kader.cek_presensi');
    Route::post('/kader/cek-presensi/save', [KaderController::class, 'savePresensi'])->name('kader.cek_presensi.save');
    Route::get('/kader/presensi-bayi/search', [KaderController::class, 'searchKegiatan'])->name('kader.presensi_bayi.searchKegiatan');
    // Route untuk pmt
    Route::get('/pmt', function () {
        return view('kader.pmt');
    })->name('kader.pmt');
    Route::get('/bayi', [PMTController::class, 'getBayi']);
    Route::get('/pmt', [PMTController::class, 'index'])->name('pmt.index'); // Halaman utama
    Route::get('/pmt/{nik}', [PMTController::class, 'show'])->name('pmt.show'); // Tampilkan data berdasarkan NIK
    Route::post('/pmt', [PMTController::class, 'store'])->name('pmt.store'); // Simpan data
    Route::delete('/pmt/{id}', [PMTController::class, 'destroy'])->name('pmt.destroy'); // Hapus data
    Route::put('/pmt/{id}', [PMTController::class, 'update'])->name('pmt.update');
    // Route untuk vitamin
    Route::get('/vitamin', function () {
        return view('kader.vitamin');
    })->name('kader.vitamin');
    Route::get('/bayi', [VitaminController::class, 'getBayi']);
    Route::get('/vitamin', [VitaminController::class, 'index'])->name('vitamin.index'); // Halaman utama
    Route::get('/vitamin/{nik}', [VitaminController::class, 'show'])->name('vitamin.show'); // Tampilkan data berdasarkan NIK
    Route::post('/vitamin', [VitaminController::class, 'store'])->name('vitamin.store'); // Simpan data
    Route::delete('/vitamin/{id}', [VitaminController::class, 'destroy'])->name('vitamin.destroy'); // Hapus data
    Route::put('/vitamin/{id}', [VitaminController::class, 'update'])->name('vitamin.update');
    Route::get('/vitamin-pmt', function () {
        return view('kader.vitamin-pmt');
    })->name('kader.vitamin-pmt');
    // Routw untuk laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export', [LaporanController::class, 'exportLaporan'])->name('laporan.export');
});