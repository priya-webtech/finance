<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('mobile_no');
            $table->integer('enquiry_type')->unsigned();
            $table->integer('student_type')->unsigned();
            $table->string('state')->nullable();
            $table->string('remark')->nullable();
            $table->integer('status');
            $table->timestamps();
            $table->foreign('enquiry_type')->references('id')->on('enquiry_types');
            $table->foreign('student_type')->references('id')->on('student_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('students');
    }
}
