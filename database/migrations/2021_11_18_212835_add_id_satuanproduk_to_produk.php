<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdSatuanprodukToProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('id_satuanproduk');
            $table->foreign('id_satuanproduk')->references('id_satuanproduk')->on('satuan_produk')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produk', function (Blueprint $table) {
            //
            $table->dropForeign('id_satuanproduk');
            $table->dropColumn('id_satuanproduk');
        });
    }
}
