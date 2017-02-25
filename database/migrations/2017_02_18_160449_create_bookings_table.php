<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('booking_no');
            $table->integer('user_id')->unsigned();
            $table->integer('source_id')->unsigned();
            $table->integer('addressbook_id')->unsigned();
            $table->string('remarks');
            $table->string('status');
            $table->string('signature');
            $table->date('pickup_date');
            $table->integer('number_of_items');
            $table->string('type_of_items');
            $table->double('length');
            $table->double('width');
            $table->double('height');
            $table->double('weight');
            $table->timestamps();
            $table->softDeletes();

            // References
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('addressbook_id')
                ->references('id')->on('addressbooks')
                ->onDelete('cascade');

            $table->foreign('source_id')
                ->references('id')->on('sources')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
