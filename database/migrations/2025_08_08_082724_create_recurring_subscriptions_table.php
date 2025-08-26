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
        Schema::create('recurring_subscriptions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sow_id');
            $table->enum('subscription', ['monthly', 'weekly', 'biweekly']);
            $table->json('subscription_dates')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['live', 'cancel'])->default('live');
            $table->timestamps();

            // Foreign key constraints (optional, but recommended)
            $table->foreign('sow_id')->references('id')->on('statement_of_works')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('admins')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurring_subscriptions');
    }
};
