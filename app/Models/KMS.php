<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KMS extends Model
{
    use HasFactory;

    protected $table = 'kms'; // Nama tabel di database

    // Properti yang dapat diisi
    protected $fillable = [
        'nik_bayi',
        'tanggal',
        'tinggi_badan',
        'berat_badan',
        'imunisasi',
        'kategori',
    ];

     // Define the relationship between KMS and Bayi
    public function bayi()
    {
        return $this->belongsTo(Bayi::class, 'nik_bayi', 'nik');
    }
}