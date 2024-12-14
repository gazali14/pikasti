<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKehadiranKadersTable extends Migration
{
    public function up()
    {
        Schema::table('kehadiran_kader', function (Blueprint $table) {
            $table->string('nik');
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
        Schema::table('kehadiran_kader', function (Blueprint $table) {
            $table->dropColumn(['nik', 'nama_kader', 'kehadiran', 'jenis_kelamin', 'tanggal', 'waktu', 'id_kegiatan']);
        });
    }

}
