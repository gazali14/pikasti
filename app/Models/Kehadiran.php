<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $table = 'kehadiran';
    protected $fillable = [
        'nik', 
        'nama_bayi', 
        'kehadiran', 
        'jenis_kelamin', 
        'tanggal', 
        'waktu', 
        'id_kegiatan'
    ];

    public function bayis()
    {
        return $this->belongsTo(Bayi::class, 'nik', 'nik');
    }
    public function jadwals()
    {
        return $this->belongsTo(Jadwal::class, 'id_kegiatan');
    }

    
}
