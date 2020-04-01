<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormCuti2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_cuti', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('karyawanId');
            $table->unsignedInteger('userId');
            $table->enum('status', ['1','2','3','4']);
            $table->timestamps();            

            $table->foreign('karyawanId')
                    ->references('id')
                    ->on('karyawan_all')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('userId')
                    ->references('id')
                    ->on('user')
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
        Schema::dropIfExists('form_cuti_2');
    }
}
