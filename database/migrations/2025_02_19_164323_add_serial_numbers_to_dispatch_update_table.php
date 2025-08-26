<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::table('dispatch_update', function (Blueprint $table) {
    //         $table->string('serial_no')->nullable()->after('cargo_size_id');
    //         $table->string('battery_serial_no')->nullable()->after('serial_no');

    //         $table->unsignedBigInteger('dealer_id')->nullable()->change();
    //     });
    // }

    // public function down(): void
    // {
    //     Schema::table('dispatch_update', function (Blueprint $table) {
    //         $table->dropColumn(['serial_no', 'battery_serial_no']);
    //     });
    // }

    public function up(): void
    {
        Schema::table('dispatch_update', function (Blueprint $table) {
            $table->string('serial_no')->nullable()->after('cargo_size_id');
            $table->string('battery_serial_no')->nullable()->after('serial_no');

            //  Check if foreign key exists before changing dealer_id
            if (Schema::hasColumn('dispatch_update', 'dealer_id')) {
                $table->dropForeign(['dealer_id']); // Drop the foreign key if it exists
            }

            //  Change dealer_id to nullable
            $table->unsignedBigInteger('dealer_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dispatch_update', function (Blueprint $table) {
            //  Remove added columns
            $table->dropColumn(['serial_no', 'battery_serial_no']);

            //  Restore dealer_id to NOT NULL (assuming it was originally NOT NULL)
            $table->unsignedBigInteger('dealer_id')->nullable(false)->change();
        });
    }
};
