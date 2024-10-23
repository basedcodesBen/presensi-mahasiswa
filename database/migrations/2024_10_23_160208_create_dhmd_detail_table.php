<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDhmdDetailTable extends Migration
{
    public function up()
    {
        Schema::create('dhmd_detail', function (Blueprint $table) {
            $table->unsignedBigInteger('dhmd_idpresensi');
            $table->string('user_nik', 7);
            $table->string('status', 100);
            $table->foreign('dhmd_idpresensi')->references('idpresensi')->on('dhmd');
            $table->foreign('user_nik')->references('nik')->on('user');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dhmd_detail');
    }
}
