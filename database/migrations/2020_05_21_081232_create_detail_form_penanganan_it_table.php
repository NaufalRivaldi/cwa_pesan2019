<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailFormPenangananItTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_form_penanganan_it', function (Blueprint $table) {
            $table->increments('id');
            $table->text('keterangan');
            $table->unsignedInteger('karyawanId');
            $table->unsignedInteger('formPenangananItId');
            $table->timestamps();

            // fk
            $table->foreign('karyawanId')
                    ->references('id')
                    ->on('karyawan_all')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('formPenangananItId')
                    ->references('id')
                    ->on('form_penanganan_it')
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
        Schema::dropIfExists('detail_form_penanganan_it');
    }
}
