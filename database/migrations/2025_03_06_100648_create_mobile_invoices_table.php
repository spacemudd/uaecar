<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('mobile_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->decimal('total_amount', 10, 2);
            $table->integer('total_days');
            $table->decimal('security_deposit', 10, 2);
            $table->date('pickup_date');
            $table->date('return_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mobile_invoices');
    }
}
