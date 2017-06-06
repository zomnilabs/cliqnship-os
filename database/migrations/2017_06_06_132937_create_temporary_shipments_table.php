<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemporaryShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_shipments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shipper_name')->nullable();
            $table->string('shipper_contact_number')->nullable();
            $table->string('shipper_address')->nullable();
            $table->string('to')->nullable();
            $table->string('address_type')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('item_description')->nullable();
            $table->string('service_type')->nullable();
            $table->string('collect_and_deposit')->nullable();
            $table->string('collect_and_deposit_amount')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('remarks')->nullable();
            $table->string('bank')->nullable();
            $table->string('charge_to')->nullable();
            $table->string('package_type')->nullable();
            $table->string('insurance_declared_value')->nullable();
            $table->string('insurance_amount')->nullable();
            $table->string('length')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('tracking_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temporary_shipments');
    }
}
