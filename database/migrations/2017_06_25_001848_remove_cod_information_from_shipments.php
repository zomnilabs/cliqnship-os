<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveCodInformationFromShipments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipments', function(Blueprint $table) {
            $table->dropColumn('collect_and_deposit_amount');
            $table->dropColumn('account_name');
            $table->dropColumn('account_number');
            $table->dropColumn('bank');
            $table->dropColumn('cod_fee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipments', function(Blueprint $table) {
            $table->double('collect_and_deposit_amount');
            $table->string('account_name');
            $table->string('account_number');
            $table->string('bank');
            $table->double('cod_fee');
        });
    }
}
