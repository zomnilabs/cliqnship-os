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
            $table->integer('booking_id');
            $table->integer('user_id');
            $table->integer('source_id');
            $table->integer('user_addressbook_id');
            $table->string('shipment_tracking_no');
            $table->text('remarks');
            $table->text('item_description');
            $table->integer('number_of_items');
            $table->enum('service_type', ['metro_manila', 'provincial', 'international', 'others']);
            $table->enum('is_international', ['express', 'ems', 'postal']);
            $table->tinyInteger('collect_and_deposit');
            $table->tinyInteger('insurance_declared_value');
            $table->double('insurance_amount');
            $table->double('collect_and_deposit_amount');
            $table->string('account_name');
            $table->string('account_number');
            $table->string('bank');
            $table->enum('status', ['shipment-cancelled','for-pickup','courier-picked-up','arrived-at-hq','enroute','successfully-delivered','returned']);
            $table->enum('charge_to', ['sender','consignee']);
            $table->enum('pay_thru', ['cash','account','others']);
            $table->string('if_pay_others');
            $table->enum('package_type', ['small','medium','large']);
            $table->double('lenght');
            $table->double('width');
            $table->double('height');
            $table->double('weight');
            $table->string('signature');
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
