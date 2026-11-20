<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->nullable()->constrained('tours')->nullOnDelete();
            $table->string('booking_reference')->unique();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('destination_interest')->nullable();
            $table->date('departure_date')->nullable();
            $table->string('time_slot')->default('Flexible Schedule');
            $table->integer('adults_count')->default(1);
            $table->integer('children_count')->default(0);
            $table->text('special_requests')->nullable();
            $table->string('status')->default('pending'); // pending, contacted, confirmed, cancelled
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
