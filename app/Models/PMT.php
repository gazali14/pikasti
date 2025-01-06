<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PMT extends Model
{
    use HasFactory;

    protected $table = 'pmts'; //nama tabel di database

    protected $fillable = [
        'nik_bayi',
        'tanggal',
        'pmt',
    ];
}
