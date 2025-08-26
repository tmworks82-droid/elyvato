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
        Schema::table('leads', function (Blueprint $table) {
            // Add the new column lead_status_id
            $table->unsignedBigInteger('lead_status_id')->nullable()->after('lead_priority_id');
            
            // Correct the foreign key constraint with leads_status table
            $table->foreign('lead_status_id', 'FK_lead_status_idWithLeads')
                ->references('id')
                ->on('leads_status') // Correct table reference
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            // Drop the foreign key and column
            $table->dropForeign('FK_lead_status_idWithLeads');
            $table->dropColumn('lead_status_id');
        });
    }
};
