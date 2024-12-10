<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KehadiranKader extends Model
{
    use HasFactory;

    protected $table = 'kehadiran_kader';

    // Kolom yang dapat diisi
    protected $fillable = [
        'nik', 
        'nama_kader', 
        'kehadiran', 
        'jenis_kelamin', 
        'tanggal', 
        'waktu', 
        'id_kegiatan'
    ];
    
    /**
     * Relasi ke model Kegiatan
     */
    public function jadwals()
    {
        return $this->belongsTo(Jadwal::class, 'id_kegiatan');
    }
}
