<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mata_kuliah_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('matkul_id');
            $table->foreign('matkul_id')->references('id')->on('mata_kuliah');
            $table->string('user_nik', 7);
            $table->foreign('user_nik')->references('nik')->on('users');
            $table->string('kelas', 1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mata_kuliah');
    }
};