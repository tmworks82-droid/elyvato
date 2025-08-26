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
        Schema::table('workflow_update', function (Blueprint $table) {
            // $table->dropForeign('FK_assign_toWithWorkflowUpdate');

            // Check if foreign key exists before dropping it
            if (Schema::hasColumn('workflow_update', 'assign_to')) {
                $table->dropForeign(['assign_to']); // Drop foreign key
            }

             //  Fix table name from "dipartments" to "departments"
            //  Check if the column exists before modifying it
            if (Schema::hasColumn('workflow_update', 'assign_to')) {
                $table->unsignedBigInteger('assign_to')->comment('Assigns_to as department ID')->change();
            } else {
                //  Add column if missing
                $table->unsignedBigInteger('assign_to')->nullable()->comment('Assigns_to as department ID');
            }

            // $table->unsignedBigInteger('assign_to')->comment('Assigns_to as departments ID')->change();
            // $table->foreign('assign_to', 'FK_assign_toWithWorkflowUpdate')->references('id')->on('dipartments')->onDelete('restrict')->onUpdate('restrict');

              // Re-add foreign key with correct table name
              $table->foreign('assign_to', 'FK_assign_toWithWorkflowUpdate')
              ->references('id')->on('dipartments') // Correct table name
              ->onDelete('restrict')
              ->onUpdate('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workflow_update', function (Blueprint $table) {
            // $table->dropForeign('FK_assign_toWithWorkflowUpdate'); // Drop the foreign key constraint on assign_to
            // Add the foreign key constraint to the assign_to column, referencing the departments table
            // $table->foreign('assign_to', 'FK_assign_toWithWorkflowUpdate')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');

            if (Schema::hasColumn('workflow_update', 'assign_to')) {
                $table->dropForeign(['assign_to']);
                $table->dropColumn('assign_to');
            }

        });
    }
};
