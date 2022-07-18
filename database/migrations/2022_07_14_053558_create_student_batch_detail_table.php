<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentBatchDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_batch_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_detail_id')->unsigned();
            $table->integer('batch_id')->unsigned();
            $table->integer('trainer_id')->unsigned();
            $table->decimal('trainer_fees');
            $table->timestamps();
            $table->foreign('student_detail_id')->references('id')->on('student_detail')->onDelete('cascade');
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
            $table->foreign('trainer_id')->references('id')->on('trainers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_batch_detail');
    }
}
