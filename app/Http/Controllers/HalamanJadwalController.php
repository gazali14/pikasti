<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class HalamanJadwalController extends Controller
{
    public function index()
    {
        // Ambil semua jadwal dengan urutan descending berdasarkan tanggal
        $jadwals = Jadwal::orderBy('tanggal', 'desc')->get();

        return view('orang_tua/before_login/jadwal', compact('jadwals'));
    }

    public function filter(Request $request)
    {
        $year = $request->input('year');

        $latestJadwal = Jadwal::latest('tanggal')->first();
        if ($year) {
            // Filter berdasarkan tahun
            $jadwals = Jadwal::whereYear('tanggal', $year)->orderBy('tanggal', 'desc')->get();
        } else {
            // Semua jadwal
            $jadwals = Jadwal::orderBy('tanggal', 'desc')->get();
        }

        // Format data untuk response AJAX
        $jadwals = $jadwals->map(function ($jadwal) use ($latestJadwal) {
            return [
                'id' => $jadwal->id,
                'nama_kegiatan' => $jadwal->nama_kegiatan,
                'tanggal' => date('d M Y', strtotime($jadwal->tanggal)),
                'waktu' => date('H:i', strtotime($jadwal->waktu)) . ' - Selesai',
                'isLatest' => $jadwal->id === $latestJadwal->id,
            ];
        });

        return response()->json($jadwals);
    }
}
