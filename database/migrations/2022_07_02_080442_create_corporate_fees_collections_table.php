<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorporateFeesCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporate_fees_collections', function (Blueprint $table) {
            $table->id();
            $table->integer('corporate_id')->unsigned();
            $table->integer('batch_id')->unsigned();
            $table->string('gst')->nullable();
            $table->integer('income_id')->unsigned();
            $table->timestamps();
            $table->foreign('corporate_id')->references('id')->on('corporates')->onDelete('cascade');
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
            $table->foreign('income_id')->references('id')->on('incomes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corporate_fees_collections');
    }
}
