<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Kader extends Authenticatable
{
    use Notifiable;

    // Kolom yang dapat diisi melalui form atau mass assignment
    protected $fillable = [
        'nik',
        'nama',
        'jabatan',
        'alamat',
        'foto',
        'password',
        'is_admin',
    ];

    // Kolom yang disembunyikan saat model diubah menjadi array atau JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Menggunakan 'nik' sebagai username untuk autentikasi.
     *
     * @return string
     */
    public function getAuthIdentifierName(){
        return 'nik'; // Pastikan ini sesuai dengan field yang digunakan untuk login
    }

    public function username()
    {
        return 'nik';
    }


    /**
     * Mengecek apakah pengguna adalah admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->is_admin;
    }
}
