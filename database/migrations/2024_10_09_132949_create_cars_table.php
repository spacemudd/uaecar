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
            $table->string('car_name');   // For car name
            $table->integer('seats');     // Number of seats
            $table->string('gear');       // Gear type
            $table->integer('bags');      // Number of bags
            $table->string('pictures');    // Image path or URL for the car's picture
            $table->string('car_picture'); // Additional car picture path or URL
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
