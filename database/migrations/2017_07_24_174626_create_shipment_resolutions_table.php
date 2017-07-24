<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentResolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_resolutions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipment_id')->unsigned();
            $table->text('remarks');
            $table->enum('status', ['unresolved', 'resolving', 'resolved']);
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
        Schema::dropIfExists('shipment_resolutions');
    }
}