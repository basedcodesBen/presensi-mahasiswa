<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataKuliahTable extends Migration
{
    public function up()
    {
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->string('id_matakuliah', 25)->primary();
            $table->string('nama_matakuliah', 45);
            $table->char('kelas', 1);
            $table->integer('sks');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mata_kuliah');
    }
}
