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
        Schema::create('time_sheets', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('user_id'); // Foreign key to users table
            $table->timestamp('start_time'); // Start time of the timesheet
            $table->timestamp('end_time'); // End time of the timesheet
            $table->string('status'); // Status of the timesheet (e.g., approved, pending)
            $table->foreignId('created_by')->constrained('admins')->onDelete('set null'); // Created by admin (foreign key to admins table)
            $table->foreignId('updated_by')->constrained('admins')->onDelete('set null'); // Updated by admin (foreign key to admins table)
            $table->text('note')->nullable(); // Additional note, nullable
            $table->boolean('is_active')->default(true); // Column to track whether the timesheet is active (default is true)
            $table->timestamps(); // created_at, updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_sheets');
    }
};
