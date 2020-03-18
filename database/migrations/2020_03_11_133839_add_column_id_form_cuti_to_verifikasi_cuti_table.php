<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnIdFormCutiToVerifikasiCutiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('verifikasi_cuti', function (Blueprint $table) {
            $table->dropForeign('verifikasi_cuti_detailCutiId_foreign');
            $table->dropColumn('detailCutiId');
            $table->unsignedInteger('idFormCuti');

            $table->foreign('idFormCuti')
                    ->references('id')
                    ->on('form_cuti')
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
        Schema::table('verifikasi_cuti', function (Blueprint $table) {
            //
        });
    }
}
