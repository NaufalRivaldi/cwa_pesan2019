<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKategoriToPkkPeriode2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pkk_periode', function (Blueprint $table) {
            DB::statement("ALTER TABLE pkk_periode MODIFY COLUMN kategori ENUM('1', '2', '3', '4', '5')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pkk_periode', function (Blueprint $table) {
            //
        });
    }
}
