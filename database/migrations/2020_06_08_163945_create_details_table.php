<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tools_id')->unsigned();
            $table->string('descrip');
            $table->integer('labs_id')->unsigned();
            $table->string('sample');
            $table->integer('uses_id')->unsigned();
            $table->string('image');
            $table->timestamps();
            $table->foreign('tools_id')->references('id')->on('tools')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('labs_id')->references('id')->on('labs')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('uses_id')->references('id')->on('uses')
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
        Schema::dropIfExists('details');
    }
}
