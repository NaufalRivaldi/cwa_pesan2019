<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifikasiCutiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifikasi_cuti', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('detailCutiId');
            $table->unsignedInteger('userId');
            $table->unsignedInteger('karyawanAllId');
            $table->enum('status', ['0','1','2','3','4']);
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('detailCutiId')
                    ->references('id')
                    ->on('detail_form_cuti')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('userId')
                    ->references('id')
                    ->on('user')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('karyawanAllId')
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
        Schema::dropIfExists('verifikasi_cuti');
    }
}
