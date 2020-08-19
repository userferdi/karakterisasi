<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->text('descrip');
            // longText, mediumText, text
            $table->text('sample');
            $table->string('image')->nullable();
            $table->integer('statuses_id')->unsigned();
            $table->integer('labs_id')->unsigned();
            $table->integer('periods_id')->unsigned();
            $table->timestamps();
            $table->foreign('statuses_id')->references('id')->on('statuses')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('labs_id')->references('id')->on('labs')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('periods_id')->references('id')->on('periods')
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
        Schema::dropIfExists('tools');
    }
}
