<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('resource_id');
            $table->foreign('resource_id')->references('id')->on('rooms');

            $table->bigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');

            $table->bigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->dateTime('start_time');
            $table->dateTime('end_time');

            $table->bigInteger('extras')->nullable();
            $table->foreign('extras')->references('id')->on('extras');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
