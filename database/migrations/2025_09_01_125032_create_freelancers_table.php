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
        Schema::create('freelancers', function (Blueprint $table) { 
        
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('pincode')->nullable();
            $table->string('gst')->nullable();
            $table->string('talent')->nullable();
            $table->integer('experience')->nullable();
            $table->string('qualification')->nullable();
            $table->string('languages')->nullable();
            $table->string('certification')->nullable();
            $table->string('portfolio')->nullable();
            $table->string('ratecard')->nullable();
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancers');
    }
};
