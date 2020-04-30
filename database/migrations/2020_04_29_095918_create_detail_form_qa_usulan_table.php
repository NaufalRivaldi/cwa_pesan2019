<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailFormQaUsulanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_form_qa_usulan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qty');
            $table->unsignedInteger('formId');
            $table->unsignedInteger('fileId');

            $table->foreign('formId')
                    ->references('id')
                    ->on('form_qa_usulan')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('fileId')
            ->references('id')
            ->on('master_file')
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
        Schema::dropIfExists('detail_form_qa_usulan');
    }
}
