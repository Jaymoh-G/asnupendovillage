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
        Schema::table('testimonials', function (Blueprint $table) {
            // Rename body column to content if it exists
            if (Schema::hasColumn('testimonials', 'body')) {
                $table->renameColumn('body', 'content');
            }

            // Add missing columns if they don't exist
            if (!Schema::hasColumn('testimonials', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('content');
            }

            if (!Schema::hasColumn('testimonials', 'title')) {
                $table->string('title')->nullable()->after('name');
            }

            // Ensure pdf_file column exists (it should from previous migration)
            if (!Schema::hasColumn('testimonials', 'pdf_file')) {
                $table->string('pdf_file')->nullable()->after('content');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            // Rename content column back to body if it exists
            if (Schema::hasColumn('testimonials', 'content')) {
                $table->renameColumn('content', 'body');
            }

            // Remove added columns
            if (Schema::hasColumn('testimonials', 'is_featured')) {
                $table->dropColumn('is_featured');
            }

            if (Schema::hasColumn('testimonials', 'title')) {
                $table->dropColumn('title');
            }

            if (Schema::hasColumn('testimonials', 'pdf_file')) {
                $table->dropColumn('pdf_file');
            }
        });
    }
};
