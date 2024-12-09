<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class HalamanJadwalController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter filter tahun dari request
        $filterYear = $request->input('year');

        // Ambil data jadwal, urutkan berdasarkan tanggal descending
        $jadwals = Jadwal::when($filterYear, function ($query, $filterYear) {
            return $query->whereYear('tanggal', $filterYear);
        })
        ->orderBy('tanggal', 'desc')
        ->get();

        return view('orang_tua.before_login.jadwal', compact('jadwals', 'filterYear'));
    }
}
