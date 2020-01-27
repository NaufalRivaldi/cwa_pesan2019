<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailFormPeminjamanSaranaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_form_peminjaman_sarana', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl');
            $table->text('keterangan');
            $table->time('pukulA');
            $table->time('pukulB');
            $table->unsignedInteger('formPeminjamanId');
            $table->unsignedInteger('saranaId');

            $table->foreign('formPeminjamanId')
                    ->references('id')
                    ->on('form_peminjaman_sarana')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('saranaId')
                    ->references('id')
                    ->on('sarana')
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
        Schema::dropIfExists('detail_form_peminjaman_sarana');
    }
}
