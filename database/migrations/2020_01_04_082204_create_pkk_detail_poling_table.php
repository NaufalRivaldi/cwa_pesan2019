<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkkDetailPolingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkk_detailPoling', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('polingId');
            $table->unsignedInteger('karyawanId');

            $table->foreign('polingId')
                    ->references('id')
                    ->on('pkk_poling')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('karyawanId')
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
        Schema::dropIfExists('pkk_detail_poling');
    }
}
