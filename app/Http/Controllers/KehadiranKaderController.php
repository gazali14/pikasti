<?php

namespace App\Http\Controllers;

use App\Models\Jadwal; // Import model Jadwal
use Illuminate\Http\Request;
use App\Models\KehadiranKader;
use App\Models\Kader;
use Carbon\Carbon;

// Set locale ke Indonesia
Carbon::setLocale('id');

class KehadiranKaderController extends Controller
{
    /**
     * Menampilkan halaman cek presensi kader dengan daftar bayi dan jadwal kegiatan.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Ambil semua bayi atau hasil pencarian berdasarkan nama
        $kaders = Kader::query();

        if ($request->has('search') && $request->search != '') {
            $kaders->where('nama', 'LIKE', '%' . $request->search . '%');
        }

        $kaders = $kaders->get();

        // Ambil semua jadwal kegiatan dari tabel Jadwal, urutkan berdasarkan tanggal terdekat dengan hari ini
        $jadwal = Jadwal::orderBy('tanggal', 'asc')->get(); // Urutkan berdasarkan tanggal dari yang terdekat
        $jadwal->each(function ($item) {
            $item->tanggal = Carbon::parse($item->tanggal)->format('Y-m-d');
        });

        return view('admin.presensi_kader', compact('jadwal'));
    }


    public function cekPresensiKader(Request $request, $id_kegiatan)
    {
        // Cari jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id_kegiatan);

        // Ambil data kader (dengan atau tanpa pencarian)
        $kaders = Kader::query();

        if ($request->has('search') && $request->search != '') {
            $kaders->where('nama', 'LIKE', '%' . $request->search . '%');
        }

        $kaders = $kaders->get();

        // Ambil kehadiran berdasarkan ID kegiatan
        $kehadiran = KehadiranKader::where('id_kegiatan', $id_kegiatan)->pluck('kehadiran', 'nik');

        // Tambahkan pesan jika pencarian kosong
        $message = $kaders->isEmpty() && $request->has('search')
            ? "Nama '" . $request->search . "' tidak ditemukan."
            : null;

        // Kirimkan data ke view
        return view('admin.cek_presensi_kader', compact('kaders', 'jadwal', 'kehadiran', 'message'));
    }

    // /**
    //      * Handle search functionality for bayi by name.
    //      *
    //      * @param  \Illuminate\Http\Request  $request
    //      * @return \Illuminate\View\View
    //      */
    // public function search(Request $request)
    // {
    //     // Ambil data bayi berdasarkan pencarian nama
    //         $kaders = Kader::query();

    //         if ($request->has('search') && $request->search != '') {
    //             $kaders->where('nama', 'LIKE', '%' . $request->search . '%');
    //         }

    //         // Ambil kehadiran bayi berdasarkan pencarian dan ID kegiatan terbaru
    //         $kaders = $kaders->get();

    //         // Ambil ID kegiatan terakhirz
    //         $jadwal = Jadwal::latest('tanggal')->first();

    //         // Ambil kehadiran berdasarkan ID kegiatan
    //         $kehadiran = KehadiranKader::where('id_kegiatan', $jadwal->id)
    //                             ->pluck('kehadiran', 'nik');

    //         // Jika hasil pencarian kosong, kirim pesan ke view
    //         $message = $kaders->isEmpty() ? "Nama '" . $request->search . "' tidak ditemukan" : null;

    //         // Return the view with search results
    //         return view('admin.cek_presensi_kader', compact('kaders', 'jadwal', 'kehadiran', 'message'));
    //     }


    public function savePresensi(Request $request)
    {
        // Ambil ID kegiatan dari request
        $id_kegiatan = $request->input('id_kegiatan');

        // Ambil tanggal kegiatan dari tabel Jadwal
        $jadwal = Jadwal::findOrFail($id_kegiatan);
        $tanggal_kegiatan = $jadwal->tanggal;

        // Ambil data kehadiran dari form
        $kehadiran = $request->input('kehadiran', []);

        foreach ($kehadiran as $nik => $value) {
            // Cari data kader berdasarkan NIK
            $kader = Kader::where('nik', $nik)->first();

            if ($kader) {
                // Update atau buat data kehadiran
                KehadiranKader::updateOrCreate(
                    [
                        'nik' => $nik,
                        'tanggal' => $tanggal_kegiatan, // Tanggal kegiatan dari Jadwal
                        'id_kegiatan' => $id_kegiatan, // ID kegiatan
                    ],
                    [
                        'nama_kader' => $kader->nama,
                        'kehadiran' => $value, // 1 jika hadir
                        'waktu' => now()->toTimeString(),
                    ]
                );
            }
        }

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Data presensi berhasil disimpan.');
    }


}