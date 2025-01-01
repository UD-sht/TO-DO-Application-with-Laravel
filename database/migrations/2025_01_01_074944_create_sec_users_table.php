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
        Schema::create('sec_users', function (Blueprint $table) {
            $table->unsignedInteger('user_code')->primary();
            $table->string('email_address')->unique();
            $table->string('password');
            $table->string('mobile_number')->nullable()->default(null);
            $table->string('full_name')->nullable()->default(null);
            $table->boolean('password_change_f_login')->default(true);
            $table->dateTime('password_expire_date')->nullable()->default(null);
            $table->dateTime('password_change_date')->nullable()->default(null);
            $table->dateTime('activated_at')->nullable()->default(null);
            $table->unsignedInteger('created_by')->nullable()->default(null);
            $table->unsignedInteger('updated_by')->nullable()->default(null);
            $table->rememberToken();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sec_users');
    }
};
