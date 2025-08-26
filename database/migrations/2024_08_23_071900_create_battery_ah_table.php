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
        Schema::create('battery_ah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('battery_company_id')->nullable(false);
            $table->string('name');
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);

            
            $table->foreign('battery_company_id', 'FK_BatteryCompanyIdWithBatteryAh')->references('id')->on('battery_company')->onDelete('restrict')->onUpdate('restrict');
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battery_ah');
    }
};
