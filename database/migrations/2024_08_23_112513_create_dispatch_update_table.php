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
        Schema::create('dispatch_update', function (Blueprint $table) {
            $table->id();
            $table->string('chasiss_no')->unique();
            $table->unsignedBigInteger('dealer_id')->nullable(false);
            $table->unsignedBigInteger('charger_modal_id');
            $table->unsignedBigInteger('battery_company_id');
            $table->unsignedBigInteger('battery_ah_id');
            $table->unsignedBigInteger('vehicle_type_id');
            $table->unsignedBigInteger('cargo_size_id')->nullable(true);

            $table->text('charger_picture')->nullable(true);
            $table->text('battery_picture')->nullable(true);
            $table->text('chassis_picture')->nullable(true);
            $table->enum('alloy', ['no', 'yes'])->default('no');
            $table->enum('carrier', ['no', 'yes'])->default('no');
            $table->string('dispatch_by')->nullable(true);            
            $table->string('dispatcher_name')->nullable(true);            
            
            $table->unsignedBigInteger('created_by')->nullable(true);
            $table->unsignedBigInteger('updated_by')->nullable(true);
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);

            $table->foreign('chasiss_no', 'FK_chasiss_noWithDispatchUpdate')->references('chassis_number')->on('chassis_data')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('dealer_id', 'FK_dealer_idWithDispatchUpdate')->references('id')->on('dealers')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('charger_modal_id', 'FK_charger_modal_idWithDispatchUpdate')->references('id')->on('charger_modals')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('battery_company_id', 'FK_battery_company_idWithDispatchUpdate')->references('id')->on('battery_company')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('battery_ah_id', 'FK_battery_ah_idWithDispatchUpdate')->references('id')->on('battery_ah')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('vehicle_type_id', 'FK_vehicle_type_idWithDispatchUpdate')->references('id')->on('vehicle_types')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('cargo_size_id', 'FK_cargo_size_idWithDispatchUpdate')->references('id')->on('cargo_sizes')->onDelete('restrict')->onUpdate('restrict');
            
            $table->foreign('created_by', 'FK_created_byWithDispatchUpdate')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('updated_by', 'FK_updated_byWithDispatchUpdate')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatch_update');
    }
};
