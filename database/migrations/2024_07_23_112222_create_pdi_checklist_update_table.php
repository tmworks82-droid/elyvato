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
        Schema::create('pdi_checklist_update', function (Blueprint $table) {
            $table->id();
            $table->string('chasiss_no');
            $table->unsignedBigInteger('pdi_id');
            $table->enum('pdi_status', ['pending', 'completed']);
            $table->unsignedBigInteger('created_by')->nullable(true);
            $table->unsignedBigInteger('updated_by')->nullable(true);
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);

            $table->foreign('chasiss_no', 'FK_chasiss_noWithPdiChecklistUpdate')->references('chassis_number')->on('chassis_data')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('pdi_id', 'FK_pdiIdWithPdiChecklistUpdate')->references('id')->on('pdi_checklists')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('created_by', 'FK_created_byWithPdiChecklistUpdate')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('updated_by', 'FK_updated_byWithPdiChecklistUpdate')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdi_checklist_update');
    }
};
