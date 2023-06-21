<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_level', 50);
            $table->date('updated_at');
            $table->date('created_at');
        });

          DB::table('level')->insert([
            ['id' => 1, 'nama_level' => 'admin', 'updated_at' => now(), 'created_at' => now()],
            ['id' => 2, 'nama_level' => 'karyawan', 'updated_at' => now(), 'created_at' => now()],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('level');
    }
};
