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
            $table->string('no_regis');
            $table->string('title');
            $table->integer('users_id')->unsigned();
            $table->integer('tools_id')->unsigned();
            $table->datetime('start');
            $table->datetime('end');
            $table->date('date');
            $table->integer('times_id')->unsigned();
            $table->string('attend')->nullable();
            $table->text('purpose');
            $table->text('sample');
            $table->text('unique');
            $table->integer('approves_id')->default('1')->unsigned();
            $table->timestamps();
            $table->foreign('users_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tools_id')->references('id')->on('tools')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('times_id')->references('id')->on('times')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('approves_id')->references('id')->on('approves')
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
