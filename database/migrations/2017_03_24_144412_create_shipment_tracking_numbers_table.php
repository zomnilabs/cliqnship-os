<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentTrackingNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_tracking_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipment_id')->unsigned();
            $table->string('tracking_number');
            $table->string('provider')->default('cliqnship');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_tracking_numbers');
    }
}
