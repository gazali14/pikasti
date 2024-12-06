<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kehadiran', function (Blueprint $table) {
            $table->id(); //primary key
            $table->string('nik',16);
            $table->string('nama_bayi',100);
            $table->boolean('kehadiran');
            $table->string('jenis_kelamin',10);
            $table->date('tanggal');
            $table->time('waktu');
            $$table->unsignedBigInteger('id_kegiatan'); // Relasi ke tabel kegiatan
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadiran');
    }
};
