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

        // Schema::table('workflow_steps', function (Blueprint $table) {

        //      //  Ensure the assign_to column exists before modifying it
        //      if (Schema::hasColumn('workflow_steps', 'assign_to')) {
        //         $table->unsignedBigInteger('assign_to')->comment('Assigns_to as department ID')->change();
        //     }else {
        //         //  If it exists, modify it
        //         $table->unsignedBigInteger('assign_to')->comment('Assigns_to as department ID')->change();
        //     }

        //     // Add the foreign key constraint to the assign_to column, referencing the departments table
        //     $table->foreign('assign_to')
        //         ->references('id') // Reference the id column of departments table
        //         ->on('dipartments') // On the departments table
        //         ->onDelete('restrict') // Restrict deletion if related department exists
        //         ->onUpdate('restrict'); // Restrict update if department ID changes
        // });
        Schema::table('workflow_steps', function (Blueprint $table) {
            // Drop existing foreign key referencing the admins table
            try {
                DB::statement('ALTER TABLE workflow_steps DROP FOREIGN KEY workflow_steps_assign_to_foreign');
            } catch (\Exception $e) {
                // Ignore error if the foreign key doesn't exist
            }

            // Modify assign_to column (ensure it is unsignedBigInteger)
            $table->unsignedBigInteger('assign_to')->comment('Assigns_to as department ID')->change();

            // Add new foreign key referencing the departments table
            $table->foreign('assign_to')
                ->references('id')
                ->on('dipartments') // Correct table name
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workflow_steps', function (Blueprint $table) {
            $table->dropForeign(['assign_to']); // Drop the foreign key constraint on assign_to
        });
    }
};
