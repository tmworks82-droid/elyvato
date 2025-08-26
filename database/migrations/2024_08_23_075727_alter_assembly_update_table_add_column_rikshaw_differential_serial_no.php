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
        Schema::table('assembly_update', function (Blueprint $table) {
            $table->text('rikshaw_differential_serial_no')->nullable(true)->after('rikshaw_differential_company_id');
            $table->text('rikshaw_differential_variants_id')->nullable(true)->after('rikshaw_differential_serial_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assembly_update', function (Blueprint $table) {
            $table->dropColumn('rikshaw_differential_serial_no');
            $table->dropColumn('rikshaw_differential_variants_id');
        });
    }
};
