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
            'nik' => '747202140801312',
            'nama'=> 'Afra', 
            'nama_ibu'=>'Nanna',
            'jenis_kelamin'=>'laki-laki',
            'tanggal_lahir' => '2020-08-14',
            'berat_badan_lahir'=> 3,
            'tinggi_badan_lahir'=> 70, 
            'alamat'=>'jl bonsay', 
            'no_telpon'=>'082193671786', 
            'password'=> Hash::make('afra123'), 
        ]);
    }
}
