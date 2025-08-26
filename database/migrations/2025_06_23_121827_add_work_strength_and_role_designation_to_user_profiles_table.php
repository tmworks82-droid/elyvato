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
            $table->integer('work_strength')->nullable()->after('company_name');
            $table->unsignedBigInteger('role_designation_id')->nullable()->after('work_strength');

            // Foreign key constraint
            $table->foreign('role_designation_id')
                  ->references('id')
                  ->on('role_designations')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropForeign(['role_designation_id']);
            $table->dropColumn(['work_strength', 'role_designation_id']);
        });

    }
};
