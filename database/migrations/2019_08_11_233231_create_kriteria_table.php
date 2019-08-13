<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kriteria', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rule_name', 50);
            $table->string('kd_barang', 10);
            $table->string('kd_merk', 10);
            $table->string('kd_golongan', 10);
            $table->string('kd_satuan', 10);
            $table->string('kd_jenis', 10);
            $table->integer('skor');
            $table->enum('stat', ['1', '2']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kriteria');
    }
}
