<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnFormCutiToDetailFormCuti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_form_cuti', function (Blueprint $table) {
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
        Schema::table('detail_form_cuti', function (Blueprint $table) {
            //
        });
    }
}
