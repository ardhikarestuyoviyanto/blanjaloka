<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemda', function (Blueprint $table) {
            $table->id('id_pemda');
            $table->string('nama_pemda', 200);
            $table->text('alamat_pemda')->nullable();
            $table->string('no_telp', 200)->nullable();
            $table->string('email', 300);
            $table->string('noktp', 200)->nullable();
            $table->string('password', 300);
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
        Schema::dropIfExists('pemda');
    }
}
