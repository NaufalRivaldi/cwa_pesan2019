<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkkDetailIndikatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkk_detailIndikator', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('detailPenilaianId');
            $table->unsignedInteger('indikatorId');
            $table->enum('nilai', ['1','2','3','4','5']);

            $table->foreign('detailPenilaianId')
                    ->references('id')
                    ->on('pkk_detailPenilaian')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('indikatorId')
                    ->references('id')
                    ->on('pkk_indikator')
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
        Schema::dropIfExists('pkk_detail_indikator');
    }
}
