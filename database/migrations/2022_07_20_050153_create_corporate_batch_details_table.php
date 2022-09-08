<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorporateBatchDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporate_batch_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('corporate_detail_id')->unsigned();
            $table->integer('batch_id')->unsigned();
            $table->integer('trainer_id')->unsigned();
            $table->foreign('corporate_detail_id')->references('id')->on('corporate_detail')->onDelete('cascade');
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
            $table->foreign('trainer_id')->references('id')->on('trainers')->onDelete('cascade');
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
        Schema::dropIfExists('corporate_batch_details');
    }
}
