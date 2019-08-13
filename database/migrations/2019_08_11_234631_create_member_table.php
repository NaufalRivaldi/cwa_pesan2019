<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kdmember', 15);
            $table->string('nm_member', 50);
            $table->text('almt_member');
            $table->string('telp', 15);
            $table->string('no_kitas', 20);
            $table->string('lokasi_daftar', 10);
            $table->date('tgl_daftar');
            $table->string('total_point', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member');
    }
}
