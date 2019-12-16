<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValidasiFormDesainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validasi_form_desain', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('form_pengajuan_desain_id');
            $table->unsignedInteger('user_id');
            $table->enum('stat', ['1', '2', '3', '4', '5']);
            $table->text('keterangan');
            $table->timestamps();

            // fk
            $table->foreign('form_pengajuan_desain_id')
                    ->references('id')
                    ->on('form_pengajuan_desain')
                    ->onUpdate('cascade');

            $table->foreign('user_id')
                    ->references('id')
                    ->on('user')
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
        Schema::dropIfExists('validasi_form_desain');
    }
}
