<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDhmdTable extends Migration
{
    public function up()
    {
        Schema::create('dhmd', function (Blueprint $table) {
            $table->id('idpresensi');
            $table->dateTime('tanggal');
            $table->unsignedBigInteger('id_matakuliah');
            $table->integer('pertemuan');
            $table->foreign('id_matakuliah')->references('id')->on('mata_kuliah');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dhmd');
    }
}
