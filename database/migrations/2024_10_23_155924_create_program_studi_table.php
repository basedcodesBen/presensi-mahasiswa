<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramStudiTable extends Migration
{
    public function up()
    {
        Schema::create('program_studi', function (Blueprint $table) {
            $table->id();
            $table->string('program_studi', 45);
            $table->unsignedBigInteger('fakultas_id');
            $table->foreign('fakultas_id')->references('id')->on('fakultas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('program_studi');
    }
}
