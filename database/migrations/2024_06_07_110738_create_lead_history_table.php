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
        Schema::create('lead_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id')->nullable(false);
            $table->unsignedBigInteger('lead_status_id')->nullable(false);
            $table->text('comments')->nullable(false);
            $table->text('description')->nullable(true);
            $table->datetime('followup_date_time');
            $table->tinyInteger('is_new')->default(1);
            $table->tinyInteger('is_live')->default(1);
            $table->unsignedBigInteger('assign_to')->nullable(false);
            $table->tinyInteger('lead_type')->nullable(true);
            $table->unsignedBigInteger('created_by')->nullable(false);
            $table->unsignedBigInteger('updated_by')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);

            $table->foreign('assign_to', 'FK_assign_toWithlead_history')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('lead_id', 'FK_lead_idWithlead_history')->references('id')->on('leads')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('lead_status_id', 'FK_lead_status_idWithlead_history')->references('id')->on('leads_status')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('created_by', 'FK_created_byWithlead_history')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('updated_by', 'FK_updated_byWithlead_history')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_history');
    }
};
