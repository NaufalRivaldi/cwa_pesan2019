<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnNoRevisiToMasterFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_file', function (Blueprint $table) {
            $table->string('no_form')->unique();
            $table->string('no_revisi');
            $table->date('tgl_terbit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_file', function (Blueprint $table) {
            //
        });
    }
}
