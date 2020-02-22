<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailFormCutiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_form_cuti', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idCuti');
            $table->date('tanggalCuti');
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('idCuti')
                    ->references('id')
                    ->on('form_cuti')
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
        Schema::dropIfExists('detail_form_cuti');
    }
}
