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
        Schema::create('static_pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_name')->unique(); // about-us, founder, etc.
            $table->string('title')->nullable(); // Page title
            $table->text('content')->nullable(); // Main content (HTML)
            $table->text('excerpt')->nullable(); // Short description
            $table->string('meta_title')->nullable(); // SEO meta title
            $table->text('meta_description')->nullable(); // SEO meta description
            $table->string('meta_keywords')->nullable(); // SEO meta keywords
            $table->string('featured_image')->nullable(); // Featured image path
            $table->boolean('is_active')->default(true); // Page status
            $table->integer('sort_order')->default(0); // For ordering pages
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('static_pages');
    }
};
