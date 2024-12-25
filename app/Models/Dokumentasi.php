<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    use HasFactory;

    protected $table = 'dokumentasis';

    protected $fillable = [
        'nama_kegiatan',
        'deskripsi',
        'foto',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Mutator untuk mengubah JSON foto menjadi array
    public function getFotoAttribute($value)
    {
        return json_decode($value, true); // Ubah JSON menjadi array
    }

    public function setFotoAttribute($value)
    {
        $this->attributes['foto'] = json_encode($value); // Simpan sebagai JSON
    }
}


