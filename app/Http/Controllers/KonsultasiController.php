<?php

namespace App\Http\Controllers;

use Carbon\Carbon; 
use App\Models\Bayi;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
    public function index()
    {
        if (Auth::guard('kader')->user()->is_admin) {
            return redirect()->route('orang_tua.before_login.login')->withErrors(['error' => 'Admin tidak dapat mengakses halaman kader.']);
        }

        try {
            $selectedKader = Auth::guard('kader')->user();
            $bayiList = Bayi::all();
            $konsultasiData = collect([]);
            $konsultasiDataPaginate = collect([]);
            $selectedBayiNik = null;

            return view('kader.konsultasi', compact('bayiList', 'konsultasiData', 'konsultasiDataPaginate', 'selectedBayiNik', 'selectedKader'));
        } catch (\Exception $e) {
            Log::error('Kesalahan saat memuat halaman Konsultasi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat halaman: ' . $e->getMessage());
        }
    }

    // Menampilkan data konsultasi berdasarkan NIK bayi
    public function show($nik)
    {
        try {
            $selectedKader = Auth::guard('kader')->user();
            $bayiList = Bayi::all(); // Daftar semua bayi untuk dropdown
            $selectedBayi = Bayi::where('nik', $nik)->first();

            // Jika bayi tidak ditemukan
            if (!$selectedBayi) {
                return redirect()->route('konsultasi.index')->with('error', 'Bayi tidak ditemukan.');
            }

            // Paginator untuk pagination
            $paginator = Konsultasi::where('nik_bayi', $nik)
                ->orderBy('tanggal', 'desc')
                ->paginate(10);

            // Koleksi untuk manipulasi data
            $konsultasiData = $paginator->getCollection()->map(function ($item) use ($selectedBayi) {
                $tanggalLahir = Carbon::parse($selectedBayi->tanggal_lahir);
                $tanggalKonsultasi = Carbon::parse($item->tanggal);
                $item->umur_bulan = $tanggalLahir->diffInMonths($tanggalKonsultasi);
                return $item;
            });

            // Masukkan koleksi kembali ke paginator
            $paginator->setCollection($konsultasiData);

            $selectedBayiNik = $nik;

            return view('kader.konsultasi', [
                'bayiList' => $bayiList,
                'konsultasiData' => $konsultasiData,
                'konsultasiDataPaginate' => $paginator,
                'selectedBayi' => $selectedBayi,
                'selectedBayiNik' => $selectedBayiNik,
                'selectedKader' => $selectedKader,
            ]);
        } catch (\Exception $e) {
            Log::error('Kesalahan saat memuat data Konsultasi: ' . $e->getMessage());
            return redirect()->route('konsultasi.index')->with('error', 'Terjadi kesalahan saat memuat data Konsultasi: ' . $e->getMessage());
        }
    }


    public function store(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'nik_bayi' => 'required|exists:bayis,nik',
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
        } catch (\Exception $e) {
            Log::error('Kesalahan saat menambahkan data Konsultasi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data Konsultasi: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'tanggal' => 'required|date',
                'konsultasi' => 'required|string',
            ]);

            $konsultasi = Konsultasi::findOrFail($id);

            // Update data Konsultasi dengan kategori baru
            $konsultasi->update([
                'tanggal' => $request->tanggal,
                'konsultasi' => $request->konsultasi,
            ]);

            return redirect()->back()->with('success', 'Data Konsultasi berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Kesalahan saat memperbarui data Konsultasi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data Konsultasi: ' . $e->getMessage());
        }
    }

    // Menghapus data Konsultasi
    public function destroy($id)
    {
        try {  
        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->delete();

        return redirect()->back()->with('success', 'Data Konsultasi berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Kesalahan saat menghapus data Konsultasi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data Vitmain: ' . $e->getMessage());
        }
    }
}
