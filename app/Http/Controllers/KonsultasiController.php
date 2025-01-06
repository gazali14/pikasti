<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\Bayi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon; 

class KonsultasiController extends Controller
{
    // Menampilkan halaman utama
    public function index()
    {
        $bayiList = Bayi::all(); // Daftar semua bayi untuk dropdown
        $konsultasiData = []; // Data Konsultasi kosong di awal
        $selectedBayiNik = null;

        return view('kader.konsultasi', compact('bayiList', 'konsultasiData', 'selectedBayiNik'));
    }

    // Menampilkan data konsultasi berdasarkan NIK bayi
    public function show($nik)
    {
        $bayiList = Bayi::all(); // Daftar semua bayi untuk dropdown
        $selectedBayi = Bayi::where('nik', $nik)->first(); // Data bayi yang dipilih

        // Jika bayi tidak ditemukan, alihkan kembali
        if (!$selectedBayi) {
            return redirect()->route('konsultasi.index')->with('error', 'Bayi tidak ditemukan.');
        }

        $konsultasiData = Konsultasi::where('nik_bayi', $nik)
            ->orderBy('tanggal', 'asc')
            ->get()
            ->map(function ($item) use ($selectedBayi) {
                $tanggalLahir = \Carbon\Carbon::parse($selectedBayi->tanggal_lahir);
                $tanggalKonsultasi = \Carbon\Carbon::parse($item->tanggal);
                $item->umur_bulan = $tanggalLahir->diffInMonths($tanggalKonsultasi); // Hitung usia bulan
                return $item;
            });


        $selectedBayiNik = $nik;
        return view('kader.konsultasi', compact('bayiList', 'konsultasiData','selectedBayi', 'selectedBayiNik'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nik_bayi' => 'required|exists:bayis,nik', // Pastikan bayi ada di database
            'tanggal' => 'required|date',
            'konsultasi' => 'required|string',
        ]);

        $bayi = Bayi::where('nik', $request->nik_bayi)->first();
        Konsultasi::create([
            'nik_bayi' => $request->nik_bayi,
            'tanggal' => $request->tanggal,
            'konsultasi' => $request->konsultasi,
        ]);

        return redirect()->back()->with('success', 'Data Konsultasi berhasil ditambahkan!');
    }
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'konsultasi' => 'required|string',
        ]);

        $konsultasi = Konsultasi::findOrFail($id);

        // Update data konsultasi dengan kategori baru
        $konsultasi->update([
            'tanggal' => $request->tanggal,
            'konsultasi' => $request->konsultasi,
        ]);

        return redirect()->back()->with('success', 'Data Konsultasi berhasil diperbarui!');
    }

    // Menghapus data konsultasi
    public function destroy($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->delete();

        return redirect()->back()->with('success', 'Data Konsultasi berhasil dihapus!');
    }
}
