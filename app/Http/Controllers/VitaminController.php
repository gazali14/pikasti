<?php

namespace App\Http\Controllers;

use App\Models\Vitamin;
use App\Models\Bayi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon; 

class VitaminController extends Controller
{
    // Menampilkan halaman utama
    public function index()
    {
        $bayiList = Bayi::all(); // Daftar semua bayi untuk dropdown
        $vitaminData = []; // Data vitamin kosong di awal
        $selectedBayiNik = null;

        return view('kader.vitamin', compact('bayiList', 'vitaminData', 'selectedBayiNik'));
    }

    // Menampilkan data vitamin berdasarkan NIK bayi
    public function show($nik)
    {
        $bayiList = Bayi::all(); // Daftar semua bayi untuk dropdown
        $selectedBayi = Bayi::where('nik', $nik)->first(); // Data bayi yang dipilih

        // Jika bayi tidak ditemukan, alihkan kembali
        if (!$selectedBayi) {
            return redirect()->route('vitamin.index')->with('error', 'Bayi tidak ditemukan.');
        }

        $vitaminData = Vitamin::where('nik_bayi', $nik)
            ->orderBy('tanggal', 'asc')
            ->get()
            ->map(function ($item) use ($selectedBayi) {
                $tanggalLahir = \Carbon\Carbon::parse($selectedBayi->tanggal_lahir);
                $tanggalVitamin = \Carbon\Carbon::parse($item->tanggal);
                $item->umur_bulan = $tanggalLahir->diffInMonths($tanggalVitamin); // Hitung usia bulan
                return $item;
            });


        $selectedBayiNik = $nik;
        return view('kader.vitamin', compact('bayiList', 'vitaminData','selectedBayi', 'selectedBayiNik'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nik_bayi' => 'required|exists:bayis,nik', // Pastikan bayi ada di database
            'tanggal' => 'required|date',
            'vitamin' => 'required|string',
        ]);

        $bayi = Bayi::where('nik', $request->nik_bayi)->first();
        Vitamin::create([
            'nik_bayi' => $request->nik_bayi,
            'tanggal' => $request->tanggal,
            'vitamin' => $request->vitamin,
        ]);

        return redirect()->back()->with('success', 'Data Vitamin berhasil ditambahkan!');
    }
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'vitamin' => 'required|string',
        ]);

        $vitamin = Vitamin::findOrFail($id);

        // Update data Vitamin dengan kategori baru
        $vitamin->update([
            'tanggal' => $request->tanggal,
            'vitamin' => $request->vitamin,
        ]);

        return redirect()->back()->with('success', 'Data Vitamin berhasil diperbarui!');
    }

    // Menghapus data Vitamin
    public function destroy($id)
    {
        $vitamin = Vitamin::findOrFail($id);
        $vitamin->delete();

        return redirect()->back()->with('success', 'Data Vitamin berhasil dihapus!');
    }
}
