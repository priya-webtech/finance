<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCorporateDetailIdToCorporateFeesCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('corporate_fees_collections', function (Blueprint $table) {
            $table->bigInteger('corporate_detail_id')->nullable()->unsigned()->after('corporate_id');
            $table->foreign('corporate_detail_id')->references('id')->on('corporate_detail')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('corporate_fees_collections', function (Blueprint $table) {
            //
        });
    }
}
