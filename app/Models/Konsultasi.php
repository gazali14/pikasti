<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;

    protected $table = 'konsultasis'; // Nama tabel di database

    protected $fillable = [
        'nik_bayi',
        'tanggal',
        'konsultasi', //ini catatan konsultasi atau deskripsi atau keterangan
    ];

}