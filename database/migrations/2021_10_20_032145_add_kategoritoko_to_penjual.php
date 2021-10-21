<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKategoritokoToPenjual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penjual', function (Blueprint $table) {
            //
            $table->string('foto_toko', 500)->nullable();
            $table->string('no_toko', 200)->nullable();
            $table->text('embbed_maps_toko')->nullable();
            $table->text('alamat_toko')->nullable();
            $table->string('no_ktp', 300)->nullable();
            $table->string('no_rekening', 300)->nullable();
            $table->string('nama_bank', 200)->nullable();
            $table->string('foto_ktp', 300)->nullable();
            $table->string('foto_penjual_ktp', 300)->nullable();
            $table->unsignedBigInteger('id_kategoritoko')->nullable();

            $table->foreign('id_kategoritoko')->references('id_kategoritoko')->on('kategoritoko')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penjual', function (Blueprint $table) {
            //
        });
    }
}
