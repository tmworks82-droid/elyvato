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
        Schema::create('chassis_data', function (Blueprint $table) {
            $table->id();
            $table->string('chassis_number')->unique();
            $table->tinyInteger('is_live')->default(1);
            $table->unsignedBigInteger('created_by')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chassis_data');
    }
};
