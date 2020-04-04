<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkkPenilaianEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkk_penilaian_employee', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('t');
            $table->integer('ip');
            $table->integer('ik');
            $table->integer('p');
            $table->double('total');
            $table->unsignedInteger('karyawanId');
            $table->unsignedInteger('periodeId');
            $table->timestamps();

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
        Schema::dropIfExists('pkk_penilaian_employee');
    }
}
