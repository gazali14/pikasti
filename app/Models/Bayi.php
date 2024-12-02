<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Bayi extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nik', 'nama', 'nama_ibu', 'tanggal_lahir', 'berat_badan_lahir', 'tinggi_badan_lahir', 'alamat', 'no_telpon', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

        // Tambahkan properti ini untuk mengganti default 'email' dengan 'nik'
    public function getAuthIdentifierName()
    {
        return 'nik'; // Gunakan kolom 'nik' untuk autentikasi
    }

    public function username()
    {
        return 'nik';
    }
}
