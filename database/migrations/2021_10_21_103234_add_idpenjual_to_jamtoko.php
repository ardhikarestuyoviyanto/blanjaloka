<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdpenjualToJamtoko extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jamtoko', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('id_penjual');
            $table->foreign('id_penjual')->references('id_penjual')->on('penjual')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jamtoko', function (Blueprint $table) {
            //
            $table->dropForeign('id_penjual');
            $table->dropColumn('id_penjual');
        });
    }
}
