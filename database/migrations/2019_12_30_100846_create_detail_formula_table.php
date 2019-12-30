<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailFormulaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_formula', function (Blueprint $table) {
            $table->increments('id');
            $table->double('nilai');
            $table->unsignedInteger('formulaId');
            $table->unsignedInteger('mixingId');

            // fk
            $table->foreign('formulaId')
                    ->references('id')
                    ->on('formula')
                    ->onUpdate('cascade');

            $table->foreign('mixingId')
                    ->references('id')
                    ->on('mixing')
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
        Schema::dropIfExists('detail_formula');
    }
}
