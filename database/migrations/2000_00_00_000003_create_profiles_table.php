<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('no_id');
            $table->string('no_hp');
            $table->string('university')->nullable();
            $table->string('faculty')->nullable();
            // $table->integer('faculties_id')->unsigned()->nullable();
            $table->string('study_program')->nullable();
            // $table->integer('study_programs_id')->unsigned()->nullable();
            $table->string('image')->nullable();
            $table->string('institution')->nullable();
            $table->string('address')->nullable();
            $table->string('email_lecturer')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('faculties_id')->references('id')->on('faculties')
            //     ->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('study_programs_id')->references('id')->on('study_programs')
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
        Schema::dropIfExists('profiles');
    }
}
