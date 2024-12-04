<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model ini.
     */
    protected $table = 'jadwals';

    /**
     * Kolom yang dapat diisi melalui mass assignment.
     */
    protected $fillable = [
        'nama_kegiatan',
        'tanggal',
        'waktu',
    ];

    /**
     * Format default untuk kolom tanggal dan waktu.
     */
    protected $casts = [
        'tanggal' => 'date',
    ];
}
