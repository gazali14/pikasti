<?php

namespace App\Http\Controllers;

use App\Models\KMS;
use App\Models\Bayi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


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
        $kmsData = KMS::where('nik_bayi', $nik)->get(); // Data KMS berdasarkan NIK bayi
        $selectedBayiNik = $nik; // NIK bayi yang dipilih

        return view('kader.kms', compact('bayiList', 'kmsData', 'selectedBayiNik'));
    }


    // Menyimpan data KMS baru
    public function store(Request $request)
    {

        $validated = $request->validate([
            'nik_bayi' => 'required|exists:bayis,nik',
            'tanggal' => 'required|date',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'kategori' => 'required|string',
        ]);

        // Simpan ke database
        KMS::create($validated);

        return redirect()->back()->with('success', 'Data KMS berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'kategori' => 'required|string',
        ]);

        $kms = KMS::findOrFail($id);
        $kms->update($validated);

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
