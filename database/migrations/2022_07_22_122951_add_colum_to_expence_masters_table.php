<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumToExpenceMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expence_masters', function (Blueprint $table) {
            //trainer_id  batch_id student_id
            $table->integer('student_id')->nullable()->unsigned();
            $table->integer('batch_id')->nullable()->unsigned();
            $table->integer('trainer_id')->nullable()->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
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
        Schema::table('expence_masters', function (Blueprint $table) {
            //
        });
    }
}
