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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->string('user_code')->nullable()->default(null);
            $table->ipAddress();
            $table->string('method')->nullable()->default(null);
            $table->string('route')->nullable()->default(null);
            $table->string('agent')->nullable()->default(null);
            $table->jsonb('payload')->nullable()->default(null);
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
