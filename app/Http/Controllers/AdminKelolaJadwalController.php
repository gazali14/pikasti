<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kehadiran;
use App\Models\KehadiranKader;
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
    public function destroy($id)
    {
        // Cari jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id);

        // Hapus jadwal
        $jadwal->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('jadwal.indeks')->with('success', 'Jadwal berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search');

        // Pencarian di database
        $jadwals = Jadwal::where('nama_kegiatan', 'like', "%$searchQuery%")
            ->orWhere('tanggal', 'like', "%$searchQuery%")
            ->orWhere('waktu', 'like', "%$searchQuery%")
            ->get();

        // Kembalikan hasil pencarian ke view
        return view('jadwal.indeks', compact('jadwals'));
    }
    /**
     * Menampilkan form untuk mengedit jadwal.
     */
    public function edit($id)
    {
        // Cari jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id);

        // Tampilkan form edit dengan data jadwal
        return view('admin.edit_jadwal', compact('jadwal'));
    }

    /**
     * Mengupdate jadwal yang ada berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'namaKegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
        ]);

        // Cari jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id);

        // Update data jadwal
        $jadwal->nama_kegiatan = $validated['namaKegiatan'];
        $jadwal->tanggal = $validated['tanggal'];
        $jadwal->waktu = $validated['waktu'];

        // Simpan perubahan ke database
        $jadwal->save();

        // Redirect kembali ke halaman kelola jadwal dengan pesan sukses
        return redirect()->route('jadwal.indeks')->with('success', 'Jadwal berhasil diperbarui!');
    }


}
