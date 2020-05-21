<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToFormPenangananIt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('form_penanganan_it', function (Blueprint $table) {
            $table->dropColumn('stat');
            $table->dropForeign('form_penanganan_it_karyawan_all_id_foreign');
            $table->dropColumn('karyawan_all_id');
        });

        Schema::table('form_penanganan_it', function (Blueprint $table) {
            $table->enum('stat', ['1', '2', '3', '4'])->after('penyelesaian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_penanganan_it', function (Blueprint $table) {
            //
        });
    }
}
