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
         Schema::table('admins', function (Blueprint $table) {
             //  Check if column exists before dropping it
             if (Schema::hasColumn('admins', 'department_id')) {
                 $table->dropForeign(['department_id']); // Drop the foreign key constraint
                 $table->dropColumn('department_id'); // Drop the department_id column
             }
 
             //  Add the new department_id column
             $table->unsignedBigInteger('department_id')->nullable()->after('role_id');
             $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null'); 
         });
     }
 
     /**
      * Reverse the migrations.
      */
     public function down(): void
     {
         Schema::table('admins', function (Blueprint $table) {
             // Check if column exists before dropping it
             if (Schema::hasColumn('admins', 'department_id')) {
                 $table->dropForeign(['department_id']);
                 $table->dropColumn('department_id');
             }
         });
     }
};
