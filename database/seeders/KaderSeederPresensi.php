<?php

namespace Database\Seeders;

// use App\Models\Kader;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Kader;

class KaderSeederPresensi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kader::create([
            'nik' => '747202140801002',
            'nama'=> 'Ahmad', 
            'jabatan'=>'admin', 
            'alamat'=>'jl bonasut', 
            'foto'=>'img/login-pict.png', 
            'password'=> Hash::make('ahmad123'), 
            'is_admin' => true
        ]);

        Kader::create([
            'nik' => '7472021408010005',
            'nama' => 'Gaza',
            'jabatan' => 'Sekretaris',
            'alamat' => 'Jl. Pondok Bambu, RT 14/RW 7',
            'foto' => 'img/login-pict.png',
            'password' => Hash::make('laodegazali14'),
            'is_admin' => false,
        ]);
    }
}
