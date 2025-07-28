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
        Schema::create('page_banners', function (Blueprint $table) {
            $table->id();
            $table->string('page_name')->unique(); // e.g., 'downloads', 'news', 'contact'
            $table->string('title')->nullable(); // Page title
            $table->text('description')->nullable(); // Page description
            $table->string('banner_image_path')->nullable(); // Path to banner image
            $table->string('banner_image_alt')->nullable(); // Alt text for banner
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_banners');
    }
};
