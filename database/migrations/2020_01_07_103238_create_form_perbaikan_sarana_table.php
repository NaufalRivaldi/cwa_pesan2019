<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormPerbaikanSaranaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_perbaikan_sarana', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tglPengajuan');
            $table->date('tglSelesai');
            $table->text('permintaan');
            $table->text('alasan');
            $table->enum('status', ['1', '2', '3', '4']);
            $table->text('keterangan');
            $table->unsignedInteger('userId');
            $table->timestamps();

            // fk
            $table->foreign('userId')
                    ->references('id')
                    ->on('user')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_perbaikan_sarana');
    }
}
