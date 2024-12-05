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
            'nik' => '082167889911',
            'nama'=> 'Katak', 
            'jabatan'=>'admin', 
            'alamat'=>'jl bonasut', 
            'foto'=>'img/ahmad.png', 
            'password'=> Hash::make('katak123'), 
            'is_admin' => true

        ]);
    }
}
