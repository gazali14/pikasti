<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        Jadwal::create([
            'nama_kegiatan' => 'Imunisasi Campak',
            'tanggal' => '2025-01-27',
            'waktu' => '08:00:00',
        ]);

        Jadwal::create([
            'nama_kegiatan' => 'Posyandu Rutin',
            'tanggal' => '2025-02-15',
            'waktu' => '09:00:00',
        ]);

        Jadwal::create([
            'nama_kegiatan' => 'Pemberian Vitamin A',
            'tanggal' => '2025-03-10',
            'waktu' => '10:30:00',
        ]);
    }
}
