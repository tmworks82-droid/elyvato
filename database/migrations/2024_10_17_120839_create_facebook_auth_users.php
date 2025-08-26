<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('facebook_auth_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Foreign key to the users table
            $table->string('facebook_id')->unique(); // Unique Facebook ID
            $table->string('name'); // User's name
            $table->string('email')->nullable(); // User's email
            $table->string('access_token'); // Access token for the user
            $table->timestamp('token_expires_at')->nullable(); // Expiry time for the access token
            $table->timestamps();

            // Optional: Define foreign key constraint if you have a users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facebook_auth_users');
    }
};
