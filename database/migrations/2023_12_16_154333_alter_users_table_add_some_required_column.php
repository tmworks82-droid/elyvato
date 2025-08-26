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
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable(true)->change();
            $table->string('email')->nullable(true)->change();
            $table->string('password')->nullable(true)->change();
            $table->string('mobile')->unique()->change();
            $table->text('email_key')->nullable(true)->after('password');
            $table->string('mobile_key', 8)->after('email_key');
            $table->tinyInteger('is_mobile_verify')->default(0)->after('is_email_verify');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('password')->nullable(false)->change();
            $table->dropUnique(['mobile']);
            $table->dropColumn('email_key');
            $table->dropColumn('mobile_key');
            $table->dropColumn('is_mobile_verify');
        });
    }
};
