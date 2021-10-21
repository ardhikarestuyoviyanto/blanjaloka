<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriver extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver', function (Blueprint $table) {
            $table->id('id_driver');
            $table->string('nama_driver', 200);
            $table->string('no_telp', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->string('tgl_lahir', 100)->nullable();
            $table->string('no_ktp', 300)->nullable();
            $table->string('kendaraan', 300)->nullable();
            $table->string('foto_stnk', 400)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver');
    }
}
