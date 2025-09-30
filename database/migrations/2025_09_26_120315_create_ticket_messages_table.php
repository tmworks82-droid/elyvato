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
        Schema::create('ticket_messages', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('ticket_id'); // Equivalent to BIGINT UNSIGNED NOT NULL
            $table->unsignedBigInteger('user_id')->nullable()->default(null); // Equivalent to BIGINT UNSIGNED NULL
            $table->text('message')->collation('utf8mb4_unicode_ci'); // Equivalent to TEXT
            $table->enum('sender', ['user', 'admin'])->collation('utf8mb4_unicode_ci'); // Equivalent to ENUM('user', 'admin')
            $table->string('image', 250)->nullable()->default(null)->collation('utf8mb4_unicode_ci'); // Equivalent to VARCHAR(250)
            $table->timestamps(0); // Automatically creates created_at and updated_at fields

            // Foreign Key Constraints
            $table->foreign('ticket_id')->references('id')->on('tickets')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('user_id')->references('id')->on('admins')->onUpdate('NO ACTION')->onDelete('NO ACTION');

            // Indexes
            $table->index('ticket_id'); // Adding an index for ticket_id
            $table->index('user_id'); // Adding an index for user_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_messages');
    }
};
