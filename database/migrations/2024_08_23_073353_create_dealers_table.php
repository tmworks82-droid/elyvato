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
        Schema::create('dealers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile')->unique();
            $table->string('company_name');
            $table->unsignedBigInteger('city_id')->nullable(true);
            $table->unsignedBigInteger('state_id')->nullable(true);
            $table->string('area');
            $table->string('pincode', 10);
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);

            $table->foreign('city_id', 'FK_city_idWithDealers')->references('id')->on('cities')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('state_id', 'FK_state_idWithDealers')->references('id')->on('states')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dealers');
    }
};
