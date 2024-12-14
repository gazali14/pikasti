<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Menampilkan daftar kegiatan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua data kegiatan dari tabel 'jadwal'
        $kegiatan = Jadwal::orderBy('tanggal_kegiatan', 'asc')->get();

        // Kirim data ke view
        return view('admin.presensi_kader', compact('kegiatan'));
    }
}
