<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('orders_id')->unsigned();
            $table->string('no_form');
            $table->date('date1');
            $table->integer('times1_id')->unsigned();
            $table->date('date2');
            $table->integer('times2_id')->unsigned();
            $table->date('date3');
            $table->integer('times3_id')->unsigned();
            $table->string('token')->nullable();
            $table->integer('status')->default('1')->unsigned();
            $table->integer('datetime')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
            $table->foreign('orders_id')->references('id')->on('orders')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('times1_id')->references('id')->on('times')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('times2_id')->references('id')->on('times')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('times3_id')->references('id')->on('times')
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
        Schema::dropIfExists('bookings');
    }
}
