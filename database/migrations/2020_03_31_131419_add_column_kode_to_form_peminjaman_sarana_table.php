<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnKodeToFormPeminjamanSaranaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_peminjaman_sarana', function (Blueprint $table) {
            $table->string('kode', 10)->unique()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_peminjaman_sarana', function (Blueprint $table) {
            //
        });
    }
}
