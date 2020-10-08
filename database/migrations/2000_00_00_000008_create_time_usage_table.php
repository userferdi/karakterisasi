<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeUsageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_usage', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('time_id')->unsigned();
            $table->integer('usage_id')->unsigned();
            $table->timestamps();
            $table->foreign('time_id')->references('id')->on('times')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('usage_id')->references('id')->on('usages')
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
        Schema::dropIfExists('time_usage');
    }
}
