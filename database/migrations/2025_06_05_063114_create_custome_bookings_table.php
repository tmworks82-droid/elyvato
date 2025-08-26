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
        Schema::create('custome_bookings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('service_id'); // optional
            $table->unsignedBigInteger('subservice_id'); // optional
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('sow_id');
            $table->decimal('initial_paid_amount', 10, 2)->default(0.00);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('brief_description');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custome_bookings');
    }
};
