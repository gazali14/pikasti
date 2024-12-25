<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFotoColumnInDokumentasisTable extends Migration
{
    public function up()
    {
        Schema::table('dokumentasis', function (Blueprint $table) {
            $table->json('foto')->change(); // Ubah kolom 'foto' menjadi tipe JSON
        });
    }

    public function down()
    {
        Schema::table('dokumentasis', function (Blueprint $table) {
            $table->text('foto')->change(); // Ubah kembali jika rollback diperlukan
        });
    }
}
