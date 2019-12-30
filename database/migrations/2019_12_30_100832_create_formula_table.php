<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormulaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formula', function (Blueprint $table) {
            $table->increments('id');
            $table->string('color', 50);
            $table->unsignedInteger('merkId');

            // fk
            $table->foreign('merkId')
                    ->references('id')
                    ->on('merk')
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
        Schema::dropIfExists('formula');
    }
}
