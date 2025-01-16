<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\KMS;
use App\Models\Bayi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class KMSController extends Controller
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
            $kmsData = collect([]); 
            $kmsDataPaginate = collect([]);
            $selectedBayiNik = null;

            return view('kader.kms', compact('bayiList', 'kmsData', 'kmsDataPaginate', 'selectedBayiNik', 'selectedKader'));
        } catch (\Exception $e) {
            Log::error('Kesalahan saat memuat halaman KMS: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat halaman: ' . $e->getMessage());
        }
    }

    // Menampilkan data KMS berdasarkan NIK bayi
    public function show($nik)
    {
        try {
            $selectedKader = Auth::guard('kader')->user();
            $bayiList = Bayi::all(); // Daftar semua bayi untuk dropdown
            $selectedBayi = Bayi::where('nik', $nik)->first();
    
            // Jika bayi tidak ditemukan
            if (!$selectedBayi) {
                return redirect()->route('kms.index')->with('error', 'Bayi tidak ditemukan.');
            }
    
            // Paginator untuk pagination
            $paginator = KMS::where('nik_bayi', $nik)
                ->orderBy('tanggal', 'asc')
                ->paginate(10);
    
            // Koleksi untuk manipulasi data
            $kmsData = $paginator->getCollection()->map(function ($item) use ($selectedBayi) {
                $tanggalLahir = Carbon::parse($selectedBayi->tanggal_lahir);
                $tanggalKMS = Carbon::parse($item->tanggal);
                $item->umur_bulan = $tanggalLahir->diffInMonths($tanggalKMS);
                return $item;
            });
    
            // Masukkan koleksi kembali ke paginator
            $paginator->setCollection($kmsData);
    
            $selectedBayiNik = $nik;
    
            return view('kader.kms', [
                'bayiList' => $bayiList,
                'kmsData' => $kmsData,
                'kmsDataPaginate' => $paginator,
                'selectedBayi' => $selectedBayi,
                'selectedBayiNik' => $selectedBayiNik,
                'selectedKader' => $selectedKader,
            ]);
        } catch (\Exception $e) {
            Log::error('Kesalahan saat memuat data KMS: ' . $e->getMessage());
            return redirect()->route('kms.index')->with('error', 'Terjadi kesalahan saat memuat data KMS: ' . $e->getMessage());
        }
    }

    // Menambahkan data KMS baru
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nik_bayi' => 'required|exists:bayis,nik',
                'tanggal' => 'required|date',
                'tinggi_badan' => 'required|numeric',
                'berat_badan' => 'required|numeric',
                'imunisasi' => 'nullable|string',
            ]);

            $bayi = Bayi::where('nik', $request->nik_bayi)->first();
            $previousKMS = KMS::where('nik_bayi', $request->nik_bayi)
                ->orderBy('tanggal', 'desc')
                ->first();

            if (!$previousKMS) {
                $kategori = 'B';
            } else {
                $kategori = $this->determineCategory($request->berat_badan, $previousKMS->berat_badan);
            }

            KMS::create(array_merge($validated, ['kategori' => $kategori]));

            return redirect()->back()->with('success', 'Data KMS berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Kesalahan saat menambahkan data KMS: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data KMS: ' . $e->getMessage());
        }
    }

    // Memperbarui data KMS
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'tanggal' => 'required|date',
                'tinggi_badan' => 'required|numeric',
                'berat_badan' => 'required|numeric',
                'imunisasi' => 'nullable|string',
            ]);

            $kms = KMS::findOrFail($id);

            $previousKMS = KMS::where('nik_bayi', $kms->nik_bayi)
                ->where('tanggal', '<', $request->tanggal)
                ->orderBy('tanggal', 'desc')
                ->first();

            $kategori = $previousKMS ? $this->determineCategory($request->berat_badan, $previousKMS->berat_badan) : 'B';

            $kms->update(array_merge($validated, ['kategori' => $kategori]));

            return redirect()->back()->with('success', 'Data KMS berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Kesalahan saat memperbarui data KMS: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data KMS: ' . $e->getMessage());
        }
    }

    // Menghapus data KMS
    public function destroy($id)
    {
        try {
            $kms = KMS::findOrFail($id);
            $kms->delete();

            return redirect()->back()->with('success', 'Data KMS berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Kesalahan saat menghapus data KMS: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data KMS: ' . $e->getMessage());
        }
    }

    // Fungsi untuk menentukan kategori berdasarkan berat badan
    private function determineCategory($currentWeight, $previousWeight)
    {
        if ($currentWeight < $previousWeight) {
            return 'T (Turun)';
        } elseif ($currentWeight > $previousWeight) {
            return 'N (Naik)';
        } else {
            return 'T (Tetap)';
        }
    }
}
