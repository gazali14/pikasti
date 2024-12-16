<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class AdminKelolaJadwalController extends Controller
{
    /**
     * Menampilkan halaman kelola jadwal.
     */
    public function index()
    {
        // Ambil semua data jadwal dari database
        $jadwals = Jadwal::all();
        return view('admin.kelola_jadwal', compact('jadwals'));
    }

    /**
     * Menyimpan jadwal baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'namaKegiatan' => 'required|string|max:255', // Pastikan nama field sesuai dengan form
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
        ]);
    
        // Map data validasi ke format yang cocok dengan kolom database
        $data = [
            'nama_kegiatan' => $validated['namaKegiatan'], // Sesuaikan dengan nama kolom di tabel
            'tanggal' => $validated['tanggal'],
            'waktu' => $validated['waktu'],
        ];

        // Simpan data ke tabel 'jadwals'
        Jadwal::create($data);

        // Redirect kembali ke halaman kelola jadwal dengan pesan sukses
        return redirect()->route('jadwal.indeks')->with('success', 'Jadwal berhasil ditambahkan!');
        // return;
    }

    
}