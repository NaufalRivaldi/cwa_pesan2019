<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifikasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->increments('id');
            $table->text('keterangan');
            $table->string('link', 100);
            $table->enum('stat', ['1', '2']);
            $table->enum('baca', ['1', '2']);
            $table->unsignedInteger('user_id');
            $table->timestamps();

            // FK
            $table->foreign('user_id')
                    ->references('id')
                    ->on('user')
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
        Schema::dropIfExists('notifikasi');
    }
}
