<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePickupReturnDateColumnsInBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->dateTime('pickup_date')->change();
            $table->dateTime('return_date')->change();
        });
    }

    public function down()
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->date('pickup_date')->change();
            $table->date('return_date')->change();
        });
    }
}
