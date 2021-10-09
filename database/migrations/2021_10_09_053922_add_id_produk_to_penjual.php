<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdProdukToPenjual extends Migration
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
            $table->unsignedBigInteger('id_pasar');
            $table->foreign('id_pasar')->references('id_pasar')->on('pasar')->onDelete('cascade')->onUpdate('cascade');
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
            $table->dropForeign(['id_pasar']);
            $table->dropColumn(['id_pasar']);
        });
    }
}
