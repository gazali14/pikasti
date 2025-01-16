<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\kms;
use App\Models\PMT;
use App\Models\Bayi;
use App\Models\Jadwal;
use App\Models\Vitamin;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Exports\LaporanExport;
use App\Models\KehadiranKader;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::guard('kader')->user()->is_admin) {
            return redirect()->route('orang_tua.before_login.login')->withErrors(['error' => 'Admin tidak dapat mengakses halaman kader.']);
        }
        $selectedKader = Auth::guard('kader')->user();
        // Ambil tanggal dari input, default ke hari ini jika tidak ada
        $tanggal = $request->input('tanggal', Carbon::today()->toDateString());

        // Ambil nama_kegiatan dari tabel Jadwal yang tanggalnya sama dengan $tanggal
        $jadwal = Jadwal::whereDate('tanggal', $tanggal)->first(); // Mengambil satu data berdasarkan tanggal


        // Statistik Kehadiran Kader
        $jumlahKaderHadir = KehadiranKader::whereDate('tanggal', $tanggal)
            ->distinct('kader_id')
            ->count('kader_id');

        // Statistik PMT
        $pmtData = PMT::whereDate('tanggal', $tanggal)->get(); // Filter berdasarkan tanggal
        $adaPMT = $pmtData->isEmpty() ? 'Tidak Ada' : 'Ada';
        $keteranganPMT = $pmtData->isEmpty() ? 'Tidak ada keterangan' : $pmtData->first()->pmt;

        // Statistik Vitamin
        $jumlahVitaminMerah = Vitamin::whereDate('tanggal', $tanggal)
            ->where('vitamin', 'MERAH')
            ->count();
        $jumlahVitaminBiru = Vitamin::whereDate('tanggal', $tanggal)
            ->where('vitamin', 'BIRU')
            ->count();

        // Statistik Balita
        $totalBalitaPerempuan = Bayi::whereDate('tanggal_lahir', '<=', $tanggal)
            ->where('jenis_kelamin', 'Perempuan')
            ->count();
        $totalBalitaLakiLaki = Bayi::whereDate('tanggal_lahir', '<=', $tanggal)
            ->where('jenis_kelamin', 'Laki-Laki')
            ->count();
            
        // Statistik KMS
        $balitaMemilikiKMSPerempuan = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Perempuan')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->distinct('kms.nik_bayi')
            ->count();
        $balitaMemilikiKMSLakiLaki = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Laki-Laki')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->distinct('kms.nik_bayi')
            ->count();

        // Statistik Imunisasi
        $imunisasiBCGPerempuan = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Perempuan')
            ->where('kms.imunisasi', 'BCG')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();
        $imunisasiBCGLakiLaki = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Laki-Laki')
            ->where('kms.imunisasi', 'BCG')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();

        $imunisasiPolioIPerempuan = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Perempuan')
            ->where('kms.imunisasi', 'Polio I')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();
        $imunisasiPolioILakiLaki = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Laki-Laki')
            ->where('kms.imunisasi', 'Polio I')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();

        $imunisasiPolioIIPerempuan = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Perempuan')
            ->where('kms.imunisasi', 'Polio II')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();
        $imunisasiPolioIILakiLaki = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Laki-Laki')
            ->where('kms.imunisasi', 'Polio II')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();

        $imunisasiPolioIIIPerempuan = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Perempuan')
            ->where('kms.imunisasi', 'Polio III')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();
        $imunisasiPolioIIILakiLaki = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Laki-Laki')
            ->where('kms.imunisasi', 'Polio III')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();

        $imunisasiPolioIVPerempuan = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Perempuan')
            ->where('kms.imunisasi', 'Polio IV')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();
        $imunisasiPolioIVLakiLaki = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Laki-Laki')
            ->where('kms.imunisasi', 'Polio IV')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();

        $imunisasiCampakPerempuan = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Perempuan')
            ->where('kms.imunisasi', 'Campak')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();
        $imunisasiCampakLakiLaki = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Laki-Laki')
            ->where('kms.imunisasi', 'Campak')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();

        $imunisasiHepatitisB1Perempuan = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Perempuan')
            ->where('kms.imunisasi', 'DPT Hb Com1')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();
        $imunisasiHepatitisB1LakiLaki = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Laki-Laki')
            ->where('kms.imunisasi', 'DPT Hb Com1')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();

        $imunisasiHepatitisB2Perempuan = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Perempuan')
            ->where('kms.imunisasi', 'DPT Hb Com2')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();
        $imunisasiHepatitisB2LakiLaki = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Laki-Laki')
            ->where('kms.imunisasi', 'DPT Hb Com2')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();

        $imunisasiHepatitisB3Perempuan = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Perempuan')
            ->where('kms.imunisasi', 'DPT Hb Com3')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();
        $imunisasiHepatitisB3LakiLaki = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Laki-Laki')
            ->where('kms.imunisasi', 'DPT Hb Com3')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();
        
        // Statistik Kategori Berat Badan
        $naikBBPerempuan = KMS::where('kategori', 'N')
            ->join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Perempuan')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();
        $naikBBLakiLaki = KMS::where('kategori', 'N')
            ->join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Laki-Laki')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();

        $tetapBBPerempuan = KMS::whereIn('kategori', ['T (Tetap)', 'T (Turun)'])
            ->join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Perempuan')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();

        $tetapBBLakiLaki = KMS::whereIn('kategori', ['T (Tetap)', 'T (Turun)'])
            ->join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Laki-Laki')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();

        $pertamaKaliDitimbangPerempuan = KMS::where('kategori', 'B')
            ->join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Perempuan')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();
        $pertamaKaliDitimbangLakiLaki = KMS::where('kategori', 'B')
            ->join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Laki-Laki')
            ->whereDate('kms.tanggal', '<=', $tanggal)
            ->count();

        // Statistik Usia
        $ditimbang0_23Perempuan = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Perempuan')
            ->whereRaw('
                (strftime("%Y", kms.tanggal) - strftime("%Y", bayis.tanggal_lahir)) * 12 + strftime("%m", kms.tanggal) - strftime("%m", bayis.tanggal_lahir) BETWEEN 0 AND 23
            ')
            ->when(request('tanggal'), function ($query) {
                return $query->whereDate('kms.tanggal', '=', request('tanggal'));
            })
            ->count();
        $ditimbang0_23LakiLaki = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Laki-Laki')
            ->whereRaw('
                (strftime("%Y", kms.tanggal) - strftime("%Y", bayis.tanggal_lahir)) * 12 + strftime("%m", kms.tanggal) - strftime("%m", bayis.tanggal_lahir) BETWEEN 0 AND 23
            ')
            ->when(request('tanggal'), function ($query) {
                return $query->whereDate('kms.tanggal', '=', request('tanggal'));
            })
            ->count();

        $ditimbang24_59Perempuan = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Perempuan')
            ->whereRaw('
                (strftime("%Y", kms.tanggal) - strftime("%Y", bayis.tanggal_lahir)) * 12 + strftime("%m", kms.tanggal) - strftime("%m", bayis.tanggal_lahir) BETWEEN 24 AND 59
            ')
            ->when(request('tanggal'), function ($query) {
                return $query->whereDate('kms.tanggal', '=', request('tanggal'));
            })
            ->count();
        $ditimbang24_59LakiLaki = KMS::join('bayis', 'kms.nik_bayi', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Laki-Laki')
            ->whereRaw('
                (strftime("%Y", kms.tanggal) - strftime("%Y", bayis.tanggal_lahir)) * 12 + strftime("%m", kms.tanggal) - strftime("%m", bayis.tanggal_lahir) BETWEEN 24 AND 59
            ')
            ->when(request('tanggal'), function ($query) {
                return $query->whereDate('kms.tanggal', '=', request('tanggal'));
            })
            ->count();
        
        $jumlahBayiUsia1P = Kehadiran::join('bayis', 'kehadiran.nik', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Perempuan')
            ->whereRaw('
                (strftime("%Y", date("now")) - strftime("%Y", bayis.tanggal_lahir)) * 12 +
                (strftime("%m", date("now")) - strftime("%m", bayis.tanggal_lahir)) BETWEEN 0 AND 12
            ')
            ->when(request('tanggal'), function ($query) {
                return $query->whereDate('kehadiran.tanggal', '=', request('tanggal'));
            })
            ->where('kehadiran.kehadiran', 1)
            ->count();

        $jumlahBayiUsia1L = Kehadiran::join('bayis', 'kehadiran.nik', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Laki-Laki')
            ->whereRaw('
                (strftime("%Y", date("now")) - strftime("%Y", bayis.tanggal_lahir)) * 12 +
                (strftime("%m", date("now")) - strftime("%m", bayis.tanggal_lahir)) BETWEEN 0 AND 12
            ')
            ->when(request('tanggal'), function ($query) {
                return $query->whereDate('kehadiran.tanggal', '=', request('tanggal'));
            })
            ->where('kehadiran.kehadiran', 1)
            ->count();

        $jumlahBayiUsia2P = Kehadiran::join('bayis', 'kehadiran.nik', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Perempuan')
            ->whereRaw('
                (strftime("%Y", date("now")) - strftime("%Y", bayis.tanggal_lahir)) * 12 +
                (strftime("%m", date("now")) - strftime("%m", bayis.tanggal_lahir)) BETWEEN 13 AND 60
            ')
            ->when(request('tanggal'), function ($query) {
                return $query->whereDate('kehadiran.tanggal', '=', request('tanggal'));
            })
            ->where('kehadiran.kehadiran', 1)
            ->count();

        $jumlahBayiUsia2L = Kehadiran::join('bayis', 'kehadiran.nik', '=', 'bayis.nik')
            ->where('bayis.jenis_kelamin', 'Laki-Laki')
            ->whereRaw('
                (strftime("%Y", date("now")) - strftime("%Y", bayis.tanggal_lahir)) * 12 +
                (strftime("%m", date("now")) - strftime("%m", bayis.tanggal_lahir)) BETWEEN 13 AND 60
            ')
            ->when(request('tanggal'), function ($query) {
                return $query->whereDate('kehadiran.tanggal', '=', request('tanggal'));
            })
            ->where('kehadiran.kehadiran', 1)
            ->count();

        // Mendapatkan tanggal saat ini
        $now = Carbon::now();

        // Jumlah bayi berdasarkan usia 0-5 bulan
        $bayi_0_5_bulan = Bayi::whereBetween(
            'tanggal_lahir', 
            [$now->copy()->subMonths(5), $now]
        )->count();

        // Jumlah bayi berdasarkan usia 6-11 bulan
        $bayi_6_11_bulan = Bayi::whereBetween(
            'tanggal_lahir', 
            [$now->copy()->subMonths(11), $now->copy()->subMonths(6)]
        )->count();

        // Jumlah bayi berdasarkan usia 12-23 bulan
        $bayi_12_23_bulan = Bayi::whereBetween(
            'tanggal_lahir', 
            [$now->copy()->subMonths(23), $now->copy()->subMonths(12)]
        )->count();

        // Jumlah bayi berdasarkan usia 24-59 bulan
        $bayi_24_59_bulan = Bayi::whereBetween(
            'tanggal_lahir', 
            [$now->copy()->subMonths(59), $now->copy()->subMonths(24)]
        )->count();

            
        // Kirim data ke view
        return view('kader.laporan', [
            'tanggal' => $tanggal,
            'namaKegiatan' => $jadwal ? $jadwal->nama_kegiatan : 'Tidak ada kegiatan',
            'jumlahKaderHadir' => $jumlahKaderHadir,
            'adaPMT' => $adaPMT, 
            'keteranganPMT' => $keteranganPMT,
            'jumlahVitaminMerah' => $jumlahVitaminMerah,
            'jumlahVitaminBiru' => $jumlahVitaminBiru,
            'totalBalitaPerempuan' => $totalBalitaPerempuan,
            'totalBalitaLakiLaki' => $totalBalitaLakiLaki,
            'balitaMemilikiKMSPerempuan' => $balitaMemilikiKMSPerempuan,
            'balitaMemilikiKMSLakiLaki' => $balitaMemilikiKMSLakiLaki,
            'imunisasiBCGPerempuan' => $imunisasiBCGPerempuan,
            'imunisasiBCGLakiLaki' => $imunisasiBCGLakiLaki,
            'imunisasiPolioIPerempuan' => $imunisasiPolioIPerempuan,
            'imunisasiPolioILakiLaki' => $imunisasiPolioILakiLaki,
            'imunisasiPolioIIPerempuan' => $imunisasiPolioIIPerempuan,
            'imunisasiPolioIILakiLaki' => $imunisasiPolioIILakiLaki,
            'imunisasiPolioIIIPerempuan' => $imunisasiPolioIIIPerempuan,
            'imunisasiPolioIIILakiLaki' => $imunisasiPolioIIILakiLaki,
            'imunisasiPolioIVPerempuan' => $imunisasiPolioIVPerempuan,
            'imunisasiPolioIVLakiLaki' => $imunisasiPolioIVLakiLaki,
            'imunisasiCampakPerempuan' => $imunisasiCampakPerempuan,
            'imunisasiCampakLakiLaki' => $imunisasiCampakLakiLaki,
            'imunisasiHepatitisB1Perempuan' => $imunisasiHepatitisB1Perempuan,
            'imunisasiHepatitisB1LakiLaki' => $imunisasiHepatitisB1LakiLaki,
            'imunisasiHepatitisB2Perempuan' => $imunisasiHepatitisB2Perempuan,
            'imunisasiHepatitisB2LakiLaki' => $imunisasiHepatitisB2LakiLaki,
            'imunisasiHepatitisB3Perempuan' => $imunisasiHepatitisB3Perempuan,
            'imunisasiHepatitisB3LakiLaki' => $imunisasiHepatitisB3LakiLaki,
            'naikBBPerempuan' => $naikBBPerempuan,
            'naikBBLakiLaki' => $naikBBLakiLaki,
            'tetapBBPerempuan' => $tetapBBPerempuan,
            'tetapBBLakiLaki' => $tetapBBLakiLaki,
            'pertamaKaliDitimbangPerempuan' => $pertamaKaliDitimbangPerempuan,
            'pertamaKaliDitimbangLakiLaki' => $pertamaKaliDitimbangLakiLaki,
            'ditimbang0_23Perempuan' => $ditimbang0_23Perempuan,
            'ditimbang0_23LakiLaki' => $ditimbang0_23LakiLaki,
            'ditimbang24_59Perempuan' => $ditimbang24_59Perempuan,
            'ditimbang24_59LakiLaki' => $ditimbang24_59LakiLaki,
            'jumlahBayiUsia1P' => $jumlahBayiUsia1P, 
            'jumlahBayiUsia1L' => $jumlahBayiUsia1L,
            'jumlahBayiUsia2P' => $jumlahBayiUsia2P, 
            'jumlahBayiUsia2L' => $jumlahBayiUsia2L,
            'bayi_0_5_bulan' => $bayi_0_5_bulan,
            'bayi_6_11_bulan' => $bayi_6_11_bulan,
            'bayi_12_23_bulan' => $bayi_12_23_bulan,
            'bayi_24_59_bulan' => $bayi_24_59_bulan,
            'selectedKader' => $selectedKader,
        ]);
    }

    public function exportLaporan(Request $request)
    {
        $data = [
            'tanggal' => request('tanggal'),
            'jumlahKaderHadir' => request('jumlahKaderHadir'),
            'jumlahBayiUsia1P' => request('jumlahBayiUsia1P'),
            'jumlahBayiUsia1L' => request('jumlahBayiUsia1L'),
            'jumlahBayiUsia2P' => request('jumlahBayiUsia2P'),
            'jumlahBayiUsia2L' => request('jumlahBayiUsia2L'),
            'totalBalitaPerempuan' => request('totalBalitaPerempuan'),
            'totalBalitaLakiLaki' => request('totalBalitaLakiLaki'),
            'balitaMemilikiKMSPerempuan' => request('balitaMemilikiKMSPerempuan'),
            'balitaMemilikiKMSLakiLaki' => request('balitaMemilikiKMSLakiLaki'),
            'imunisasiBCGPerempuan' => request('imunisasiBCGPerempuan'),
            'imunisasiBCGLakiLaki' => request('imunisasiBCGLakiLaki'),
            'imunisasiPolioIPerempuan' => request('imunisasiPolioIPerempuan'),
            'imunisasiPolioILakiLaki' => request('imunisasiPolioILakiLaki'),
            'imunisasiPolioIIPerempuan' => request('imunisasiPolioIIPerempuan'),
            'imunisasiPolioIILakiLaki' => request('imunisasiPolioIILakiLaki'),
            'imunisasiPolioIIIPerempuan' => request('imunisasiPolioIIIPerempuan'),
            'imunisasiPolioIIILakiLaki' => request('imunisasiPolioIIILakiLaki'),
            'imunisasiPolioIVPerempuan' => request('imunisasiPolioIVPerempuan'),
            'imunisasiPolioIVLakiLaki' => request('imunisasiPolioIVLakiLaki'),
            'imunisasiCampakPerempuan' => request('imunisasiCampakPerempuan'),
            'imunisasiCampakLakiLaki' => request('imunisasiCampakLakiLaki'),
            'imunisasiHepatitisB1Perempuan' => request('imunisasiHepatitisB1Perempuan'),
            'imunisasiHepatitisB1LakiLaki' => request('imunisasiHepatitisB1LakiLaki'),
            'imunisasiHepatitisB2Perempuan' => request('imunisasiHepatitisB2Perempuan'),
            'imunisasiHepatitisB2LakiLaki' => request('imunisasiHepatitisB2LakiLaki'),
            'imunisasiHepatitisB3Perempuan' => request('imunisasiHepatitisB3Perempuan'),
            'imunisasiHepatitisB3LakiLaki' => request('imunisasiHepatitisB3LakiLaki'),
            'naikBBPerempuan' => request('naikBBPerempuan'),
            'naikBBLakiLaki' => request('naikBBLakiLaki'),
            'tetapBBPerempuan' => request('tetapBBPerempuan'),
            'tetapBBLakiLaki' => request('tetapBBLakiLaki'),
            'pertamaKaliDitimbangPerempuan' => request('pertamaKaliDitimbangPerempuan'),
            'pertamaKaliDitimbangLakiLaki' => request('pertamaKaliDitimbangLakiLaki'),
            'ditimbang0_23Perempuan' => request('ditimbang0_23Perempuan'),
            'ditimbang0_23LakiLaki' => request('ditimbang0_23LakiLaki'),
            'ditimbang24_59Perempuan' => request('ditimbang24_59Perempuan'),
            'ditimbang24_59LakiLaki' => request('ditimbang24_59LakiLaki'),
            'bayi_0_5_bulan' => request('bayi_0_5_bulan'),
            'bayi_6_11_bulan' => request('bayi_6_11_bulan'),
            'bayi_12_23_bulan' => request('bayi_12_23_bulan'),
            'bayi_24_59_bulan' => request('bayi_24_59_bulan'),
            'adaPMT' => request('adaPMT'),
            'keteranganPMT' => request('keteranganPMT'),
            'jumlahVitaminMerah' => request('jumlahVitaminMerah'),
            'jumlahVitaminBiru' => request('jumlahVitaminBiru'),
        ];
        $tanggal = $request->input('tanggal');
        return Excel::download(new LaporanExport($data), 'laporan_' . \Carbon\Carbon::parse($tanggal)->format('Y-m-d') . '.xlsx');
    }


}
