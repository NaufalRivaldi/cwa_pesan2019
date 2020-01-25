<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormPeminjamanSaranaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_peminjaman_sarana', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', [1,2,3]);
            $table->unsignedInteger('userId');
            $table->timestamps();

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
        Schema::dropIfExists('form_peminjaman_sarana');
    }
}
