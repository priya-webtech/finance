<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStudentDetailIdToStudentFeesCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_fees_collections', function (Blueprint $table) {
            $table->bigInteger('student_detail_id')->nullable()->unsigned()->after('student_id');
            $table->foreign('student_detail_id')->references('id')->on('student_detail')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_fees_collections', function (Blueprint $table) {
            //
        });
    }
}
