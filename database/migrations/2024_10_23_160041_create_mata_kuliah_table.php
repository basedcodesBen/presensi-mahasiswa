<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataKuliahTable extends Migration
{
    public function up()
    {
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->id();
            $table->string('kode_matakuliah', 25);
            $table->string('nama_matakuliah', 45);
            $table->integer('sks');
            $table->unsignedBigInteger('program_studi_id');
            $table->foreign('program_studi_id')->references('id')->on('program_studi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mata_kuliah');
    }
}
