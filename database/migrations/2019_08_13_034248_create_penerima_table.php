<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenerimaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerima', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pesan_id')->nullable();
            $table->unsignedInteger('users_id')->nullable();
            $table->timestamps();

            // fk
            $table->foreign('pesan_id')
                    ->references('id')
                    ->on('pesan')
                    ->onUpdate('cascade');
            
            $table->foreign('users_id')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExists('penerima');
    }
}
