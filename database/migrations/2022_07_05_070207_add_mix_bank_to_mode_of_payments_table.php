<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMixBankToModeOfPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mode_of_payments', function (Blueprint $table) {
            $table->string('name')->after('title');
            $table->string('ifsc_code')->after('name');
            $table->string('account_no')->after('ifsc_code');
            $table->string('other_detail')->after('account_no');
            $table->decimal('opening_balance')->after('other_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mode_of_payments', function (Blueprint $table) {
            //
        });
    }
}
