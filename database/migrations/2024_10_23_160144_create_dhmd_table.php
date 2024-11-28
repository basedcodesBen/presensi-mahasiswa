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
            $table->string('id_matakuliah', 25);
            $table->integer('pertemuan');
            $table->string('qr_code')->nullable();
            $table->foreign('id_matakuliah')->references('id_matakuliah')->on('mata_kuliah');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dhmd');
        Schema::table('dhmd', function (Blueprint $table) {
            $table->dropColumn('qr_code');
        });
    }
}
