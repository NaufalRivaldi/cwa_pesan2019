<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValidasiFormhrdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validasi_formhrd', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('form_hrd_id');
            $table->unsignedInteger('user_id');
            $table->enum('stat', ['1', '2', '3', '4']);
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('form_hrd_id')
                    ->references('id')
                    ->on('form_hrd')
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
        Schema::dropIfExists('validasi_formhrd');
    }
}
