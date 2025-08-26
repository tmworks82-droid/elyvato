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
        Schema::create('case_studies', function (Blueprint $table) {
            $table->id(); // Automatically creates an auto-incrementing 'id' field
            $table->string('title'); // Title of the case study
            $table->string('project_type'); // Type of the project
            $table->string('featured_image')->nullable(); // Path to the featured image
            $table->boolean('is_featured')->default(false); // Whether it's a featured case study or not
            $table->timestamps(); // Automatically adds 'created_at' and 'updated_at' timestamps

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_studies');
    }
};
