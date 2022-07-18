<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorporatesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name');
            $table->string('contact_no');
            $table->string('email');
            $table->string('web_site');
            $table->string('address');
            $table->string('state');
            $table->string('city');
            $table->integer('status');
            $table->integer('branch_id')->unsigned();;
            $table->integer('batch_id')->unsigned();;
            $table->decimal('trainer_amount');
            $table->decimal('agreed_amount');
            $table->decimal('gst_amount');
            $table->string('reg_for_month');
            $table->string('remark');
            $table->integer('enquiry_type_id')->unsigned();;
            $table->integer('lead_source_id')->unsigned();;
            $table->timestamps();
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('batch_id')->references('id')->on('batches');
            $table->foreign('enquiry_type_id')->references('id')->on('enquiry_types');
            $table->foreign('lead_source_id')->references('id')->on('lead_sources');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('corporates');
    }
}
