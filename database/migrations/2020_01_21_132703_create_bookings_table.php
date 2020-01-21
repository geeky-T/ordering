<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('bookingId')->autoIncrement();
            $table->string('userId');
            $table->integer('hotelId');
            $table->integer('hoursOccupied');
            $table->double('amount');
            $table->boolean('isActive');
            $table->foreign('userId')->references('email')->on('users');
            $table->foreign('hotelId')->references('hotelId')->on('inventories');
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
        Schema::dropIfExists('bookings');
    }
}
