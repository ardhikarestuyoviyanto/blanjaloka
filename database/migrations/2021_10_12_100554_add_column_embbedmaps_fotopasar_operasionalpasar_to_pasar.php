<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnEmbbedmapsFotopasarOperasionalpasarToPasar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pasar', function (Blueprint $table) {
            $table->text('embbed_maps')->nullable();
            $table->text('foto_pasar')->nullable();
            $table->mediumText('deskripsi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('pasar', function (Blueprint $table) {
            $table->dropColumn(['embbed_maps', 'foto_pasar', 'deskripsi']);
        });
    
    }
}
