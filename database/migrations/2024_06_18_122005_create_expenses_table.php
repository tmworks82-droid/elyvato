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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id')->nullable(false);
            $table->float('amount', 8, 2);
            $table->text('description');
            $table->string('photo');
            

            $table->tinyInteger('is_live')->default(1);
            $table->unsignedBigInteger('created_by')->nullable(false);


            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->foreign('type_id', 'FK_type_idWithExpenses')->references('id')->on('expense_type')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('created_by', 'FK_created_byWithExpenses')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
