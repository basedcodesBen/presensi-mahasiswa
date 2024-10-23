<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->string('nik', 7)->primary();
            $table->string('nama', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->unsignedBigInteger('role_id');
            $table->string('program_studi_id', 2);
            $table->foreign('role_id')->references('id')->on('role');
            $table->foreign('program_studi_id')->references('id')->on('program_studi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user');
    }
}
