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
            $table->integer('user_addressbook_id')->unsigned();
            $table->string('remarks')->default('');
            $table->string('status');
            $table->string('signature')->nullable();
            $table->date('pickup_date');
            $table->integer('number_of_items')->nullable();
            $table->string('type_of_items')->nullable();
            $table->double('length')->nullable();
            $table->double('width')->nullable();
            $table->double('height')->nullable();
            $table->double('weight')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // References
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('user_addressbook_id')
                ->references('id')->on('user_addressbooks')
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
