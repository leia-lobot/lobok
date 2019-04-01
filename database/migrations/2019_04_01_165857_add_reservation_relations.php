<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReservationRelations extends Migration
{

    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->bigInteger('resource_id', false, true)->nullable();
            $table->foreign('resource_id')->references('id')->on('resources');

            $table->bigInteger('company_id', false, true)->nullable();
            $table->foreign('company_id')->references('id')->on('companies');

            $table->bigInteger('user_id', false, true)->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign('reservations_resource_id_foreign');
            $table->dropColumn('resource_id');

            $table->dropForeign('reservations_company_id_foreign');
            $table->dropColumn('company_id');

            $table->dropForeign('reservations_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
