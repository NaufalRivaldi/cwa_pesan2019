<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkkDetailPenilaianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkk_detailPenilaian', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('penilaianId');
            $table->unsignedInteger('karyawanId');

            $table->foreign('penilaianId')
                    ->references('id')
                    ->on('pkk_penilaian')
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
        Schema::dropIfExists('pkk_detail_penilaian');
    }
}
