<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkkPeriodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkk_periode', function (Blueprint $table) {
            $table->increments('id');
            $table->string('namaPeriode');
            $table->date('tglMulai');
            $table->date('tglSelesai');
            $table->enum('status', ['1','2']);
            $table->enum('kategori', ['1','2','3']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pkk_periode');
    }
}
