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
            $table->text('sample');
            $table->string('image')->nullable();
            $table->integer('labs_id')->unsigned();
            $table->integer('actives_id')->unsigned();
            $table->integer('usages_id')->unsigned();
            $table->timestamps();
            $table->foreign('labs_id')->references('id')->on('labs')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('actives_id')->references('id')->on('actives')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('usages_id')->references('id')->on('usages')
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
