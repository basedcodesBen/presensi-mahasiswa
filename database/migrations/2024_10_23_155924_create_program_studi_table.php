<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramStudiTable extends Migration
{
    public function up()
    {
        Schema::create('program_studi', function (Blueprint $table) {
            $table->string('id', 2)->primary();
            $table->string('program_studi', 45);
            $table->string('fakultas_id', 2);
            $table->foreign('fakultas_id')->references('id')->on('fakultas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('program_studi');
    }
}
