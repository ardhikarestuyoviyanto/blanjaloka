<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFotoprofilJeniskelaminTglLahirToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('fotoprofil', 400)->nullable();
            $table->string('jeniskelamin', 30)->nullable();
            $table->string('tgl_lahir', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn(['fotoprofil', 'jeniskelamin', 'tgl_lahir']);
        });
    }
}
