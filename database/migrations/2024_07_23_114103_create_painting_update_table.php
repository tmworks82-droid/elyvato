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
        Schema::create('painting_update', function (Blueprint $table) {
            $table->id();
            $table->string('chasiss_no')->unique();
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('created_by')->nullable(true);
            $table->unsignedBigInteger('updated_by')->nullable(true);
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);

            $table->foreign('chasiss_no', 'FK_chasiss_noWithPaintingUpdate')->references('chassis_number')->on('chassis_data')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('color_id', 'FK_ColorIdWithPaintingUpdate')->references('id')->on('colors')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('created_by', 'FK_created_byWithPaintingUpdate')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('updated_by', 'FK_updated_byWithPaintingUpdate')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('painting_update');
    }
};
