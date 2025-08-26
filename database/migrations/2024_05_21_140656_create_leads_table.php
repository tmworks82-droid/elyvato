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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('india_mart_id')->nullable(true);

            $table->unsignedBigInteger('campaign_id')->nullable(true);
            $table->unsignedBigInteger('service_id')->nullable(true);
            $table->unsignedBigInteger('lead_priority_id')->nullable(false);
            $table->unsignedBigInteger('state_id')->nullable(true);
            $table->unsignedBigInteger('city_id')->nullable(true);

            $table->string('name')->nullable(false);
            $table->string('mobile')->nullable(false); 
            $table->string('email')->nullable(true);
            $table->unsignedBigInteger('assign_to')->nullable(false);
            $table->json('tags_id')->nullable(true);

            $table->string('dealer_company_name')->nullable(true);
            $table->string('currently_dealing_in')->nullable(true);
            $table->string('photo')->nullable(true);


            $table->string('state_name')->nullable(true);
            $table->string('city_name')->nullable(true);

            $table->tinyInteger('lead_type')->nullable(true);

            $table->tinyInteger('is_live')->default(1);
            $table->unsignedBigInteger('created_by')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);

            $table->foreign('campaign_id', 'FK_campaign_idWithLeads')->references('id')->on('campaigns')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('service_id', 'FK_service_idWithLeads')->references('id')->on('services')->onDelete('restrict')->onUpdate('restrict');            
            $table->foreign('lead_priority_id', 'FK_lead_priority_idWithLeads')->references('id')->on('leads_priority')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('state_id', 'FK_state_idWithLeads')->references('id')->on('states')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('city_id', 'FK_city_idWithLeads')->references('id')->on('cities')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('assign_to', 'FK_assign_toWithLeads')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('created_by', 'FK_created_byWithLeads')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
