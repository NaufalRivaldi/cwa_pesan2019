<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSethrdKategoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sethrd_kategori', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kategori_fhrd_id');
            $table->unsignedInteger('form_hrd_id');
            $table->timestamps();

            // fk
            $table->foreign('kategori_fhrd_id')
                    ->references('id')
                    ->on('kategori_fhrd')
                    ->onUpdate('cascade');

            $table->foreign('form_hrd_id')
                    ->references('id')
                    ->on('form_hrd')
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
        Schema::dropIfExists('sethrd_kategori');
    }
}
