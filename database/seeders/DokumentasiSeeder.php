<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dokumentasi;

class DokumentasiSeeder extends Seeder
{
    public function run(): void
    {
        Dokumentasi::create([
            'nama_kegiatan' => 'Kegiatan Imunisasi',
            'deskripsi' => 'Kegiatan imunisasi rutin di Posyandu Pikasti.',
            'foto' => 'img/dokumentasi1.jpg',
            'tanggal' => '2025-01-15',
        ]);

        Dokumentasi::create([
            'nama_kegiatan' => 'Kegiatan Penyuluhan',
            'deskripsi' => 'Penyuluhan kesehatan untuk masyarakat.',
            'foto' => 'img/dokumentasi2.jpg',
            'tanggal' => '2025-02-10',
        ]);

        Dokumentasi::create([
            'nama_kegiatan' => 'Kegiatan Makanan Tambahan',
            'deskripsi' => 'Pembagian makanan tambahan untuk anak-anak.',
            'foto' => 'img/dokumentasi3.jpg',
            'tanggal' => '2025-03-05',
        ]);
    }
}
