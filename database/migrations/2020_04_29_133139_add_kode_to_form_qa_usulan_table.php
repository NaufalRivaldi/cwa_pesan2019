<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKodeToFormQaUsulanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_qa_usulan', function (Blueprint $table) {
            $table->string('kode', 10)->unique()->after('id');
            $table->enum('status', ['1','2'])->after('karyawanId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_qa_usulan', function (Blueprint $table) {
            //
        });
    }
}
