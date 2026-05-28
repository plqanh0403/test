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
            $table->string('name');
            $table->string('username')->unique();
            $table->string('role');
            $table->boolean('is_active')->default(true);
            $table->string('password');           
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('type');
            $table->boolean('is_actived')->default(true);
            $table->timestamps();
        });

        Schema::create('recruitments', function (Blueprint $table) {
            $table->id();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
        });

        Schema::create('aboutus', function (Blueprint $table) {
            $table->id();
        });

        Schema::create('emailsubmits', function (Blueprint $table) {
            $table->id();
        });

        Schema::create('contactsubmits', function (Blueprint $table) {
            $table->id();
        });

        Schema::create('media', function (Blueprint $table) {
            $table->id();
        });
    }
        
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('blogs');
    }
};
