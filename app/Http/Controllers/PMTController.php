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
        if (Auth::guard('kader')->user()->is_admin) {
            return redirect()->route('orang_tua.before_login.login')->withErrors(['error' => 'Admin tidak dapat mengakses halaman kader.']);
        }
        try {
            $selectedKader = Auth::guard('kader')->user();
            $bayiList = Bayi::all();
            $pmtData = collect([]);
            $pmtDataPaginate = collect([]);
            $selectedBayiNik = null;

            return view('kader.pmt', compact('bayiList', 'pmtData', 'pmtDataPaginate', 'selectedBayiNik', 'selectedKader'));
        } catch (\Exception $e) {
            Log::error('Kesalahan saat memuat halaman PMT: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat halaman: ' . $e->getMessage());
        }
    }

    // Menampilkan data PMT berdasarkan NIK bayi
    public function show($nik)
    {
        try {
            $selectedKader = Auth::guard('kader')->user();
            $bayiList = Bayi::all(); // Daftar semua bayi untuk dropdown
            $selectedBayi = Bayi::where('nik', $nik)->first();

            // Jika bayi tidak ditemukan
            if (!$selectedBayi) {
                return redirect()->route('pmt.index')->with('error', 'Bayi tidak ditemukan.');
            }

            // Paginator untuk pagination
            $paginator = PMT::where('nik_bayi', $nik)
                ->orderBy('tanggal', 'desc')
                ->paginate(10);

            // Koleksi untuk manipulasi data
            $pmtData = $paginator->getCollection()->map(function ($item) use ($selectedBayi) {
                $tanggalLahir = Carbon::parse($selectedBayi->tanggal_lahir);
                $tanggalPMT = Carbon::parse($item->tanggal);
                $item->umur_bulan = $tanggalLahir->diffInMonths($tanggalPMT);
                return $item;
            });

            // Masukkan koleksi kembali ke paginator
            $paginator->setCollection($pmtData);

            $selectedBayiNik = $nik;

            return view('kader.pmt', [
                'bayiList' => $bayiList,
                'pmtData' => $pmtData,
                'pmtDataPaginate' => $paginator,
                'selectedBayi' => $selectedBayi,
                'selectedBayiNik' => $selectedBayiNik,
                'selectedKader' => $selectedKader,
            ]);
        } catch (\Exception $e) {
            Log::error('Kesalahan saat memuat data PMT: ' . $e->getMessage());
            return redirect()->route('pmt.index')->with('error', 'Terjadi kesalahan saat memuat data PMT: ' . $e->getMessage());
        }
    }
    public function store(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            Log::error('Kesalahan saat menambahkan data PMT: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data PMT: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'tanggal' => 'required|date',
                'pmt' => 'required|string',
            ]);

            $pmt = PMT::findOrFail($id);

            // Update data PMT dengan kategori baru
            $pmt->update([
                'tanggal' => $request->tanggal,
                'pmt' => $request->pmt,
            ]);

            return redirect()->back()->with('success', 'Data PMT berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Kesalahan saat memperbarui data PMT: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data PMT: ' . $e->getMessage());
        }
    }

    // Menghapus data PMT
    public function destroy($id)
    {
        try {  
            $pmt = PMT::findOrFail($id);
            $pmt->delete();
    
            return redirect()->back()->with('success', 'Data PMT berhasil dihapus!');
            } catch (\Exception $e) {
                Log::error('Kesalahan saat menghapus data PMT: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data Vitmain: ' . $e->getMessage());
            }
    }
}
