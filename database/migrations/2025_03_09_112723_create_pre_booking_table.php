<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pre_booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('car_name');
            $table->string('car_model');
            $table->decimal('car_daily_price', 10, 2);
            $table->decimal('car_weekly_price', 10, 2);
            $table->decimal('car_monthly_price', 10, 2);
            $table->integer('total_days');
            $table->decimal('total_amount', 10, 2);
            $table->string('plate_number');
            $table->timestamps();
    
            // إضافة مفتاح خارجي إذا كان هناك جدول users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_booking');
    }
};
