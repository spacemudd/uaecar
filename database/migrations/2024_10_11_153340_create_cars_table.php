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
        Schema::create('cars', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('node_id')->nullable(); // Node ID
            $table->string('car_name'); // Car name
            $table->integer('seats'); // Number of seats
            $table->string('gear'); // Gear type
            $table->decimal('price_daily'); // Price
            $table->decimal('price_weekly', 10, 2);
            $table->decimal('price_monthly', 10, 2);  
            $table->string('car_picture')->nullable(); // Picture URL
            $table->integer('doors'); // Number of doors
            $table->text('description')->nullable(); // Description
            $table->timestamps(); // Created at & Updated at
            $table->string('plate_number')->nullable(); // Plate number
            $table->string('make')->nullable(); // Car make
            $table->string('model')->nullable(); // Car model
            $table->year('year'); // Manufacturing year
            $table->string('color')->nullable(); // Car color
            $table->string('categories')->nullable(); // Categories
            $table->string('status')->nullable(); // Status
            $table->date('expected_return_date')->nullable(); // Expected return date
            $table->date('upcoming_reservation')->nullable(); // Upcoming reservation
            $table->string('chassis_number')->nullable(); // Chassis number
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
