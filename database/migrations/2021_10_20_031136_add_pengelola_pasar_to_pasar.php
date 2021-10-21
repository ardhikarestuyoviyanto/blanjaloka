<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPengelolaPasarToPasar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pasar', function (Blueprint $table) {
            //
            $table->string('no_pasar', 200)->nullable();
            $table->integer('max_lapak')->nullable();
            $table->integer('max_pengunjung')->nullable();
            $table->unsignedBigInteger('id_pengelolapasar')->nullable();
            $table->foreign('id_pengelolapasar')->references('id_pengelolapasar')->on('pengelolapasar')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pasar', function (Blueprint $table) {
            //
            $table->dropForeign('id_pengelolapasar');
            $table->dropColumn(['no_pasar', 'max_lapak', 'max_pengunjung', 'id_pengelolapasar']);
        });
    }
}
