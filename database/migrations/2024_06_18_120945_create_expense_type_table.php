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
        Schema::create('expense_type', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_slug');
            $table->tinyInteger('is_live')->default(1);
            $table->unsignedBigInteger('created_by')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->foreign('created_by', 'FK_created_byWithExpenseType')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_type');
    }
};
