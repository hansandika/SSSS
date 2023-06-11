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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->enum('gender', ['male', 'female', 'non-binary']);
            $table->boolean('glc_verified')->default(false);
            $table->string('avatar')->nullable();
            $table->longText('biography')->nullable();
            $table->timestamp('date_of_birth')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
