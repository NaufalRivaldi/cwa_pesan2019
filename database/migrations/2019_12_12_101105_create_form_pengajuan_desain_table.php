<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormPengajuanDesainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_pengajuan_desain', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl_perlu');
            $table->integer('qty');
            $table->string('ukuran');
            $table->text('deskripsi');
            $table->enum('stat', ['1', '2', '3', '4', '5']);
            $table->text('keterangan');
            $table->string('keterangan_lain', 100);
            $table->unsignedInteger('jenis_desain_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('karyawan_all_id');
            $table->timestamps();

            // fk
            $table->foreign('jenis_desain_id')
                    ->references('id')
                    ->on('jenis_desain')
                    ->onUpdate('cascade');
                    
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
        Schema::dropIfExists('form_pengajuan_desain');
    }
}
