<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prebooking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // مفتاح أجنبي للمستخدم
            $table->string('customer_name');
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->string('pickup_city');
            $table->date('pickup_date');
            $table->date('return_date');
            $table->text('car_details');
            $table->integer('total_days');
            $table->decimal('deposite_amount', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prebooking');
    }
};
