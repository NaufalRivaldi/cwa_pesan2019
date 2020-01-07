<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkkDetailKuisionerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkk_detailKuisioner', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('detailPenilaianId');
            $table->unsignedInteger('kuisionerId');
            $table->string('jawaban');

            $table->foreign('detailPenilaianId')
                    ->references('id')
                    ->on('pkk_detailPenilaian')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('kuisionerId')
                    ->references('id')
                    ->on('pkk_kuisioner')
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
        Schema::dropIfExists('pkk_detail_kuisioner');
    }
}
