<?php

namespace App\Http\Controllers;

use App\Models\Bayi;
use App\Models\Jadwal; // Import model Jadwal
use Illuminate\Http\Request;

class KaderController extends Controller
{
    /**
     * Menampilkan halaman cek presensi dengan daftar bayi dan jadwal kegiatan.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Ambil semua bayi atau hasil pencarian berdasarkan nama
        $bayis = Bayi::query();

        if ($request->has('search') && $request->search != '') {
            $bayis->where('nama', 'LIKE', '%' . $request->search . '%');
        }

        $bayis = $bayis->get();

        // Ambil semua jadwal kegiatan dari tabel Jadwal
        $jadwal = Jadwal::all(); // Ambil semua data jadwal
        return view('kader.presensi_bayi', compact('jadwal'));
    }

    /**
     * Handle search functionality for bayi by name.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        // Perform the search based on the input
        $bayis = Bayi::where('nama', 'LIKE', '%' . $request->search . '%')->get();

        $jadwal = Jadwal::latest('tanggal')->first();

        // Return the view with search results
        return view('kader.cek_presensi', compact('bayis', 'jadwal'));
    }

    public function cekPresensi($id_kegiatan)
    {
        // Cari jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id_kegiatan);

    
        $bayis = Bayi::all(); 

        // Tampilkan view dengan data bayi dan jadwal
        return view('kader.cek_presensi', compact('bayis', 'jadwal'));
    }

}
