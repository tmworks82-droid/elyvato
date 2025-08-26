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
        Schema::create('ratings', function (Blueprint $table) {
             $table->id();
            $table->unsignedBigInteger('user_id'); // the user being rated
            $table->unsignedBigInteger('rated_by'); // who rated (optional but useful)
            $table->tinyInteger('rating')->comment('1 to 5'); // rating out of 5
            $table->text('review')->nullable(); // optional text review
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('rated_by')->references('id')->on('admins')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
