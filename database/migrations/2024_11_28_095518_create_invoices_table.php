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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id(); // معرف الفاتورة
            $table->string('customer_name'); // اسم العميل
            $table->string('customer_email'); // بريد العميل
            $table->string('customer_phone'); // هاتف العميل
            $table->string('city'); // المدينة
            $table->date('pickup_date'); // تاريخ الاستلام
            $table->date('return_date'); // تاريخ الإرجاع
            $table->date('creation_date'); // تاريخ الإنشاء
            $table->text('description')->nullable(); // وصف الفاتورة
            $table->decimal('car_daily_price', 10, 2); // سعر السيارة اليومي
            $table->integer('total_days'); // إجمالي الأيام
            $table->decimal('total_amount', 10, 2); // المبلغ الإجمالي
            $table->decimal('tax', 10, 2); // الضريبة
            $table->string('status'); // الحالة
            $table->timestamps(); // timestamps created_at و updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
