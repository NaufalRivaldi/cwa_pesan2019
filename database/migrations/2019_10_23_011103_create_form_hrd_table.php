<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormHrdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_hrd', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('tgl_a');
            $table->dateTime('tgl_b');
            $table->text('keterangan');
            $table->enum('stat', ['1', '2', '3', '4']);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('karyawan_all_id');
            $table->timestamps();

            // FK
            $table->foreign('user_id')
                    ->references('id')
                    ->on('user')
                    ->onUpdate('cascade');

            $table->foreign('karyawan_all_id')
                    ->references('id')
                    ->on('karyawan_all')
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
        Schema::dropIfExists('form_hrd');
    }
}
