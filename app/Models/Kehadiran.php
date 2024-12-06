<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $table = 'kehadiran';

    // Kolom yang dapat diisi
    protected $fillable = [
        'nik', 
        'nama_bayi', 
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
