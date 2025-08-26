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
        Schema::create('workflow_update', function (Blueprint $table) {
            $table->id();
            $table->string('chasiss_no');
            $table->unsignedBigInteger('workflow_step_id');
            $table->unsignedBigInteger('assign_to');
            $table->enum('work_status', ['pending', 'completed']);
            $table->unsignedBigInteger('created_by')->nullable(true);
            $table->unsignedBigInteger('updated_by')->nullable(true);
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);

            $table->foreign('chasiss_no', 'FK_chasiss_noWithWorkflowUpdate')->references('chassis_number')->on('chassis_data')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('workflow_step_id', 'FK_workflowStepIdWithWorkflowUpdate')->references('id')->on('workflow_steps')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('assign_to', 'FK_assign_toWithWorkflowUpdate')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('created_by', 'FK_created_byWorkflowUpdate')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('updated_by', 'FK_updated_byWorkflowUpdate')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workflow_update');
    }
};
