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
        Schema::create('vitamins', function (Blueprint $table) {
            $table->id();
            $table->string('nik_bayi');
            $table->date('tanggal'); // Kolom tanggal
            $table->string('vitamin',100);
            $table->timestamps();

             
            // Relasi ke tabel bayi
            $table->foreign('nik_bayi')->references('nik')->on('bayis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vitamins');
    }
};
