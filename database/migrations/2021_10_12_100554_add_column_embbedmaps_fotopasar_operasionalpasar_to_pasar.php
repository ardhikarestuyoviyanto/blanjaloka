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
            $table->string('embbed_maps', 200)->nullable();
            $table->string('foto_pasar', 200)->nullable();
            $table->string('operasional_pasar')->nullable();
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
    }
}
