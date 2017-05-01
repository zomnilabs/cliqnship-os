<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id')->nullable();
            $table->integer('user_id');
            $table->integer('source_id');
            $table->integer('user_addressbook_id');
            $table->text('item_description')->nullable();
            $table->integer('number_of_items')->nullable();
            $table->enum('service_type', ['metro_manila', 'provincial', 'international', 'others']);
            $table->enum('is_international', ['express', 'ems', 'postal']);
            $table->tinyInteger('collect_and_deposit')->nullable();
            $table->tinyInteger('insurance_declared_value')->nullable();
            $table->double('insurance_amount')->nullable();
            $table->double('collect_and_deposit_amount')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank')->nullable();
            $table->enum('status', ['pending', 'shipment-cancelled','for-pickup','courier-picked-up','arrived-at-hq','enroute','successfully-delivered','returned'])->default('pending');
            $table->enum('charge_to', ['sender','consignee'])->default('sender');
            $table->enum('pay_thru', ['cash','account','others'])->default('cash');
            $table->string('if_pay_others')->nullable();
            $table->enum('package_type', ['small','medium','large'])->default('small');
            $table->double('length')->nullable();
            $table->double('width')->nullable();
            $table->double('height')->nullable();
            $table->double('weight')->nullable();
            $table->string('signature')->nullable();
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
        Schema::dropIfExists('shipments');
    }
}
