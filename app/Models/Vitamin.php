<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vitamin extends Model
{
    use HasFactory;

    protected $table = 'vitamins';

    protected $fillable = ['nama_bayi','vitamin','id_bayi', 'id_kegiatan'];

    /**
     * Relasi ke model Bayi
     */
    public function bayis()
    {
        return $this->belongsTo(Bayi::class, 'id_bayi'); 
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_kegiatan');
    }

}
