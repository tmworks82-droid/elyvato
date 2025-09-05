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
            $table->text('talent_definition')->nullable()->after('bio');
            $table->integer('years_experience')->nullable()->after('talent_definition');
            $table->string('highest_qualification')->nullable()->after('years_experience');
            $table->string('languages_spoken')->nullable()->after('highest_qualification');
            $table->string('certification_file')->nullable()->after('languages_spoken');
            $table->string('portfolio_file')->nullable()->after('certification_file');
            $table->string('rate_card_file')->nullable()->after('portfolio_file');
            $table->string('account_holder_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('ifsc_code', 11)->nullable();
            $table->string('account_number', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
             $table->dropColumn([
                'talent_definition',
                'years_experience',
                'highest_qualification',
                'languages_spoken',
                'certification_file',
                'portfolio_file',
                'rate_card_file',
            ]);
        });
    }
};
