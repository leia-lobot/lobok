<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingExtraTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('booking_extra', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('extra_id');
            $table->bigInteger('booking_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('booking_extra');
    }
}
