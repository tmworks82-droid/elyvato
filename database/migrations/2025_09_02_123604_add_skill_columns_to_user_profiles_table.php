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
        Schema::table('user_profiles', function (Blueprint $table) {
             $table->string('understanding')->nullable()->after('bio');
             $table->string('creative')->nullable()->after('understanding');
            $table->string('tech_knowledge')->nullable()->after('creative');
            $table->string('final_score')->nullable()->after('tech_knowledge');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn(['understanding', 'tech_knowledge', 'final_score']);
        });
    }
};
