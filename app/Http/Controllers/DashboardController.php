<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kehadiran;
use App\Models\Bayi;
use App\Models\KMS;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->input('tahun', 2025); // Menggunakan tahun default 2025 jika tidak ada input

        // Menentukan tanggal referensi berdasarkan tahun yang dipilih
        $tanggalReferensi = \Carbon\Carbon::create($tahun, 12, 31); // Tanggal 31 Desember pada tahun yang dipilih

        // Mengambil data jumlah pengunjung berdasarkan jenis kelamin
        $lakiLaki = Kehadiran::whereHas('bayis', function($query) {
            $query->where('jenis_kelamin', 'Laki-Laki');
        })->count();
        
        $perempuan = Kehadiran::whereHas('bayis', function($query) {
            $query->where('jenis_kelamin', 'Perempuan');
        })->count();
        
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
            $rataRataTinggiLaki[$kelompok] = count($tinggiBadanLaki[$kelompok]) > 0 ? array_sum($tinggiBadanLaki[$kelompok]) / count($tinggiBadanLaki[$kelompok]) : 0;
            $rataRataTinggiPerempuan[$kelompok] = count($tinggiBadanPerempuan[$kelompok]) > 0 ? array_sum($tinggiBadanPerempuan[$kelompok]) / count($tinggiBadanPerempuan[$kelompok]) : 0;
            $rataRataBeratLaki[$kelompok] = count($beratBadanLaki[$kelompok]) > 0 ? array_sum($beratBadanLaki[$kelompok]) / count($beratBadanLaki[$kelompok]) : 0;
            $rataRataBeratPerempuan[$kelompok] = count($beratBadanPerempuan[$kelompok]) > 0 ? array_sum($beratBadanPerempuan[$kelompok]) / count($beratBadanPerempuan[$kelompok]) : 0;
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
            'tahun' => $tahun, // Mengirimkan nilai tahun ke view
        ]);
    }
}
