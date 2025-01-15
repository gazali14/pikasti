<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KehadiranKader extends Model
{
    use HasFactory;

    protected $table = 'kehadiran_kaders';
    protected $fillable = [
        'nik', 
        'nama_kader', 
        'kehadiran', 
        'tanggal', 
        'waktu', 
        'id_kegiatan'
    ];
    public function jadwals()
    {
        return $this->belongsTo(Jadwal::class, 'id_kegiatan');
    }
}
