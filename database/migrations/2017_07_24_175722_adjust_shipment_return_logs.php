<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdjustShipmentReturnLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipment_return_logs', function(Blueprint $table) {
            $table->dropColumn('shipment_id');
            $table->integer('shipment_resolution_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipment_return_logs', function(Blueprint $table) {
            $table->integer('shipment_id');
            $table->dropColumn('shipment_resolution_id')->unsigned();
        });
    }
}
