<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileAttachPengumumanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_attach_pengumuman', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 50);
            $table->string('nama_file');
            $table->unsignedInteger('pengumuman_id')->nullable();
            $table->timestamps();

            // FK
            $table->foreign('pengumuman_id')
                    ->references('id')
                    ->on('pengumuman')
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
        Schema::dropIfExists('file_attach_pengumuman');
    }
}
