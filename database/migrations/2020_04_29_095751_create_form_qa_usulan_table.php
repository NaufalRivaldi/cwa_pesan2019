<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormQaUsulanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_qa_usulan', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('kategori', ['1', '2']);
            $table->text('keterangan');
            $table->unsignedInteger('karyawanId');
            $table->timestamps();

            $table->foreign('karyawanId')
                    ->references('id')
                    ->on('karyawan_all')
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
        Schema::dropIfExists('form_qa_usulan');
    }
}
