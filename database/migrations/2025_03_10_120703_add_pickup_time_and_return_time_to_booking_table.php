<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPickupTimeAndReturnTimeToBookingTable extends Migration
{
    public function up()
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->time('pickup_time')->nullable();  // إضافة عمود pickup_time
            $table->time('return_time')->nullable();  // إضافة عمود return_time
        });
    }

    public function down()
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->dropColumn(['pickup_time', 'return_time']);  // حذف الأعمدة في حالة التراجع
        });
    }
}
