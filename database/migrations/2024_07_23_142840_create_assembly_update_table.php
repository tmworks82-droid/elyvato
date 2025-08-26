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
        Schema::create('assembly_update', function (Blueprint $table) {
            $table->id();
            $table->string('chasiss_no')->unique();
            $table->unsignedBigInteger('rikshaw_model_id');
            $table->unsignedBigInteger('rikshaw_differential_company_id');
            $table->unsignedBigInteger('created_by')->nullable(true);
            $table->unsignedBigInteger('updated_by')->nullable(true);
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);

            $table->foreign('chasiss_no', 'FK_chasiss_noWithAssemblyUpdate')->references('chassis_number')->on('chassis_data')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('rikshaw_model_id', 'FK_rikshaw_model_idWithAssemblyUpdate')->references('id')->on('rikshaw_model')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('rikshaw_differential_company_id', 'FK_rikshaw_differential_company_idWithAssemblyUpdate')->references('id')->on('rikshaw_differential_company')->onDelete('restrict')->onUpdate('restrict');
            
            $table->foreign('created_by', 'FK_created_byWithAssemblyUpdate')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('updated_by', 'FK_updated_byWithAssemblyUpdate')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assembly_update');
    }
};
