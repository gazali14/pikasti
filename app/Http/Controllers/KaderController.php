<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bayi;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Models\KehadiranKader;
use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;

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
        $selectedKader = Auth::guard('kader')->user();
        
        // Ambil semua bayi atau hasil pencarian berdasarkan nama
        $bayis = Bayi::query();

        if ($request->has('search') && $request->search != '') {
            $bayis->where('nama', 'LIKE', '%' . $request->search . '%');
        }

        $bayis = $bayis->get();

        // Ambil semua jadwal kegiatan dari tabel Jadwal, urutkan berdasarkan tanggal terdekat dengan hari ini
        $jadwal = Jadwal::orderBy('tanggal', 'asc')->paginate(12);

        // Format tanggal jadwal agar hanya menampilkan tanggal (tanpa waktu)
        $jadwal->each(function ($item) {
            $item->tanggal = Carbon::parse($item->tanggal)->format('Y-m-d');
        });

        // Kirim data ke view
        return view('kader.presensi_bayi', compact('jadwal', 'selectedKader'));
    }

    public function cekPresensi(Request $request, $id_kegiatan)
    {
        $selectedKader = Auth::guard('kader')->user();
        $jadwal = Jadwal::findOrFail($id_kegiatan);
        $bayis = Bayi::query();

        if ($request->has('search') && $request->search != '') {
            $bayis->where('nama', 'LIKE', '%' . $request->search . '%');
        }

        $bayis = $bayis->get();
        $kehadiran = Kehadiran::where('id_kegiatan', $id_kegiatan)->pluck('kehadiran', 'nik');
        $message = $bayis->isEmpty() && $request->has('search')
            ? "Nama '" . $request->search . "' tidak ditemukan."
            : null;

        // Kirimkan data ke view
        return view('kader.cek_presensi', compact('bayis', 'jadwal', 'kehadiran', 'message', 'selectedKader'));
    }
    
    public function savePresensi(Request $request)
    {
        // Ambil ID kegiatan dari request
        $id_kegiatan = $request->input('id_kegiatan');

        // Ambil tanggal kegiatan dari tabel Jadwal
        $jadwal = Jadwal::findOrFail($id_kegiatan);
        $tanggal_kegiatan = Carbon::parse($jadwal->tanggal)->format('Y-m-d');
        $kehadiran = $request->input('kehadiran', []);

        foreach ($kehadiran as $nik => $value) {
            // Cari data bayi berdasarkan NIK
            $bayi = Bayi::where('nik', $nik)->first();

            if ($bayi) {
                // Update atau buat data kehadiran
                Kehadiran::updateOrCreate(
                    [
                        'nik' => $nik,
                        'tanggal' => $tanggal_kegiatan,
                        'id_kegiatan' => $id_kegiatan,
                    ],
                    [
                        'nama_bayi' => $bayi->nama,
                        'jenis_kelamin' => $bayi->jenis_kelamin,
                        'kehadiran' => $value,
                        'waktu' => now()->toTimeString(),
                    ]
                );
            }
        }
        return redirect()->back()->with('success', 'Data presensi berhasil disimpan.');
    }

    public function searchKegiatan(Request $request)
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
        return view('kader.presensi_bayi', compact('jadwals'));
    }


}