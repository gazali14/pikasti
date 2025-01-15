<?php

namespace App\Http\Controllers;

use App\Models\PMT;
use Carbon\Carbon; 
use App\Models\Bayi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PMTController extends Controller
{
    // Menampilkan halaman utama
    public function index()
    {
        $selectedKader = Auth::guard('kader')->user();
        $bayiList = Bayi::all(); // Daftar semua bayi untuk dropdown
        $pmtData = []; // Data PMT kosong di awal
        $selectedBayiNik = null;

        return view('kader.pmt', compact('bayiList', 'pmtData', 'selectedBayiNik', 'selectedKader'));
    }

    // Menampilkan data PMT berdasarkan NIK bayi
    public function show($nik)
    {
        $selectedKader = Auth::guard('kader')->user();
        $bayiList = Bayi::all(); // Daftar semua bayi untuk dropdown
        $selectedBayi = Bayi::where('nik', $nik)->first(); // Data bayi yang dipilih

        // Jika bayi tidak ditemukan, alihkan kembali
        if (!$selectedBayi) {
            return redirect()->route('pmt.index')->with('error', 'Bayi tidak ditemukan.');
        }

        $pmtData = PMT::where('nik_bayi', $nik)
            ->orderBy('tanggal', 'asc')
            ->get()
            ->map(function ($item) use ($selectedBayi) {
                $tanggalLahir = \Carbon\Carbon::parse($selectedBayi->tanggal_lahir);
                $tanggalPmt = \Carbon\Carbon::parse($item->tanggal);
                $item->umur_bulan = $tanggalLahir->diffInMonths($tanggalPmt); // Hitung usia bulan
                return $item;
            });


        $selectedBayiNik = $nik;
        return view('kader.pmt', compact('bayiList', 'pmtData','selectedBayi', 'selectedBayiNik', 'selectedKader'));
    }
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nik_bayi' => 'required|exists:bayis,nik',
            'tanggal' => 'required|date',
            'pmt' => 'required|string',
        ]);

        $bayi = Bayi::where('nik', $request->nik_bayi)->first();
        PMT::create([
            'nik_bayi' => $request->nik_bayi,
            'tanggal' => $request->tanggal,
            'pmt' => $request->pmt,
        ]);

        return redirect()->back()->with('success', 'Data PMT berhasil ditambahkan!');
    }
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'pmt' => 'required|string',
        ]);

        $pmt = PMT::findOrFail($id);
        $pmt->update([
            'tanggal' => $request->tanggal,
            'pmt' => $request->pmt,
        ]);
        return redirect()->back()->with('success', 'Data PMT berhasil diperbarui!');
    }

    // Menghapus data PMT
    public function destroy($id)
    {
        $pmt = PMT::findOrFail($id);
        $pmt->delete();
        return redirect()->back()->with('success', 'Data PMT berhasil dihapus!');
    }
}
