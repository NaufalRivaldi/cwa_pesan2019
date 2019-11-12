<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormPenangananItTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_penanganan_it', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl');
            $table->string('masalah', 150);
            $table->text('penyelesaian');
            $table->enum('stat', ['1', '2']);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('karyawan_all_id');
            $table->timestamps();

            // fk
            $table->foreign('user_id')
                    ->references('id')
                    ->on('user')
                    ->onDelete('cascade');
            
            $table->foreign('karyawan_all_id')
                    ->references('id')
                    ->on('karyawan_all')
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
        Schema::dropIfExists('form_penanganan_it');
    }
}
