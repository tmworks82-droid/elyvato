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
        Schema::create('workflow_steps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workflow_id')->nullable(false);
            $table->string('step_name');
            $table->tinyInteger('is_child')->default(0);
            $table->string('child_module')->nullable(true);
            $table->unsignedBigInteger('assign_to')->nullable(false);
            $table->tinyInteger('is_live')->default(1);
            $table->unsignedBigInteger('created_by')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);

            $table->foreign('workflow_id', 'FK_workflowIdWithWorkflowSteps')->references('id')->on('workflows')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('assign_to', 'FK_assign_toWithWorkflowSteps')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('created_by', 'FK_created_byWithWorkflowSteps')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workflow_steps');
    }
};
