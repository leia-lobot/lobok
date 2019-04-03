<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtrasResourceTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('extras_resource', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('extras_id');
            $table->bigInteger('resource_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('extras_resource');
    }
}
