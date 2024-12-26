<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kehadiran_kaders', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nama_kader');
            $table->boolean('kehadiran');
            $table->string('jenis_kelamin');
            $table->date('tanggal');
            $table->string('waktu');
            $table->foreignId('id_kegiatan')->constrained()->onDelete('cascade'); // Assuming 'id_kegiatan' is a foreign key
        });
    }

    public function down()
    {
        Schema::dropIfExists('kehadiran_kaders');
    }

};
