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
            $table->id();
            $table->string('car_name');
            $table->integer('seats');
            $table->string('gear');
            $table->decimal('price', 10, 2);
            $table->string('car_picture');
            $table->integer('doors');
            $table->boolean('air_condition')->default(false);
            $table->text('description')->nullable();
            $table->string('plate_number')->nullable();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->year('year')->nullable();
            $table->string('color')->nullable();
            $table->string('categories')->nullable();
            $table->string('current_location')->nullable();
            $table->string('status')->nullable();
            $table->date('expected_return_date')->nullable();
            $table->string('upcoming_reservation')->nullable();
            $table->date('latest_return_date')->nullable();
            $table->integer('odometer')->nullable();
            $table->string('chassis_number')->nullable();
            $table->date('license_expiry_date')->nullable();
            $table->date('insurance_expiry_date')->nullable();
            $table->timestamps();
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
