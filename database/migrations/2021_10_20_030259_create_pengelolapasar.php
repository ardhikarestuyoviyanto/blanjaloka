<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengelolapasar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengelolapasar', function (Blueprint $table) {
            $table->id('id_pengelolapasar');
            $table->string('nama', 200);
            $table->string('nip', 200);
            $table->string('email', 200);
            $table->string('password', 250);
            $table->string('jabatan', 200);
            $table->string('role', 100);
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
        Schema::dropIfExists('pengelolapasar');
    }
}
