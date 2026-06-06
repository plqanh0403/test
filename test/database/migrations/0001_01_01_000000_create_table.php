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
            $table->string('slug')->unique();
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
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps(); // created_at và updated_at
        });

        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('slug')->unique();
            $table->enum('type', ['EGEAD-activity', 'tech-service']);
            $table->string('title');
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->boolean('is_visible')->default(true);
            $table->longText('content');
            $table->text('excerpt')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('thumbnail_alt')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('recruitments', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->text('description');
            $table->text('requirements');
            $table->text('benefits');
            $table->string('location');
            $table->string('work_time');
            $table->enum('work_type', ['full-time', 'part-time', 'remote', 'hybrid']);
            $table->timestamp('application_deadline')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('thumbnail_alt')->nullable();
            $table->enum('status', ['open', 'paused', 'closed'])->default('open');
            $table->string('slug')->unique();
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });

        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('description');
            $table->string('banner_image')->nullable();
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->text('thumbnail')->nullable();
            $table->string('thumbnail_alt')->nullable();
            $table->text('overview')->nullable();
            $table->text('details')->nullable();
            $table->string('slug')->unique();
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('about_us', function (Blueprint $table) {
            $table->id();

            // Company
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('thumbnail')->nullable();
            $table->string('thumbnail_alt')->nullable();

            // Logo and Favicon
            $table->string('light_logo')->nullable();
            $table->string('dark_logo')->nullable();
            $table->string('favicon')->nullable();

            // Social
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('tiktok')->nullable();

            // Description
            $table->longText('description')->nullable();
            $table->text('footer_text')->nullable();

            // HR Contact
            $table->string('hr_email');
            $table->string('hr_phone');

            // Google Map
            $table->longText('google_map')->nullable();

            // SEO
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->string('og_image')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('canonical_url')->nullable();
            $table->text('google_site_verification')->nullable();
            $table->longText('google_analytics')->nullable();
            $table->longText('meta_pixel')->nullable();

            $table->timestamps();
        });

        Schema::create('submit_emails', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('source')->nullable();
            $table->enum('status', ['pending', 'processing', 'processed'])->default('pending');
            $table->timestamps();
        });

        Schema::create('submit_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->text('message');
            $table->enum('status', ['new', 'seen', 'processing', 'processed'])->default('new');
            $table->string('internal_note')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('recruitments');
        Schema::dropIfExists('serviceCategories');
        Schema::dropIfExists('services');
        Schema::dropIfExists('aboutus');
        Schema::dropIfExists('emailsubmits');
        Schema::dropIfExists('contactsubmits');
        Schema::dropIfExists('media');
    }
};
