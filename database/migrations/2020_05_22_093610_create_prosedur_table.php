<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProsedurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prosedur', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('file');
            $table->unsignedInteger('departemenId');
            $table->timestamps();

            $table->foreign('departemenId')
                    ->references('id')
                    ->on('departemen')
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
        Schema::dropIfExists('prosedur');
    }
}
