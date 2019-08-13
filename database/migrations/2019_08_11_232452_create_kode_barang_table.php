<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKodeBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kode_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mrbr', 10);
            $table->string('glbr', 10);
            $table->string('kmbr', 10);
            $table->string('jnbr', 10);
            $table->string('kdbr', 10);
            $table->string('nmbr', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kode_barang');
    }
}
