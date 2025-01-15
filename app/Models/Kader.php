<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Kader extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'nik',
        'nama',
        'jabatan',
        'alamat',
        'foto',
        'password',
        'is_admin',
    ];
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
        return 'nik';
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
