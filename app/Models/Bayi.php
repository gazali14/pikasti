<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bayi extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $table = 'bayis';

    public function kms()
    {
        return $this->hasMany(KMS::class, 'nik_bayi');
    }

    protected $fillable = [
        'nik', 'nama', 'nama_ibu', 'jenis_kelamin', 'tanggal_lahir', 'berat_badan_lahir', 'tinggi_badan_lahir', 'alamat', 'no_telpon', 'password',
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

    /**
     * Relasi ke model Vitamin
     */
    public function vitamins()
    {
        return $this->hasMany(Vitamin::class, 'nik_bayi');
    }

    public function konsultasis()
    {
        return $this->hasMany(Konsultasi::class, 'id_bayi');
    }
}


