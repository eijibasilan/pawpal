<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('hotel_bookings', function (Blueprint $table) {
            $table->string('payment_id')->nullable();
            $table->string('payment_status')->default('pending');
            $table->decimal('amount', 10, 2);
        });
    }

    public function down()
    {
        Schema::table('hotel_bookings', function (Blueprint $table) {
            $table->dropColumn(['payment_id', 'payment_status', 'amount']);
        });
    }
};