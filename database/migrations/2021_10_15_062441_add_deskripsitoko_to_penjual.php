<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeskripsitokoToPenjual extends Migration
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
            $table->string('deskripsi_toko', 500)->nullable();
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
            $table->dropColumn('deskripsi_toko');
        });
    }
}
