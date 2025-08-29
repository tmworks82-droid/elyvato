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
        Schema::table('hire_talent', function (Blueprint $table) {
             $table->string('seo_title')->nullable()->after('title');
            $table->text('meta_description')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hire_talent', function (Blueprint $table) {
             $table->dropColumn(['seo_title', 'meta_description']);
        });
    }
};
