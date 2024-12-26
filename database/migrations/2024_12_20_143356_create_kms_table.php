<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKmsTable extends Migration
{
    public function up(): void
    {
        Schema::create('kms', function (Blueprint $table) {
            $table->id(); // Kolom id
            $table->string('nik_bayi', 16); // Mengambil NIK bayi
            $table->date('tanggal'); // Kolom tanggal
            $table->decimal('berat_badan', 5, 2); // Berat badan bayi
            $table->decimal('tinggi_badan', 5, 2); // Tinggi badan bayi
            $table->string('kategori', 35); // Kategori
            $table->timestamps(); // Kolom created_at dan updated_at
            
            // Relasi ke tabel bayi
            $table->foreign('nik_bayi')->references('nik')->on('bayis')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kms');
    }
}
