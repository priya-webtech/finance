<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('income_type_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->string('trainer_name');
            $table->decimal('paying_amount');
            $table->integer('gst');
            $table->string('register_date');
            $table->integer('registration_taken_by');
            $table->string('comment');
            $table->integer('status');
            $table->timestamps();
            $table->foreign('income_type_id')->references('id')->on('income_types');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('incomes');
    }
}
