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
              // Dropdown selection
            $table->string('gov_id_type')->nullable()->after('languages_spoken');

            // Passport fields
            $table->string('passport_front')->nullable()->after('gov_id_type');
            $table->string('passport_back')->nullable()->after('passport_front');
        
            // Driving license field
            $table->string('driving_license')->nullable()->after('passport_back');
            $table->string('aadhaar_front')->nullable()->after('driving_license');
            $table->string('aadhaar_back')->nullable()->after('aadhaar_front');
            $table->string('pan')->nullable()->after('aadhaar_back');
        });
    }

    /**
     * Reverse the migrations.
     */
    
    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn(['gov_id_type', 'passport_front', 'passport_back', 'driving_license']);
        });
    }
};
