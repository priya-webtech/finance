<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenceMastersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expence_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expence_type_id')->unsigned();
            $table->integer('branch_id')->unsigned();
            $table->integer('bank_ac_id')->unsigned();
            $table->decimal('amount');
            $table->date('date');
            $table->text('remark');
            $table->timestamps();
            $table->foreign('expence_type_id')->references('id')->on('expense_types');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('bank_ac_id')->references('id')->on('bank_accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('expence_masters');
    }
}
