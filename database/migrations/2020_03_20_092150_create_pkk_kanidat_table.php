<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkkKanidatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkk_kanidat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('poin');
            $table->unsignedInteger('karyawanId');
            $table->unsignedInteger('periodeId');

            // fk
            $table->foreign('karyawanId')
                    ->references('id')
                    ->on('karyawan_all')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('periodeId')
                    ->references('id')
                    ->on('pkk_periode')
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
        Schema::dropIfExists('pkk_kanidat');
    }
}
