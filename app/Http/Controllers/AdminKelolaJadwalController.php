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
        $jadwals = Jadwal::paginate(10);
        return view('admin.kelola_jadwal', compact('jadwals'));
    }

    /**
     * Menyimpan jadwal baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
        ]);

        Jadwal::create($validated);
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function destroy(Jadwal $jadwal)
    {
        try {
            // Coba hapus data jadwal
            $jadwal->delete();

            return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Tangkap error jika ada foreign key constraint
            return redirect()->route('jadwal.index')
                ->with('error', 'Jadwal tidak bisa dihapus karena masih memiliki keterkaitan dengan data lain.');
        }
    }




    public function search(Request $request)
    {
        $searchQuery = $request->input('search');

        // Pencarian di database
        $jadwals = Jadwal::where('nama_kegiatan', 'like', "%$searchQuery%")
            ->orWhere('tanggal', 'like', "%$searchQuery%")
            ->orWhere('waktu', 'like', "%$searchQuery%")
            ->paginate(10);

        // Kembalikan hasil pencarian ke view
        return view('admin.kelola_jadwal', compact('jadwals'));
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
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
        ]);


        // Cari jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id);

        // Update data jadwal
        $jadwal->nama_kegiatan = $validated['nama_kegiatan'];
        $jadwal->tanggal = $validated['tanggal'];
        $jadwal->waktu = $validated['waktu'];


        // Simpan perubahan ke database
        $jadwal->save();

        // Redirect kembali ke halaman kelola jadwal dengan pesan sukses
        return redirect()->route('jadwal.indeks')->with('success', 'Jadwal berhasil diperbarui!');
    }
}
