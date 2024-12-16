<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kader;
use App\Models\KehadiranKader;
use App\Models\PresensiKader;
use Illuminate\Http\Request;
use Laravel\Pail\ValueObjects\Origin\Console;
use Laravel\Prompts\Output\ConsoleOutput;

class AdminPresensi extends Controller
{
    public function savePresensi(Request $request)
    {
        $validated = $request->validate([
            'presensi' => 'required|array',
            'presensi.*.nik' => 'required|string',
            'presensi.*.nama_kader' => 'required|string',
            'presensi.*.kehadiran' => 'required|boolean',
            'presensi.*.jenis_kelamin' => 'required|string',
            'presensi.*.tanggal' => 'required|date',
            'presensi.*.waktu' => 'required|string',
            'presensi.*.id_kegiatan' => 'required|integer', // Pastikan ID kegiatan valid
        ]);

        // Simpan data presensi
        foreach ($validated['presensi'] as $data) {
            PresensiKader::create([
                'nik' => $data['nik'],
                'nama_kader' => $data['nama_kader'],
                'kehadiran' => $data['kehadiran'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'tanggal' => $data['tanggal'],
                'waktu' => $data['waktu'],
                'id_kegiatan' => $data['id_kegiatan'],
            ]);
        }

        return response()->json([
            'message' => 'Presensi berhasil disimpan!',
        ]);
    }


    public function presensiBayi()
    {
        // Ambil data jadwal dari database
        $jadwal = Jadwal::all(); // Sesuaikan query jika perlu (contoh: filter tanggal mendatang)

        // Kembalikan ke view presensi_bayi dengan data jadwal
        return view('admin.presensi_kader', compact('jadwal'));
    }

    public function cekPresensiBayi($id)
    {
        $kegiatan = Jadwal::find($id);
        $kaders = Kader::all();
        
        if (!$kegiatan) {
            return redirect()->back()->with('error', 'Kegiatan tidak ditemukan.');
        }
        return view('admin.cek_presensi_kader', compact('kegiatan', 'kaders'));
    }
    //buat controller pake looping save presensi fungsi save presensi
}
