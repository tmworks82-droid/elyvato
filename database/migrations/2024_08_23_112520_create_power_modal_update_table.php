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
        Schema::create('power_modal_updates', function (Blueprint $table) {
            $table->id();
            $table->string('chasiss_no')->unique();
            $table->unsignedBigInteger('power_modal_id');
            $table->unsignedBigInteger('created_by')->nullable(true);
            $table->unsignedBigInteger('updated_by')->nullable(true);
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);

            $table->foreign('chasiss_no', 'FK_chasiss_noWithPowerModalUpdate')->references('chassis_number')->on('chassis_data')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('power_modal_id', 'FK_PowerModalIdWithPowerModalUpdate')->references('id')->on('rikshaw_power_modal')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('created_by', 'FK_created_byWithPowerModalUpdate')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('updated_by', 'FK_updated_byWithPowerModalUpdate')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('power_modal_updates');
    }
};
