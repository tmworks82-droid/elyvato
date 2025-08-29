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
        Schema::create('notes', function (Blueprint $table) {
            $table->id(); // id (primary key)

            $table->unsignedBigInteger('booking_id')->nullable(); // relation with bookings table
            $table->text('note')->nullable(); // note text

            $table->unsignedBigInteger('created_by')->nullable(); // who created
            $table->unsignedBigInteger('updated_by')->nullable(); // who last updated

            $table->timestamps(); // created_at & updated_at

            // Foreign keys (optional, if tables exist)
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('admins')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
