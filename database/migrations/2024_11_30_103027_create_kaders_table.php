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
        Schema::create('kaders', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique(); // NIK dengan panjang maksimal 16 digit
            $table->string('nama', 100); // Nama dengan panjang maksimal 100 karakter
            $table->string('jabatan', 50); // Jabatan dengan panjang maksimal 50 karakter
            $table->text('alamat'); // Alamat tanpa panjang maksimum
            $table->string('foto', 255)->nullable(); // Foto (URL atau path) dapat kosong
            $table->string('password'); // Password terenkripsi
            $table->boolean('is_admin')->default(false); // Default bukan admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kaders');
    }
};
