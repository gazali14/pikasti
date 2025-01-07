<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class LaporanExport implements FromArray
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return [
            [
                'Judul' => 'Laporan tanggal',
                'tanggal' => $this->data['tanggal'],
            ],
            [
                'Judul' => '   ',
            ],
            ['Kategori', 'Perempuan', 'Laki-laki', 'Total','Keterangan'],
            [
                'Kategori' => 'Total Balita',
                'Perempuan' => $this->data['totalBalitaPerempuan'],
                'Laki-laki' => $this->data['totalBalitaLakiLaki'],
                'Total' => $this->data['totalBalitaPerempuan'] + $this->data['totalBalitaLakiLaki'],
            ],
            [
                'Kategori' => 'Balita Memiliki KMS',
                'Perempuan' => $this->data['balitaMemilikiKMSPerempuan'],
                'Laki-laki' => $this->data['balitaMemilikiKMSLakiLaki'],
                'Total' => $this->data['balitaMemilikiKMSPerempuan'] + $this->data['balitaMemilikiKMSLakiLaki'],
            ],
            [
                'Kategori' => 'Berat Badan Naik',
                'Perempuan' => $this->data['naikBBPerempuan'],
                'Laki-laki' => $this->data['naikBBLakiLaki'],
                'Total' => $this->data['naikBBPerempuan'] + $this->data['naikBBLakiLaki'],
            ],
            [
                'Kategori' => 'Berat Badan Tetap',
                'Perempuan' => $this->data['tetapBBPerempuan'],
                'Laki-laki' => $this->data['tetapBBLakiLaki'],
                'Total' => $this->data['tetapBBPerempuan'] + $this->data['tetapBBLakiLaki'],
            ],
            [
                'Kategori' => 'Pertama Kali Ditimbang',
                'Perempuan' => $this->data['pertamaKaliDitimbangPerempuan'],
                'Laki-laki' => $this->data['pertamaKaliDitimbangLakiLaki'],
                'Total' => $this->data['pertamaKaliDitimbangPerempuan'] + $this->data['pertamaKaliDitimbangLakiLaki'],
            ],
            [
                'Kategori' => 'Ditimbang 0-23 Bulan',
                'Perempuan' => $this->data['ditimbang0_23Perempuan'],
                'Laki-laki' => $this->data['ditimbang0_23LakiLaki'],
                'Total' => $this->data['ditimbang0_23Perempuan'] + $this->data['ditimbang0_23LakiLaki'],
            ],
            [
                'Kategori' => 'Ditimbang 24-59 Bulan',
                'Perempuan' => '-',
                'Laki-laki' => '-',
                'Total' => $this->data['ditimbang24_59Perempuan'] + $this->data['ditimbang24_59LakiLaki'],
            ],
            [
                'Kategori' => 'Kehadiran bayi Usia 0-12 Bulan',
                'Perempuan' => $this->data['jumlahBayiUsia1P'],
                'Laki-laki' => $this->data['jumlahBayiUsia1L'],
                'Total' => $this->data['jumlahBayiUsia1P'] + $this->data['jumlahBayiUsia1L'],
            ],
            [
                'Kategori' => 'Kehadiran bayi Usia 13-60 Bulan',
                'Perempuan' => $this->data['jumlahBayiUsia2P'],
                'Laki-laki' => $this->data['jumlahBayiUsia2L'],
                'Total' => $this->data['jumlahBayiUsia2P'] + $this->data['jumlahBayiUsia2L'],
            ],
            [
                'Kategori' => 'Jumlah Kader Hadir',
                'Perempuan' => '-',
                'Laki-laki' => '-',
                'Total' => $this->data['jumlahKaderHadir'],
            ],
            [
                'Kategori' => 'Bayi 0-5 Bulan',
                'Perempuan' => '-',
                'Laki-laki' => '-',
                'Total' => $this->data['bayi_0_5_bulan'],
            ],
            [
                'Kategori' => 'Bayi 6-11 Bulan',
                'Perempuan' => '-',
                'Laki-laki' => '-',
                'Total' => $this->data['bayi_6_11_bulan'],
            ],
            [
                'Kategori' => 'Bayi 12-23 Bulan',
                'Perempuan' => '-',
                'Laki-laki' => '-',
                'Total' => $this->data['bayi_12_23_bulan'],
            ],
            [
                'Kategori' => 'Bayi 24-59 Bulan',
                'Perempuan' => $this->data['bayi_24_59_bulan'],
                'Laki-laki' => '-',
                'Total' => $this->data['bayi_24_59_bulan'],
            ],
            [
                'Kategori' => 'Vitamin Merah',
                'Perempuan' => '-',
                'Laki-laki' => '-',
                'Total' => $this->data['jumlahVitaminMerah'],
            ],
            [
                'Kategori' => 'Vitamin Biru',
                'Perempuan' => '-',
                'Laki-laki' => '-',
                'Total' => $this->data['jumlahVitaminBiru'],
            ],
            [
                'Kategori' => 'PMT',
                'Perempuan' => '-',
                'Laki-laki' => '-',
                'Total' => $this->data['adaPMT'],
                'Keterangan' => $this->data['keteranganPMT']
            ],
            [
                'Kategori' => 'Imunisasi BCG',
                'Perempuan' => $this->data['imunisasiBCGPerempuan'],
                'Laki-laki' => $this->data['imunisasiBCGLakiLaki'],
                'Total' => $this->data['imunisasiBCGPerempuan'] + $this->data['imunisasiBCGLakiLaki'],
            ],
            [
                'Kategori' => 'Imunisasi Polio I',
                'Perempuan' => $this->data['imunisasiPolioIPerempuan'],
                'Laki-laki' => $this->data['imunisasiPolioILakiLaki'],
                'Total' => $this->data['imunisasiPolioIPerempuan'] + $this->data['imunisasiPolioILakiLaki'],
            ],
            [
                'Kategori' => 'Imunisasi Polio II',
                'Perempuan' => $this->data['imunisasiPolioIIPerempuan'],
                'Laki-laki' => $this->data['imunisasiPolioIILakiLaki'],
                'Total' => $this->data['imunisasiPolioIIPerempuan'] + $this->data['imunisasiPolioIILakiLaki'],
            ],
            [
                'Kategori' => 'Imunisasi Polio III',
                'Perempuan' => $this->data['imunisasiPolioIIIPerempuan'],
                'Laki-laki' => $this->data['imunisasiPolioIIILakiLaki'],
                'Total' => $this->data['imunisasiPolioIIIPerempuan'] + $this->data['imunisasiPolioIIILakiLaki'],
            ],
            [
                'Kategori' => 'Imunisasi Polio IV',
                'Perempuan' => $this->data['imunisasiPolioIVPerempuan'],
                'Laki-laki' => $this->data['imunisasiPolioIVLakiLaki'],
                'Total' => $this->data['imunisasiPolioIVPerempuan'] + $this->data['imunisasiPolioIVLakiLaki'],
            ],
            [
                'Kategori' => 'Imunisasi Campak',
                'Perempuan' => $this->data['imunisasiCampakPerempuan'],
                'Laki-laki' => $this->data['imunisasiCampakLakiLaki'],
                'Total' => $this->data['imunisasiCampakPerempuan'] + $this->data['imunisasiCampakLakiLaki'],
            ],
            [
                'Kategori' => 'Imunisasi DPT, Hb Com1',
                'Perempuan' => $this->data['imunisasiHepatitisB1Perempuan'],
                'Laki-laki' => $this->data['imunisasiHepatitisB1LakiLaki'],
                'Total' => $this->data['imunisasiHepatitisB1Perempuan'] + $this->data['imunisasiHepatitisB1LakiLaki'],
            ],
            [
                'Kategori' => 'Imunisasi DPT, Hb Com2',
                'Perempuan' => $this->data['imunisasiHepatitisB2Perempuan'],
                'Laki-laki' => $this->data['imunisasiHepatitisB2LakiLaki'],
                'Total' => $this->data['imunisasiHepatitisB2Perempuan'] + $this->data['imunisasiHepatitisB2LakiLaki'],
            ],
            [
                'Kategori' => 'Imunisasi DPT, Hb Com1',
                'Perempuan' => $this->data['imunisasiHepatitisB3Perempuan'],
                'Laki-laki' => $this->data['imunisasiHepatitisB3LakiLaki'],
                'Total' => $this->data['imunisasiHepatitisB3Perempuan'] + $this->data['imunisasiHepatitisB3LakiLaki'],
            ],
        ];
    }

}
