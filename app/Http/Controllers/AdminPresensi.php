<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\KehadiranKader;
use Illuminate\Http\Request;

class AdminPresensi extends Controller
{
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
            // Cari data  berdasarkan NIK
            $kader = KehadiranKader::where('nik', $nik)->first();

            if ($kader) {
                // Update atau buat data kehadiran
                KehadiranKader::updateOrCreate(
                    [
                        'nik' => $nik,
                        'tanggal' => $tanggal_kegiatan, // Tanggal kegiatan dari Jadwal
                        'id_kegiatan' => $id_kegiatan, // ID kegiatan
                    ],
                    [
                        'nama_bayi' => $kader->nama,
                        'jenis_kelamin' => $kader->jenis_kelamin,
                        'kehadiran' => $value, // 1 jika hadir
                        'waktu' => now()->toTimeString(),
                    ]
                );
            }
        }

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Data presensi berhasil disimpan.');
    }

    public function presensiBayi()
    {
        // Ambil data jadwal dari database
        $jadwal = Jadwal::all(); // Sesuaikan query jika perlu (contoh: filter tanggal mendatang)

        // Kembalikan ke view presensi_bayi dengan data jadwal
        return view('admin.presensi_kader', compact('jadwal'));
    }

}
