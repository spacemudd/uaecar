<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('booking_request', function (Blueprint $table) {
            $table->string('status')->default('Pending');
            $table->string('status')->default('Pending');  // Add a status column with a default value
        });

        DB::table('booking_request')->update(['status' => 'Pending']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_request', function (Blueprint $table) {
            $table->dropColumn('status');  // Drop the status column if rolling back the migration
        });
    }
};
