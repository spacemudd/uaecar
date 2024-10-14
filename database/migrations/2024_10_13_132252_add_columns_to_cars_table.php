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
        Schema::table('cars', function (Blueprint $table) {
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn([
                'plate_number',
                'make',
                'model',
                'year',
                'color',
                'categories',
                'current_location',
                'status',
                'expected_return_date',
                'upcoming_reservation',
                'latest_return_date',
                'odometer',
                'chassis_number',
                'license_expiry_date',
                'insurance_expiry_date',
            ]);
        });
    }
};
