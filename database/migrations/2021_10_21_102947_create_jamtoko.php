<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJamtoko extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jamtoko', function (Blueprint $table) {
            $table->id('id_jamtoko');
            $table->string('catatan', 500)->nullable();
            $table->string('hari', 100)->nullable();
            $table->string('buka', 100)->nullable();
            $table->string('tutup', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jamtoko');
    }
}
