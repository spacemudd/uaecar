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
            $table->boolean('delivery')->nullable();
            $table->integer('kilo_daily')->nullable();
            $table->integer('kilo_monthly')->nullable();
            $table->boolean('navigation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['delivery', 'kilo_daily', 'kilo_monthly', 'navigation']);
        });
    }
};
