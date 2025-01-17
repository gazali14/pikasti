<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\KMS;
use App\Models\Bayi;
use App\Models\Jadwal;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardKaderController extends Controller
{
    public function index(Request $request)
    {
        $selectedKader = Auth::guard('kader')->user();
        // Ambil tanggal dari input, default ke hari ini jika tidak ada
        $tanggal = $request->input('tanggal', Carbon::today()->toDateString());
        // Ambil nama_kegiatan dari tabel Jadwal yang tanggalnya sama dengan $tanggal
        $jadwal = Jadwal::whereDate('tanggal', $tanggal)->first(); // Mengambil satu data berdasarkan tanggal
        // Ambil data kehadiran untuk tanggal tersebut
        $kehadiranData = Kehadiran::where('tanggal', $tanggal)->get();
        // Hitung jumlah bayi berdasarkan jenis kelamin
        $data = [
            'Laki-Laki' => $kehadiranData
                ->where('jenis_kelamin', 'Laki-Laki')
                ->where('kehadiran', true)
                ->count(),
            'Perempuan' => $kehadiranData
                ->where('jenis_kelamin', 'Perempuan')
                ->where('kehadiran', true)
                ->count(),
        ];


        // Ambil data KMS untuk bayi berdasarkan tanggal
        $kmsData = KMS::with('bayi') // Assuming KMS has a relationship with Bayi model
            ->whereDate('tanggal', $tanggal) // Filter by the input date
            ->orderBy('tanggal', 'asc')
            ->get();

        // Inisialisasi array untuk data chart
        $heightMaleData = [];
        $heightFemaleData = [];
        $weightMaleData = [];
        $weightFemaleData = [];
        $ageGroups = ['0-5', '6-10', '11-15', '16-20', '21-25', '26-30']; // Example age groups

        // Loop untuk memproses data KMS dan mengelompokkan berdasarkan umur (bulan)
        foreach ($kmsData as $item) {
            $tanggalLahir = Carbon::parse($item->bayi->tanggal_lahir);
            $tanggalKMS = Carbon::parse($item->tanggal);
            $umurBulan = $tanggalLahir->diffInMonths($tanggalKMS);

            // Tentukan kelompok umur
            $ageGroup = $this->getAgeGroup($umurBulan, $ageGroups);

            // Menambahkan data berdasarkan jenis kelamin
            if ($item->bayi->jenis_kelamin == 'Laki-Laki') {
                $heightMaleData[$ageGroup][] = $item->tinggi_badan;
                $weightMaleData[$ageGroup][] = $item->berat_badan;
            } else {
                $heightFemaleData[$ageGroup][] = $item->tinggi_badan;
                $weightFemaleData[$ageGroup][] = $item->berat_badan;
            }
        }

        // Hitung rata-rata tinggi badan dan berat badan per kelompok umur
        $heightMaleAverage = $this->calculateAverage($heightMaleData);
        $heightFemaleAverage = $this->calculateAverage($heightFemaleData);
        $weightMaleAverage = $this->calculateAverage($weightMaleData);
        $weightFemaleAverage = $this->calculateAverage($weightFemaleData);

        // Pass data ke view
        return view('kader.dashboard', [
            'chartData' => $data,
            'tanggal' => $tanggal,
            'namaKegiatan' => $jadwal ? $jadwal->nama_kegiatan : 'Tidak ada kegiatan',
            'heightMaleAverage' => $heightMaleAverage,
            'heightFemaleAverage' => $heightFemaleAverage,
            'weightMaleAverage' => $weightMaleAverage,
            'weightFemaleAverage' => $weightFemaleAverage,
            'ageGroups' => $ageGroups,
            'selectedKader' => $selectedKader,
        ]);
    }

    // Fungsi untuk menentukan kelompok umur berdasarkan bulan
    private function getAgeGroup($umurBulan, $ageGroups)
    {
        foreach ($ageGroups as $index => $range) {
            list($minAge, $maxAge) = explode('-', $range);
            if ($umurBulan >= $minAge && $umurBulan <= $maxAge) {
                return $range;
            }
        }
        return '31+'; // Untuk umur lebih dari 30 bulan
    }

    // Fungsi untuk menghitung rata-rata
    private function calculateAverage($data)
    {
        $averages = [];
        foreach ($data as $ageGroup => $values) {
            $averages[$ageGroup] = count($values) ? array_sum($values) / count($values) : 0;
        }
        return $averages;
    }
}
