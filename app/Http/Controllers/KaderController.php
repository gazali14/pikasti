<?php

namespace App\Http\Controllers;

use App\Models\Bayi;
use App\Models\Jadwal; // Import model Jadwal
use Illuminate\Http\Request;
use App\Models\Kehadiran;
use App\Models\KehadiranKader;
use Carbon\Carbon;

// Set locale ke Indonesia
Carbon::setLocale('id');

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

        // Ambil semua jadwal kegiatan dari tabel Jadwal, urutkan berdasarkan tanggal terdekat dengan hari ini
        $jadwal = Jadwal::orderBy('tanggal', 'asc')->paginate(12); // Urutkan berdasarkan tanggal dari yang terdekat

        // Format tanggal jadwal agar hanya menampilkan tanggal (tanpa waktu)
        $jadwal->each(function ($item) {
            $item->tanggal = Carbon::parse($item->tanggal)->format('Y-m-d');
        });

        // Kirim data ke view
        return view('kader.presensi_bayi', compact('jadwal'));
    }

    // /**
    //  * Handle search functionality for bayi by name.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\View\View
    //  */
    // public function search(Request $request)
    // {
    //     // Ambil data bayi berdasarkan pencarian nama
    //     $bayis = Bayi::query();

    //     if ($request->has('search') && $request->search != '') {
    //         $bayis->where('nama', 'LIKE', '%' . $request->search . '%');
    //     }

    //     // Ambil kehadiran bayi berdasarkan pencarian dan ID kegiatan terbaru
    //     $bayis = $bayis->get();

    //     // Ambil ID kegiatan terakhirz
    //     $jadwal = Jadwal::latest('tanggal')->first();

    //     // Ambil kehadiran berdasarkan ID kegiatan
    //     $kehadiran = Kehadiran::where('id_kegiatan', $jadwal->id)
    //                         ->pluck('kehadiran', 'nik');

    //     // Jika hasil pencarian kosong, kirim pesan ke view
    //     $message = $bayis->isEmpty() ? "Nama '" . $request->search . "' tidak ditemukan" : null;

    //     // Return the view with search results
    //     return view('kader.cek_presensi', compact('bayis', 'jadwal', 'kehadiran', 'message'));
    // }


    public function cekPresensi(Request $request, $id_kegiatan)
    {
        // Cari jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id_kegiatan);

        // Ambil data bayi (dengan atau tanpa pencarian)
        $bayis = Bayi::query();

        if ($request->has('search') && $request->search != '') {
            $bayis->where('nama', 'LIKE', '%' . $request->search . '%');
        }

        $bayis = $bayis->get();

        // Ambil kehadiran berdasarkan ID kegiatan
        $kehadiran = Kehadiran::where('id_kegiatan', $id_kegiatan)->pluck('kehadiran', 'nik');

        // Tambahkan pesan jika pencarian kosong
        $message = $bayis->isEmpty() && $request->has('search')
            ? "Nama '" . $request->search . "' tidak ditemukan."
            : null;

        // Kirimkan data ke view
        return view('kader.cek_presensi', compact('bayis', 'jadwal', 'kehadiran', 'message'));
    }

    // public function countKaderByMonth(Request $request)
    // {
    //     $year = $request->input('year') ?? date('Y'); // Default ke tahun sekarang jika tidak diberikan

    //     // Validasi input tahun
    //     $request->validate([
    //         'year' => 'nullable|integer|min:1900|max:' . date('Y'),
    //     ]);

    //     // Mengambil jumlah kader per bulan
    //     $kaderPerMonth = KehadiranKader::selectRaw('strftime("%m", created_at) as month, COUNT(*) as count')
    //         ->whereRaw('strftime("%Y", created_at) = ?', [$year])
    //         ->where('kehadiran', 1)
    //         ->groupByRaw('strftime("%m", created_at)')
    //         ->pluck('count', 'month');

    //     // Konversi hasil menjadi array dengan nama bulan
    //     $result = [];
    //     for ($month = 1; $month <= 12; $month++) {
    //         $monthKey = str_pad($month, 2, '0', STR_PAD_LEFT); // Format bulan menjadi "01", "02", ...
    //         $result[Carbon::create()->month($month)->translatedFormat('F')] = $kaderPerMonth[$monthKey] ?? 0;
    //     }

    //     return response()->json([
    //         'year' => $year,
    //         'data' => $result,
    //     ]);
    // }


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
            // Cari data bayi berdasarkan NIK
            $bayi = Bayi::where('nik', $nik)->first();

            if ($bayi) {
                // Update atau buat data kehadiran
                Kehadiran::updateOrCreate(
                    [
                        'nik' => $nik,
                        'tanggal' => $tanggal_kegiatan, // Tanggal kegiatan dari Jadwal
                        'id_kegiatan' => $id_kegiatan, // ID kegiatan
                    ],
                    [
                        'nama_bayi' => $bayi->nama,
                        'jenis_kelamin' => $bayi->jenis_kelamin,
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