<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Kader;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 3 jadwal terbaru
        $jadwal = Jadwal::orderBy('tanggal', 'asc')->take(3)->get();

        // Ambil 3 kader untuk ditampilkan
        $kader = Kader::take(3)->get();

        // Kirim data ke view
        return view('orang_tua.before_login.home', compact('jadwal', 'kader'));
    }
}
