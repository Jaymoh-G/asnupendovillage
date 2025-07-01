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
        Schema::table('news', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->text('content')->after('title');
            $table->text('excerpt')->nullable()->after('content');
            $table->string('slug')->unique()->after('excerpt');
            $table->string('featured_image')->nullable()->after('slug');
            $table->string('category')->after('featured_image');
            $table->string('author')->nullable()->after('category');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft')->after('author');
            $table->timestamp('published_at')->nullable()->after('status');
            $table->integer('views_count')->default(0)->after('published_at');
            $table->string('meta_title')->nullable()->after('views_count');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->json('tags')->nullable()->after('meta_description');

            $table->index('slug');
            $table->index('status');
            $table->index('category');
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropIndex(['status']);
            $table->dropIndex(['category']);
            $table->dropIndex(['published_at']);

            $table->dropColumn([
                'title',
                'content',
                'excerpt',
                'slug',
                'featured_image',
                'category',
                'author',
                'status',
                'published_at',
                'views_count',
                'meta_title',
                'meta_description',
                'tags',
            ]);
        });
    }
};
