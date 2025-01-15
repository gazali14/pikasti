<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class HalamanJadwalController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();
        // Ambil semua jadwal dengan urutan descending berdasarkan tanggal
        $jadwals = Jadwal::orderBy('tanggal', 'desc')->get();
        $jadwalsPaginate = Jadwal::orderBy('tanggal', 'desc')->orderBy('waktu', 'desc')
            ->paginate(9); 
            
        // Cari jadwal terdekat
        $closestJadwal = Jadwal::where('tanggal', '>=', $today)
            ->orderBy('tanggal', 'asc')->orderBy('waktu','asc')
            ->first();

        // Transformasi data setelah paginasi
        $jadwalsPaginate->getCollection()->transform(function ($jadwal) use ($closestJadwal) {
            return (object) [
                'id' => $jadwal->id,
                'nama_kegiatan' => $jadwal->nama_kegiatan,
                'tanggal' => date('d M Y', strtotime($jadwal->tanggal)),
                'waktu' => $jadwal->waktu,
                'isClosest' => $closestJadwal && $jadwal->id === $closestJadwal->id, // True jika jadwal ini adalah yang terdekat
            ];
        });

        return view('orang_tua/before_login/jadwal', compact('jadwals', 'jadwalsPaginate'));
    }

    public function filter(Request $request)
    {
        $year = $request->input('year');
        $today = now()->toDateString(); 
        // Cari jadwal terdekat
        $closestJadwal = Jadwal::where('tanggal', '>=', $today)
            ->orderBy('tanggal', 'asc')->orderBy('waktu','asc')
            ->first();

        if ($year) {
            // Filter berdasarkan tahun
            $jadwals = Jadwal::whereYear('tanggal', $year)->orderBy('tanggal', 'desc')->orderBy('waktu', 'desc')->get();
        } else {
            // Semua jadwal
            $jadwals = Jadwal::orderBy('tanggal', 'desc')->get();
        }

        // Format data untuk response AJAX
        $jadwals = $jadwals->map(function ($jadwal) use ($closestJadwal) {
            return [
                'id' => $jadwal->id,
                'nama_kegiatan' => $jadwal->nama_kegiatan,
                'tanggal' => date('d M Y', strtotime($jadwal->tanggal)),
                'waktu' => date('H:i', strtotime($jadwal->waktu)) . ' - Selesai',
                'isClosest' => $closestJadwal && $jadwal->id === $closestJadwal->id, // True jika jadwal ini adalah yang terdekat
            ];
        });
        return response()->json($jadwals);
    }
}
