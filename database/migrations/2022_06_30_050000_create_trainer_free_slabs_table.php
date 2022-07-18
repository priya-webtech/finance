<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainerFreeSlabsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainer_free_slabs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trainer_id')->unsigned();
            $table->integer('min_std');
            $table->integer('max_std');
            $table->decimal('fees');
            $table->timestamps();
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
        Schema::drop('trainer_free_slabs');
    }
}
