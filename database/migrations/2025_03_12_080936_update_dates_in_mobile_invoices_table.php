<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('mobile_invoices', function (Blueprint $table) {
            $table->dateTime('pickup_date')->change();
            $table->dateTime('return_date')->change();
        });
    }

    public function down()
    {
        Schema::table('mobile_invoices', function (Blueprint $table) {
            $table->date('pickup_date')->change();
            $table->date('return_date')->change();
        });
    }
};
