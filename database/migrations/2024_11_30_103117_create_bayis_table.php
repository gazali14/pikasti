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
        Schema::create('bayis', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique(); // NIK dengan panjang maksimal 16 digit dan unik
            $table->string('nama', 100); // Nama bayi dengan panjang maksimal 100 karakter
            $table->string('nama_ibu', 100); // Nama ibu dengan panjang maksimal 100 karakter
            $table->date('tanggal_lahir'); // Format tanggal lahir
            $table->unsignedTinyInteger('berat_badan_lahir'); // Berat badan lahir dalam kg (maks 255 kg)
            $table->unsignedTinyInteger('tinggi_badan_lahir'); // Tinggi badan lahir dalam cm (maks 255 cm)
            $table->text('alamat'); // Alamat tanpa batas panjang
            $table->string('no_telpon', 15)->nullable(); // Nomor telepon opsional, maksimal 15 digit
            $table->string('password'); // Password terenkripsi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bayis');
    }
};
