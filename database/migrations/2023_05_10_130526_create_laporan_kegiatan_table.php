<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_kegiatan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('id_karyawan');
            $table->string('kegiatan', 255);
            $table->unsignedInteger('id_proyek');
            $table->string('ruas', 255);
            $table->date('start');
            $table->date('target');
            $table->date('updated_at');
            $table->date('created_at');

            $table->foreign('id_karyawan')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_proyek')->references('id')->on('proyek')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_kegiatan');
    }
};
