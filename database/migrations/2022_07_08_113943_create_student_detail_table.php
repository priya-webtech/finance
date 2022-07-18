<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->integer('lead_source_id')->unsigned();
            $table->integer('branch_id')->unsigned();
            $table->integer('reg_taken_id')->unsigned();
            $table->decimal('agreed_amount');
            $table->string('placement');
            $table->string('reg_for_month');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('lead_source_id')->references('id')->on('lead_sources')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('reg_taken_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_detail');
    }
}
