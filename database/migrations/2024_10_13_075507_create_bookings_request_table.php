<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('booking_request', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->unsignedInteger('request_number'); // Unique request number
            $table->unsignedBigInteger('car_id'); // Foreign key for the car
            $table->string('car_name');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('pickup_city');
            $table->date('pickup_date');
            $table->date('return_date');
            $table->text('message')->nullable();
            $table->decimal('daily_car_price', 10, 2);
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraint
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_request');
    }
};
