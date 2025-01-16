<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bayi;
use Illuminate\Support\Facades\Hash;

class BayiSeeder extends Seeder
{
    public function run(): void
    {
        Bayi::create([
            'nik' => '3175045202220002',
            'nama' => 'Abagail Zevanya Harefa',
            'nama_ibu' => 'Marni Hati W',
            'tanggal_lahir' => '2022-02-27',
            'jenis_kelamin' => 'Perempuan',
            'berat_badan_lahir' => 3.0,
            'tinggi_badan_lahir' => 50,
            'alamat' => 'Jl. SMP 135',
            'no_telpon' => null,
            'password' => Hash::make('Abagail123'),
        ]);

        Bayi::create([
            'nik' => '3175076605230004',
            'nama' => 'Alifa Zea Amanda',
            'nama_ibu' => 'Isma Yetut',
            'tanggal_lahir' => '2023-05-26',
            'jenis_kelamin' => 'Perempuan',
            'berat_badan_lahir' => 3.0,
            'tinggi_badan_lahir' => 50,
            'alamat' => 'Jl. Poncol',
            'no_telpon' => null,
            'password' => Hash::make('Alifa123'),
        ]);

        Bayi::create([
            'nik' => '3175047509230001',
            'nama' => 'Aisha Hafsiya',
            'nama_ibu' => 'Femy Rahmawati',
            'tanggal_lahir' => '2023-09-05',
            'jenis_kelamin' => 'Perempuan',
            'berat_badan_lahir' => 3.0,
            'tinggi_badan_lahir' => 50,
            'alamat' => 'Jl. Poncol Raya',
            'no_telpon' => null,
            'password' => Hash::make('Aisha123'),
        ]);

        Bayi::create([
            'nik' => '3175072009190008',
            'nama' => 'Abizar Al Ghifari M',
            'nama_ibu' => 'Ratna Trisnowati',
            'tanggal_lahir' => '2019-09-20',
            'jenis_kelamin' => 'Laki-Laki',
            'berat_badan_lahir' => 3.0,
            'tinggi_badan_lahir' => 50,
            'alamat' => 'Jl. SMP 135',
            'no_telpon' => null,
            'password' => Hash::make('Abizar123'),
        ]);

        Bayi::create([
            'nik' => '3175072006190006',
            'nama' => 'Adzan Zikra Fadilah',
            'nama_ibu' => 'Sugi / Mustika',
            'tanggal_lahir' => '2019-06-20',
            'jenis_kelamin' => 'Laki-Laki',
            'berat_badan_lahir' => 3.0,
            'tinggi_badan_lahir' => 50,
            'alamat' => 'Jl. SMP 135',
            'no_telpon' => null,
            'password' => Hash::make('Adzan123'),
        ]);

        Bayi::create([
            'nik' => '3175031505220007',
            'nama' => 'Adnan Zayyad Al Hannan',
            'nama_ibu' => 'Sarifta',
            'tanggal_lahir' => '2022-05-15',
            'jenis_kelamin' => 'Laki-Laki',
            'berat_badan_lahir' => 3.0,
            'tinggi_badan_lahir' => 50,
            'alamat' => 'Pondok Bambu',
            'no_telpon' => null,
            'password' => Hash::make('Adnan123'),
        ]);

        Bayi::create([
            'nik' => '3175047012300010',
            'nama' => 'Adreena Rayya AB',
            'nama_ibu' => 'Atikah',
            'tanggal_lahir' => '2023-01-07',
            'jenis_kelamin' => 'Perempuan',
            'berat_badan_lahir' => 3.0,
            'tinggi_badan_lahir' => 50,
            'alamat' => 'Jl. SMP 135',
            'no_telpon' => null,
            'password' => Hash::make('Adreena123'),
        ]);

        Bayi::create([
            'nik' => '3175074062100011',
            'nama' => 'Ahmad Rezal Arasy',
            'nama_ibu' => 'Eva Rusdiana / Iqbal Pratama',
            'tanggal_lahir' => '2021-06-04',
            'jenis_kelamin' => 'Laki-Laki',
            'berat_badan_lahir' => 3.0,
            'tinggi_badan_lahir' => 50,
            'alamat' => 'Jl. SMP 135 C/6',
            'no_telpon' => null,
            'password' => Hash::make('Ahmad123'),
        ]);

        Bayi::create([
            'nik' => '3175075103190016',
            'nama' => 'Aira Tama Putri S',
            'nama_ibu' => 'Gama Putra',
            'tanggal_lahir' => '2019-03-11',
            'jenis_kelamin' => 'Perempuan',
            'berat_badan_lahir' => 3.0,
            'tinggi_badan_lahir' => 50,
            'alamat' => 'Kompl Statistik',
            'no_telpon' => null,
            'password' => Hash::make('Aira123'),
        ]);

        Bayi::create([
            'nik' => '3175074108210001',
            'nama' => 'Aisyah Al-Aqila',
            'nama_ibu' => 'Siti Muhajaroh',
            'tanggal_lahir' => '2021-08-01',
            'jenis_kelamin' => 'Perempuan',
            'berat_badan_lahir' => 3.0,
            'tinggi_badan_lahir' => 50,
            'alamat' => 'Pondok Bambu',
            'no_telpon' => null,
            'password' => Hash::make('Aisyah123'),
        ]);

        Bayi::create([
            'nik' => '3175071307220005',
            'nama' => 'Akhmar Nizama Sukandar',
            'nama_ibu' => 'Nimas',
            'tanggal_lahir' => '2022-07-13',
            'jenis_kelamin' => 'Laki-Laki',
            'berat_badan_lahir' => 3.0,
            'tinggi_badan_lahir' => 50,
            'alamat' => 'Pondok Bambu',
            'no_telpon' => null,
            'password' => Hash::make('Akhmar123'),
        ]);

        Bayi::create([
            'nik' => '3175070407210008',
            'nama' => 'Aksara Nizam Ariatama',
            'nama_ibu' => 'Ari Wibowo / Tri Sulastri',
            'tanggal_lahir' => '2021-07-04',
            'jenis_kelamin' => 'Laki-Laki',
            'berat_badan_lahir' => 3.0,
            'tinggi_badan_lahir' => 50,
            'alamat' => 'Jl. SMP 135 No. B/46',
            'no_telpon' => null,
            'password' => Hash::make('Aksara123'),
        ]);

        Bayi::create([
            'nik' => '3175077812220001',
            'nama' => 'Alena Desya P',
            'nama_ibu' => 'Supiyani',
            'tanggal_lahir' => '2022-12-08',
            'jenis_kelamin' => 'Perempuan',
            'berat_badan_lahir' => 3.0,
            'tinggi_badan_lahir' => 50,
            'alamat' => 'Jl. SMP 135',
            'no_telpon' => null,
            'password' => Hash::make('Alena123'),
        ]);
    }
}
