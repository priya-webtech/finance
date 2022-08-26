<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlacementToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {

            $table->string('placement')->nullable()->after('status');
            $table->string('initial_call_made')->nullable()->after('placement');
            $table->string('batch_status')->nullable()->after('initial_call_made');
            $table->string('tc')->nullable()->after('batch_status');
            $table->string('placement_exam_conducted')->nullable()->after('tc');
            $table->string('exam_passed')->nullable()->after('placement_exam_conducted');
            $table->string('certificate_issued')->nullable()->after('exam_passed');
            $table->string('cv_shared_to_hr')->nullable()->after('certificate_issued');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
}
