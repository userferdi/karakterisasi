<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('approves_id')->unsigned();
            $table->string('no_invoice')->nullable();
            $table->date('date_invoice')->nullable();
            $table->string('no_receipt')->nullable();
            $table->date('date_receipt')->nullable();
            $table->integer('status');
            $table->string('quantity')->nullable();
            $table->string('service')->nullable();
            $table->integer('total')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('payments');
    }
}
