<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnStatusToFormQaUsulanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_qa_usulan', function (Blueprint $table) {
            DB::statement("ALTER TABLE form_qa_usulan MODIFY COLUMN status ENUM('1', '2', '3', '4')");
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
