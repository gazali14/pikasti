<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bayi;
use Illuminate\Support\Facades\Hash;

class BayiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bayi::create([
            'nik' => '747202150801413',
            'nama' => 'Bima',
            'nama_ibu' => 'Lina',
            'jenis_kelamin' => 'laki-laki',
            'tanggal_lahir' => '2020-08-15',
            'berat_badan_lahir' => 3.2,
            'tinggi_badan_lahir' => 72,
            'alamat' => 'Jl Cempaka',
            'no_telpon' => '082193671787',
            'password' => Hash::make('bima123'),
        ]);

        Bayi::create([
            'nik' => '747202160801514',
            'nama' => 'Citra',
            'nama_ibu' => 'Maya',
            'jenis_kelamin' => 'perempuan',
            'tanggal_lahir' => '2020-08-16',
            'berat_badan_lahir' => 2.9,
            'tinggi_badan_lahir' => 68,
            'alamat' => 'Jl Dahlia',
            'no_telpon' => '082193671788',
            'password' => Hash::make('citra123'),
        ]);

        Bayi::create([
            'nik' => '747202170801615',
            'nama' => 'Daffa',
            'nama_ibu' => 'Siti',
            'jenis_kelamin' => 'laki-laki',
            'tanggal_lahir' => '2020-08-17',
            'berat_badan_lahir' => 3.1,
            'tinggi_badan_lahir' => 71,
            'alamat' => 'Jl Melati',
            'no_telpon' => '082193671789',
            'password' => Hash::make('daffa123'),
        ]);

        Bayi::create([
            'nik' => '747202180801716',
            'nama' => 'Eka',
            'nama_ibu' => 'Rina',
            'jenis_kelamin' => 'perempuan',
            'tanggal_lahir' => '2020-08-18',
            'berat_badan_lahir' => 3.3,
            'tinggi_badan_lahir' => 73,
            'alamat' => 'Jl Anggrek',
            'no_telpon' => '082193671790',
            'password' => Hash::make('eka123'),
        ]);

        Bayi::create([
            'nik' => '747202190801817',
            'nama' => 'Fikri',
            'nama_ibu' => 'Dewi',
            'jenis_kelamin' => 'laki-laki',
            'tanggal_lahir' => '2020-08-19',
            'berat_badan_lahir' => 3.5,
            'tinggi_badan_lahir' => 74,
            'alamat' => 'Jl Mawar',
            'no_telpon' => '082193671791',
            'password' => Hash::make('fikri123'),
        ]);
    }
}
