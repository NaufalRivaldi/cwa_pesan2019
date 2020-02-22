<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnKaryawanIdToFormCuti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_cuti', function (Blueprint $table) {
            $table->unsignedInteger('idKaryawanAll');

            $table->foreign('idKaryawanAll')
                    ->references('id')
                    ->on('karyawan_all')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_cuti', function (Blueprint $table) {
            //
        });
    }
}
