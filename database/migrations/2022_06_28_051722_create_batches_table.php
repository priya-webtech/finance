<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned();
            $table->integer('batch_mode_id')->unsigned();
            $table->integer('trainer_id')->unsigned();
            $table->string('name');
            $table->string('start');
            $table->integer('status');
            $table->timestamps();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('batch_mode_id')->references('id')->on('batch_modes');
            $table->foreign('trainer_id')->references('id')->on('trainers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('batches');
    }
}
