<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bayi;
use App\Models\Vitamin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class VitaminController extends Controller
{
    public function index()
    {
        if (Auth::guard('kader')->user()->is_admin) {
            return redirect()->route('orang_tua.before_login.login')->withErrors(['error' => 'Admin tidak dapat mengakses halaman kader.']);
        }

        try {
            $selectedKader = Auth::guard('kader')->user();
            $bayiList = Bayi::all();
            $vitaminData = collect([]);
            $vitaminDataPaginate = collect([]);
            $selectedBayiNik = null;

            return view('kader.vitamin', compact('bayiList', 'vitaminData', 'vitaminDataPaginate', 'selectedBayiNik', 'selectedKader'));
        } catch (\Exception $e) {
            Log::error('Kesalahan saat memuat halaman Vitamin: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat halaman: ' . $e->getMessage());
        }
    }

    // Menampilkan data vitamin berdasarkan NIK bayi
    public function show($nik)
    {
        try {
            $selectedKader = Auth::guard('kader')->user();
            $bayiList = Bayi::all(); // Daftar semua bayi untuk dropdown
            $selectedBayi = Bayi::where('nik', $nik)->first();

            // Jika bayi tidak ditemukan
            if (!$selectedBayi) {
                return redirect()->route('vitamin.index')->with('error', 'Bayi tidak ditemukan.');
            }

            // Paginator untuk pagination
            $paginator = Vitamin::where('nik_bayi', $nik)
                ->orderBy('tanggal', 'desc')
                ->paginate(10);

            // Koleksi untuk manipulasi data
            $vitaminData = $paginator->getCollection()->map(function ($item) use ($selectedBayi) {
                $tanggalLahir = Carbon::parse($selectedBayi->tanggal_lahir);
                $tanggalVitamin = Carbon::parse($item->tanggal);
                $item->umur_bulan = $tanggalLahir->diffInMonths($tanggalVitamin);
                return $item;
            });

            // Masukkan koleksi kembali ke paginator
            $paginator->setCollection($vitaminData);

            $selectedBayiNik = $nik;

            return view('kader.vitamin', [
                'bayiList' => $bayiList,
                'vitaminData' => $vitaminData,
                'vitaminDataPaginate' => $paginator,
                'selectedBayi' => $selectedBayi,
                'selectedBayiNik' => $selectedBayiNik,
                'selectedKader' => $selectedKader,
            ]);
        } catch (\Exception $e) {
            Log::error('Kesalahan saat memuat data Vitamin: ' . $e->getMessage());
            return redirect()->route('vitamin.index')->with('error', 'Terjadi kesalahan saat memuat data Vitamin: ' . $e->getMessage());
        }
    }


    public function store(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'nik_bayi' => 'required|exists:bayis,nik',
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
        } catch (\Exception $e) {
            Log::error('Kesalahan saat menambahkan data Vitamin: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data Vitamin: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
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
        } catch (\Exception $e) {
            Log::error('Kesalahan saat memperbarui data Vitamin: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data Vitamin: ' . $e->getMessage());
        }
    }

    // Menghapus data Vitamin
    public function destroy($id)
    {
        try {  
        $vitamin = Vitamin::findOrFail($id);
        $vitamin->delete();

        return redirect()->back()->with('success', 'Data Vitamin berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Kesalahan saat menghapus data Vitamin: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data Vitmain: ' . $e->getMessage());
        }
    }
}
