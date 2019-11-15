<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryJualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_jual', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kd_sales', 10);
            $table->date('tgl');
            $table->string('divisi', 10);
            $table->string('kd_barang', 20);
            $table->string('jml', 10);
            $table->integer('skor');
            $table->string('brt', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_jual');
    }
}
