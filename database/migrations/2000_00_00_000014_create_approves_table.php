<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('orders_id')->unsigned();
            $table->string('no_regis')->nullable();
            $table->date('date');
            $table->integer('times_id')->unsigned();
            $table->integer('status')->default('1')->unsigned();
            $table->timestamps();
            $table->foreign('orders_id')->references('id')->on('orders')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('times_id')->references('id')->on('times')
                ->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('statuses_id')->references('id')->on('statuses')
            //     ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approves');
    }
}
