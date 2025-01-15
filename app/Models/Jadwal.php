<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals';

    protected $fillable = [
        'nama_kegiatan',
        'tanggal',
        'waktu',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
    }

    public function vitamins()
    {
        return $this->hasMany(Vitamin::class, 'id_kegiatan');
    }
}
