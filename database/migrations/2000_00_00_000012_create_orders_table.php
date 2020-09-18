<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('users_id')->unsigned();
            $table->integer('tools_id')->unsigned();
            $table->string('attend')->nullable();
            $table->integer('plans_id')->unsigned();
            $table->text('purpose');
            $table->text('sample');
            $table->text('unique');
            $table->timestamps();
            $table->foreign('users_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tools_id')->references('id')->on('tools')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('plans_id')->references('id')->on('plans')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
