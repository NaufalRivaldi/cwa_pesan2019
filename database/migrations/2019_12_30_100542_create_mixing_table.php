<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMixingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mixing', function (Blueprint $table) {
            $table->increments('id');
            $table->double('qty');
            $table->string('unit');
            $table->string('colorCode');
            $table->string('colorName');
            $table->string('base');

            // fk
            $table->unsignedInteger('userId');
            $table->unsignedInteger('customersId');
            $table->unsignedInteger('productId');

            $table->foreign('userId')
                    ->references('id')
                    ->on('user')
                    ->onUpdate('cascade');

            $table->foreign('customersId')
                    ->references('id')
                    ->on('customers')
                    ->onUpdate('cascade');

            $table->foreign('productId')
                    ->references('id')
                    ->on('product')
                    ->onUpdate('cascade');

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
        Schema::dropIfExists('mixing');
    }
}
