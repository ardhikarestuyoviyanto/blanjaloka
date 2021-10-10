<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFacebookidGoogleidToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        # Tambah kolom facebook_id dan google_id di tabel users
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('google_id', 200)->nullable();
            $table->string('facebook_id', 200)->nullable();
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
