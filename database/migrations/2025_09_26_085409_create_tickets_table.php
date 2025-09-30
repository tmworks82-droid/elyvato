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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id'); // Equivalent to INT NOT NULL
            $table->string('ticket_id', 50)->default('')->collation('utf8mb4_unicode_ci'); // Equivalent to VARCHAR(50)
            $table->unsignedInteger('department_id'); // Equivalent to INT NOT NULL
            $table->string('describe_issue', 255)->collation('utf8mb4_unicode_ci'); // Equivalent to VARCHAR(255)
            $table->string('image', 255)->collation('utf8mb4_unicode_ci'); // Equivalent to VARCHAR(255)
            $table->string('status', 255)->default('pending')->comment('pending, live, closed')->collation('utf8mb4_unicode_ci');
            $table->string('ticket_close', 255)->default('open')->comment('open, closed')->collation('utf8mb4_unicode_ci');
            $table->unsignedInteger('closed_by')->default(0);
            $table->timestamp('closed_at')->default(DB::raw('CURRENT_TIMESTAMP')); // Equivalent to TIMESTAMP NOT NULL DEFAULT now()
            $table->timestamps(0); // Automatically handles created_at and updated_at fields

           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
