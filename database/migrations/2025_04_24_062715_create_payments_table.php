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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->enum('payment_type', ['initial', 'milestone', 'final'])->nullable();
            $table->enum('status', ['pending', 'completed', 'failed'])->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->enum('is_active', ['1', '0'])->default('1');
            $table->timestamp('created_on')->useCurrent()->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            // Indexes
            $table->index('booking_id');
            $table->index('created_by');
            $table->index('updated_by');
            
            // Foreign Keys
            $table->foreign('booking_id')->references('id')->on('bookings')->onUpdate('no action')->onDelete('no action');
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
