<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorporateDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporate_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('corporate_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->integer('reg_taken_id')->unsigned();
            $table->decimal('agreed_amount');
            $table->string('placement');
            $table->string('reg_for_month');
            $table->foreign('corporate_id')->references('id')->on('corporates')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
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
        Schema::dropIfExists('corporate_detail');
    }
}
