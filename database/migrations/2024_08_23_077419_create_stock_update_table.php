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
        Schema::create('stock_update', function (Blueprint $table) {
            $table->id();
            $table->string('chasiss_no')->unique();
            $table->unsignedBigInteger('motor_controller_company_id');
            $table->unsignedBigInteger('motor_controller_variant_id');
            $table->text('motor_controller_serial_no');
            $table->text('controller_serial_no');
            
            $table->unsignedBigInteger('created_by')->nullable(true);
            $table->unsignedBigInteger('updated_by')->nullable(true);
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);

            $table->foreign('chasiss_no', 'FK_chasiss_noWithStockUpdate')->references('chassis_number')->on('chassis_data')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('motor_controller_company_id', 'FK_motor_controller_company_idWithStockUpdate')->references('id')->on('moter_controller_companies')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('motor_controller_variant_id', 'FK_motor_controller_variant_idWithStockUpdate')->references('id')->on('moter_controller_variants')->onDelete('restrict')->onUpdate('restrict');
            
            
            $table->foreign('created_by', 'FK_created_byWithStockUpdate')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('updated_by', 'FK_updated_byWithStockUpdate')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_update');
    }
};
