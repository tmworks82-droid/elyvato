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
                $table->string('serial_no')->nullable()->after('cargo_size_id');
                $table->string('battery_serial_no')->nullable()->after('serial_no');
    
                $table->unsignedBigInteger('dealer_id')->nullable()->change();
                $table->unsignedBigInteger('charger_modal_id')->nullable()->change();
                $table->unsignedBigInteger('battery_company_id')->nullable()->change();
                $table->unsignedBigInteger('battery_ah_id')->nullable()->change();
                $table->unsignedBigInteger('vehicle_type_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    
    public function down(): void
    {
        Schema::table('dispatch_update', function (Blueprint $table) {
            $table->dropColumn(['serial_no', 'battery_serial_no']);

        });
    }
};
