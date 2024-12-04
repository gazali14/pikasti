<?php

namespace Database\Seeders;

use App\Models\Kader;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kader::create([
            'nik' => '082212346753',
            'nama'=> 'Joni', 
            'jabatan'=>'admin', 
            'alamat'=>'jl bonasut', 
            'foto'=>'img/login-pict.png', 
            'password'=> Hash::make('jonikubesar'), 
            'is_admin' => true
        ]);

        Kader::create([
            'nik' => '082167889912',
            'nama' => 'Siti',
            'jabatan' => 'Sekretaris',
            'alamat' => 'Jl. Pondok Bambu, RT 14/RW 7',
            'foto' => 'img/login-pict.png',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);
    }
}
