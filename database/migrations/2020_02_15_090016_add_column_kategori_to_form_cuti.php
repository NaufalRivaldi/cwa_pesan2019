<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnKategoriToFormCuti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_cuti', function (Blueprint $table) {
            $table->unsignedInteger('idKategori');

            $table->foreign('idKategori')
                    ->references('id')
                    ->on('kategori_cuti')
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
