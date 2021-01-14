<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostsTable extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->dropColumn('service');
            // $table->dropColumn('total');
        });
        Schema::create('costs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('payments_id')->unsigned();
            $table->string('service')->nullable();
            $table->integer('price')->nullable();
            $table->integer('quantity')->nullable();
            $table->timestamps();
            $table->foreign('payments_id')->references('id')->on('payments')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('costs');
    }
}
