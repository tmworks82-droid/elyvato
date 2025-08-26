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
        Schema::table('dispatch_update', function (Blueprint $table) {
            $table->enum('bill_status', [1, 2])->default(2)
                  ->comment('1 = yes, 2 = no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dispatch_update', function (Blueprint $table) {
            $table->dropColumn('bill_status');
        });
    }
};
