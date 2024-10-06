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
            $table->text('description');
            $table->text('description2');
            $table->text('long_description');
            $table->string('year');
            $table->string('engine_size');
            $table->string('mileage');
            $table->string('price');
            $table->string('fuel_type');
            $table->string('registration');
            $table->string('owners');
            $table->string('emission_class')->nullable();
            $table->string('at_stock_id')->nullable()->unique();
            $table->string('at_advertiserAdvert')->nullable();
            $table->string('at_make')->nullable();
            $table->string('at_model')->nullable();
            $table->string('at_derivative')->nullable();
            $table->string('at_description')->nullable();
            $table->string('at_description2')->nullable();
            $table->string('at_published')->nullable();
            $table->string('at_total_price')->nullable();
            $table->dateTime('at_last_synced')->nullable();
            $table->json('at_data')->nullable();
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
