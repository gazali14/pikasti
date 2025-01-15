<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Kader;
use App\Models\Dokumentasi;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil jadwal terurut berdasarkan tanggal terdekat ke hari ini
        $today = now()->toDateString(); 
        // Urutkan jadwal dengan tanggal terdekat ke hari ini (tanpa DATEDIFF, gunakan julianday)
        $jadwal = Jadwal::orderByRaw("
            CASE 
                WHEN tanggal >= ? THEN 0 
                ELSE 1 
            END, 
            ABS(julianday(tanggal) - julianday(?))
        ", [$today, $today])
            ->take(3) // Batasi hasil maksimal 3
            ->get();

        // Ambil 3 kader untuk ditampilkan
        $kader = Kader::take(3)->get();

        // Ambil 3 dokumentasi terbaru
        $dokumentasis = Dokumentasi::orderBy('tanggal', 'desc')->take(3)->get();

        // Kirim data ke view
        return view('orang_tua.before_login.home', compact('jadwal', 'kader', 'dokumentasis'));
    }
}
