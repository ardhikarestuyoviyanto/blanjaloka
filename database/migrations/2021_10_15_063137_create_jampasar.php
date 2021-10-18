<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJampasar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jampasar', function (Blueprint $table) {
            $table->id('id_jampasar');
            $table->string('catatan', 200)->nullable();
            $table->string('hari', 100);
            $table->time('buka');
            $table->time('tutup');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jampasar');
    }
}
