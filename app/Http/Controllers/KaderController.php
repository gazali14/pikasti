<?php

namespace App\Http\Controllers;

use App\Models\Bayi;
use App\Models\Jadwal; // Import model Jadwal
use Illuminate\Http\Request;
use App\Models\Kader;
use Carbon\Carbon;

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

    /**
     * Menghitung jumlah kader per bulan di tahun tertentu.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function countKaderByMonth(Request $request)
    {
        $year = $request->input('year') ?? date('Y'); // Default ke tahun sekarang jika tidak diberikan

        // Validasi input tahun
        $request->validate([
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
        ]);

        // Mengambil jumlah kader per bulan
        $kaderPerMonth = Kader::selectRaw('strftime("%m", created_at) as month, COUNT(*) as count')
            ->whereRaw('strftime("%Y", created_at) = ?', [$year])
            ->groupByRaw('strftime("%m", created_at)')
            ->pluck('count', 'month');

        // Konversi hasil menjadi array dengan nama bulan
        $result = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthKey = str_pad($month, 2, '0', STR_PAD_LEFT); // Format bulan menjadi "01", "02", ...
            $result[Carbon::create()->month($month)->translatedFormat('F')] = $kaderPerMonth[$monthKey] ?? 0;
        }

        return response()->json([
            'year' => $year,
            'data' => $result,
        ]);
    }
}
