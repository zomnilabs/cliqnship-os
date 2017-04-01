<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipment_id')->unsigned();
            $table->enum('event_source', ['customer', 'admin', 'rider_app', 'customer_app', 'warehouse']);
            $table->enum('event', ['status_change', 'shipment_details_updated', 'waiting_for_encoding']);
            $table->string('value');
            $table->text('remarks');
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
        Schema::dropIfExists('shipment_events');
    }
}
