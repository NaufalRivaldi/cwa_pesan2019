<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkkDetailPenilaianEmpolyeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkk_detail_penilaian_empolyee', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nilai');
            $table->unsignedInteger('indikatorId');
            $table->unsignedInteger('penilaianEmployeeId');

            // fk
            $table->foreign('indikatorId')
                    ->references('id')
                    ->on('pkk_indikator')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('penilaianEmployeeId')
                    ->references('id')
                    ->on('pkk_penilaian_employee')
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
        Schema::dropIfExists('pkk_detail_penilaian_empolyee');
    }
}
