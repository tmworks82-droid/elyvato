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
        Schema::create('log_histories', function (Blueprint $table) {
            $table->id();

             $table->string('url');

             $table->string('event_type');
 
             $table->string('event_history');

             $table->json('json_data');
 
             // Who performed the action
             $table->unsignedBigInteger('action_performed_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_histories');
    }
};
