<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDkbsDetailTable extends Migration
{
    public function up()
    {
        Schema::create('dkbs_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dkbs_id');
            $table->foreign('dkbs_id')->references('id')->on('dkbs');
            $table->unsignedBigInteger('id_matakuliah');
            $table->foreign('id_matakuliah')->references('id')->on('mata_kuliah_detail');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dkbs_detail');
    }
}
