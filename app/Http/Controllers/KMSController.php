<?php

namespace App\Http\Controllers;

use App\Models\KMS;
use App\Models\Bayi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon; 

class KMSController extends Controller
{
    // Menampilkan halaman utama
    public function index()
    {
        $bayiList = Bayi::all(); // Daftar semua bayi untuk dropdown
        $kmsData = []; // Data KMS kosong di awal
        $selectedBayiNik = null;

        return view('kader.kms', compact('bayiList', 'kmsData', 'selectedBayiNik'));
    }

    // Menampilkan data KMS berdasarkan NIK bayi
    public function show($nik)
    {
        $bayiList = Bayi::all(); // Daftar semua bayi untuk dropdown
        $selectedBayi = Bayi::where('nik', $nik)->first(); // Data bayi yang dipilih

        // Jika bayi tidak ditemukan, alihkan kembali
        if (!$selectedBayi) {
            return redirect()->route('kms.index')->with('error', 'Bayi tidak ditemukan.');
        }

        $kmsData = KMS::where('nik_bayi', $nik)
            ->orderBy('tanggal', 'asc')
            ->get()
            ->map(function ($item) use ($selectedBayi) {
                $tanggalLahir = \Carbon\Carbon::parse($selectedBayi->tanggal_lahir);
                $tanggalKMS = \Carbon\Carbon::parse($item->tanggal);
                $item->umur_bulan = $tanggalLahir->diffInMonths($tanggalKMS); // Hitung usia bulan
                return $item;
            });


        $selectedBayiNik = $nik;
        return view('kader.kms', compact('bayiList', 'kmsData','selectedBayi', 'selectedBayiNik'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nik_bayi' => 'required|exists:bayis,nik', // Pastikan bayi ada di database
            'tanggal' => 'required|date',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'imunisasi' => 'required|string',
        ]);

        $bayi = Bayi::where('nik', $request->nik_bayi)->first();
        $previousKMS = KMS::where('nik_bayi', $request->nik_bayi)
            ->orderBy('tanggal', 'desc')
            ->first();
        if (!$previousKMS) {
            // Jika data bayi pertama kali dimasukkan, kategori B
            $kategori = 'B';
        } else {
            // Jika berat badan lebih rendah dari sebelumnya, kategori T (Turun)
            if ($request->berat_badan < $previousKMS->berat_badan) {
                $kategori = 'T (Turun)'; // Turun
            }
            // Jika berat badan lebih tinggi dari sebelumnya, kategori N (Naik)
            elseif ($request->berat_badan > $previousKMS->berat_badan) {
                $kategori = 'N'; // Naik
            }
            // Jika berat badan sama dengan sebelumnya, kategori T (Tetap)
            else {
                $kategori = 'T (Tetap)'; // Tetap
            }
        }

        KMS::create([
            'nik_bayi' => $request->nik_bayi,
            'tanggal' => $request->tanggal,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'imunisasi' => $request->imunisasi,
            'kategori' => $kategori,
        ]);

        return redirect()->back()->with('success', 'Data KMS berhasil ditambahkan!');
    }
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'imunisasi' => 'required|string',
        ]);

        $kms = KMS::findOrFail($id);

        // Ambil data sebelumnya (sebelum diupdate)
        $previousKMS = KMS::where('nik_bayi', $kms->nik_bayi)
            ->where('tanggal', '<', $request->tanggal)
            ->orderBy('tanggal', 'desc')
            ->first();

        if (!$previousKMS) {
            // Jika data bayi pertama kali dimasukkan, kategori B
            $kategori = 'B';
        } else {
            // Jika berat badan lebih rendah dari sebelumnya, kategori T (Turun)
            if ($request->berat_badan < $previousKMS->berat_badan) {
                $kategori = 'T (Turun)';
            }
            // Jika berat badan lebih tinggi dari sebelumnya, kategori N (Naik)
            elseif ($request->berat_badan > $previousKMS->berat_badan) {
                $kategori = 'N';
            }
            // Jika berat badan sama dengan sebelumnya, kategori T (Tetap)
            else {
                $kategori = 'T (Tetap)';
            }
        }

        // Update data KMS dengan kategori baru
        $kms->update([
            'tanggal' => $request->tanggal,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'imunisasi' => $request->imunisasi,
            'kategori' => $kategori,
        ]);

        return redirect()->back()->with('success', 'Data KMS berhasil diperbarui!');
    }

    // Menghapus data KMS
    public function destroy($id)
    {
        $kms = KMS::findOrFail($id);
        $kms->delete();

        return redirect()->back()->with('success', 'Data KMS berhasil dihapus!');
    }
}
