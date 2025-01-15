<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kader;
use Illuminate\Http\Request;
use App\Models\KehadiranKader;
use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;

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
        $selectedKader = Auth::guard('kader')->user();
        // Ambil semua kader atau hasil pencarian berdasarkan nama
        $kaders = Kader::query();

        if ($request->has('search') && $request->search != '') {
            $kaders->where('nama', 'LIKE', '%' . $request->search . '%');
        }

        $kaders = $kaders->get();

        // Ambil semua jadwal kegiatan dari tabel Jadwal, urutkan berdasarkan tanggal terdekat dengan hari ini
        $jadwal = Jadwal::orderBy('tanggal', 'asc')->paginate(12);;
        $jadwal->each(function ($item) {
            $item->tanggal = Carbon::parse($item->tanggal)->format('Y-m-d');
        });

        return view('admin.presensi_kader', compact('jadwal', 'selectedKader'));
    }


    public function cekPresensiKader(Request $request, $id_kegiatan)
    {
        $selectedKader = Auth::guard('kader')->user();
        $jadwal = Jadwal::findOrFail($id_kegiatan);
        $kaders = Kader::query();

        if ($request->has('search') && $request->search != '') {
            $kaders->where('nama', 'LIKE', '%' . $request->search . '%');
        }

        $kaders = $kaders->get();
        $kehadiran = KehadiranKader::where('id_kegiatan', $id_kegiatan)->pluck('kehadiran', 'nik');
        $message = $kaders->isEmpty() && $request->has('search')
            ? "Nama '" . $request->search . "' tidak ditemukan."
            : null;
        return view('admin.cek_presensi_kader', compact('kaders', 'jadwal', 'kehadiran', 'message', 'selectedKader'));
    }

    public function savePresensi(Request $request)
    {
        $id_kegiatan = $request->input('id_kegiatan');
        $jadwal = Jadwal::findOrFail($id_kegiatan);
        $tanggal_kegiatan = $jadwal->tanggal;
        $kehadiran = $request->input('kehadiran', []);

        foreach ($kehadiran as $nik => $value) {
            // Cari data kader berdasarkan NIK
            $kader = Kader::where('nik', $nik)->first();

            if ($kader) {
                // Update atau buat data kehadiran
                KehadiranKader::updateOrCreate(
                    [
                        'nik' => $nik,
                        'tanggal' => $tanggal_kegiatan,
                        'id_kegiatan' => $id_kegiatan, 
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

    public function countKaderByMonth(Request $request)
    {
        $year = $request->input('year') ?? date('Y');

        // Validasi input tahun
        $request->validate([
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
        ]);

        // Mengambil jumlah kader per bulan
        $kaderPerMonth = KehadiranKader::selectRaw('strftime("%m", tanggal) as month, COUNT(*) as count') //data jumlah kehadiran diambil dari cretated_at
            ->whereRaw('strftime("%Y", tanggal) = ?', [$year])
            ->where('kehadiran', 1)
            ->groupByRaw('strftime("%m", tanggal)')
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

    public function searchKegiatanKader(Request $request)
    {
        $search = $request->input('search');
        // Query jadwal berdasarkan pencarian
        $jadwals = Jadwal::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nama_kegiatan', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('tanggal', 'asc')
            ->get();
    
        // Jika permintaan adalah AJAX, kembalikan data sebagai JSON
        if ($request->ajax()) {
            return response()->json(['jadwals' => $jadwals]);
        }
        // Render view untuk permintaan biasa
        return view('admin.presensi_kader', compact('jadwals'));
    }
}