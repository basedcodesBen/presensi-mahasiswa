<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDkbsTable extends Migration
{
    public function up()
    {
        Schema::create('dkbs', function (Blueprint $table) {
            $table->id();
            $table->string('user_nik', 7);
            $table->foreign('user_nik')->references('nik')->on('user');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dkbs');
    }
}
