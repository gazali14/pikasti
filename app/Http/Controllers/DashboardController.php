<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kehadiran;
use App\Models\Bayi;
use App\Models\KMS;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data jumlah pengunjung berdasarkan jenis kelamin dan rentang tanggal
        $lakiLaki = Kehadiran::whereHas('bayis', function($query) {
            $query->where('jenis_kelamin', 'Laki-Laki');
        })
        ->whereDate('tanggal', '>=', request('tanggal_mulai') ?? '2000-01-01')  // Gunakan whereDate untuk membandingkan hanya tanggal
        ->whereDate('tanggal', '<=', request('tanggal_akhir') ?? now()->toDateString()) // Begitu juga untuk tanggal akhir
        ->count();

        $perempuan = Kehadiran::whereHas('bayis', function($query) {
                    $query->where('jenis_kelamin', 'Perempuan');
                })
                ->whereDate('tanggal', '>=', request('tanggal_mulai') ?? '2000-01-01')  // Sama untuk perbandingan tanggal
                ->whereDate('tanggal', '<=', request('tanggal_akhir') ?? now()->toDateString()) // Perbandingan dengan tanggal akhir
                ->count();


        $tanggalReferensi = Carbon::createFromFormat('Y-m-d', $request->input('tahun_akhir', now()->toDateString()));

        
        // Ambil data bayi dengan KMS menggunakan join
        $bayis = Bayi::join('kms', 'bayis.nik', '=', 'kms.nik_bayi') // Menggabungkan tabel bayi dan kms
            ->where('kms.tanggal', '<=', $tanggalReferensi) // Mengambil data KMS sesuai tanggal referensi
            ->select('bayis.*', 'kms.tinggi_badan', 'kms.berat_badan', 'kms.tanggal') // Memilih kolom yang diperlukan
            ->get();

        // Mengelompokkan bayi berdasarkan umur dalam bulan
        $umurKelompok = [];
        $tinggiBadanLaki = [];
        $tinggiBadanPerempuan = [];
        $beratBadanLaki = [];
        $beratBadanPerempuan = [];

        // Menghitung umur bayi dalam bulan dan mengelompokkan berdasarkan rentang umur
        foreach ($bayis as $bayi) {
            // Menghitung umur bayi dalam bulan berdasarkan tanggal 31 Desember tahun yang ditentukan
            $umur = $tanggalReferensi->diffInMonths($bayi->tanggal_lahir); // Menghitung umur berdasarkan tanggal lahir bayi dan 31 Desember tahun referensi
            $kelompokUmur = -floor($umur / 5) * 5; // Membulatkan umur ke kelipatan 6 bulan
            $kelompok = $kelompokUmur . '-' . ($kelompokUmur + 5); // Format kelompok umur misalnya 0-5, 6-11, ...

            // Menyimpan data tinggi badan dan berat badan berdasarkan jenis kelamin dan kelompok umur
            if ($bayi->jenis_kelamin == 'Laki-Laki') {
                $tinggiBadanLaki[$kelompok][] = $bayi->tinggi_badan;
                $beratBadanLaki[$kelompok][] = $bayi->berat_badan;
            } else {
                $tinggiBadanPerempuan[$kelompok][] = $bayi->tinggi_badan;
                $beratBadanPerempuan[$kelompok][] = $bayi->berat_badan;
            }

            // Menyimpan kelompok umur unik
            if (!in_array($kelompok, $umurKelompok)) {
                $umurKelompok[] = $kelompok;
            }
        }

        // Menghitung rata-rata tinggi badan dan berat badan per kelompok umur
        $rataRataTinggiLaki = [];
        $rataRataTinggiPerempuan = [];
        $rataRataBeratLaki = [];
        $rataRataBeratPerempuan = [];

        foreach ($umurKelompok as $kelompok) {
            // Pastikan kelompok umur ada dalam array sebelum menghitung rata-rata
            $rataRataTinggiLaki[$kelompok] = isset($tinggiBadanLaki[$kelompok]) && count($tinggiBadanLaki[$kelompok]) > 0 ? array_sum($tinggiBadanLaki[$kelompok]) / count($tinggiBadanLaki[$kelompok]) : 0;
            $rataRataTinggiPerempuan[$kelompok] = isset($tinggiBadanPerempuan[$kelompok]) && count($tinggiBadanPerempuan[$kelompok]) > 0 ? array_sum($tinggiBadanPerempuan[$kelompok]) / count($tinggiBadanPerempuan[$kelompok]) : 0;
            $rataRataBeratLaki[$kelompok] = isset($beratBadanLaki[$kelompok]) && count($beratBadanLaki[$kelompok]) > 0 ? array_sum($beratBadanLaki[$kelompok]) / count($beratBadanLaki[$kelompok]) : 0;
            $rataRataBeratPerempuan[$kelompok] = isset($beratBadanPerempuan[$kelompok]) && count($beratBadanPerempuan[$kelompok]) > 0 ? array_sum($beratBadanPerempuan[$kelompok]) / count($beratBadanPerempuan[$kelompok]) : 0;
        }

        return view('kader.dashboard', [
            'bayi'=> $bayis,
            'lakiLaki' => $lakiLaki,
            'perempuan' => $perempuan,
            'rataRataTinggiLaki' => $rataRataTinggiLaki,
            'rataRataTinggiPerempuan' => $rataRataTinggiPerempuan,
            'rataRataBeratLaki' => $rataRataBeratLaki,
            'rataRataBeratPerempuan' => $rataRataBeratPerempuan,
            'umurKelompok' => $umurKelompok, // Pastikan variabel ini dikirim ke view
            'tahun' => $request->input('tahun_akhir', now()->year),
        ]);
    }
}
