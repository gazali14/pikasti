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
            'nik' => '747202140801002',
            'nama'=> 'Ahmad', 
            'jabatan'=>'admin', 
            'alamat'=>'jl bonasut', 
            'foto'=>'img/ahmad.png', 
            'password'=> Hash::make('ahmad123'), 
            'is_admin' => true

        ]);
    }
}
