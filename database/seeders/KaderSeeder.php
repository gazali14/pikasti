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
            'nik' => 'posyandupikasti1',
            'nama'=> 'Admin 1', 
            'jabatan'=>'Admin', 
            'alamat'=>'Pikasti', 
            'foto'=>'', 
            'password'=> Hash::make('ilovepikasti123'), 
            'is_admin' => true
        ]);

        Kader::create([
            'nik' => 'posyandupikasti2',
            'nama' => 'Admin 2',
            'jabatan' => 'Admin',
            'alamat' => 'Jl. Pondok Bambu, RT 14/RW 7',
            'foto' => '',
            'password' => Hash::make('mencatatbayisehat123'),
            'is_admin' => true,
        ]);
    }
}
