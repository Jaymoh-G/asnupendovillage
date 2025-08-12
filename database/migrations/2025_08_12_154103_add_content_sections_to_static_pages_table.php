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
        Schema::table('static_pages', function (Blueprint $table) {
            // Section 1
            if (!Schema::hasColumn('static_pages', 'section1_title')) {
                $table->string('section1_title')->nullable()->after('images');
            }
            if (!Schema::hasColumn('static_pages', 'section1_content')) {
                $table->text('section1_content')->nullable()->after('section1_title');
            }
            if (!Schema::hasColumn('static_pages', 'section1_images')) {
                $table->json('section1_images')->nullable()->after('section1_content');
            }

            // Section 2
            if (!Schema::hasColumn('static_pages', 'section2_title')) {
                $table->string('section2_title')->nullable()->after('section1_images');
            }
            if (!Schema::hasColumn('static_pages', 'section2_content')) {
                $table->text('section2_content')->nullable()->after('section2_title');
            }
            if (!Schema::hasColumn('static_pages', 'section2_images')) {
                $table->json('section2_images')->nullable()->after('section2_content');
            }

            // Section 3
            if (!Schema::hasColumn('static_pages', 'section3_title')) {
                $table->string('section3_title')->nullable()->after('section2_images');
            }
            if (!Schema::hasColumn('static_pages', 'section3_content')) {
                $table->text('section3_content')->nullable()->after('section3_title');
            }
            if (!Schema::hasColumn('static_pages', 'section3_images')) {
                $table->json('section3_images')->nullable()->after('section3_content');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('static_pages', function (Blueprint $table) {
            // Drop Section 1
            if (Schema::hasColumn('static_pages', 'section1_title')) {
                $table->dropColumn('section1_title');
            }
            if (Schema::hasColumn('static_pages', 'section1_content')) {
                $table->dropColumn('section1_content');
            }
            if (Schema::hasColumn('static_pages', 'section1_images')) {
                $table->dropColumn('section1_images');
            }

            // Drop Section 2
            if (Schema::hasColumn('static_pages', 'section2_title')) {
                $table->dropColumn('section2_title');
            }
            if (Schema::hasColumn('static_pages', 'section2_content')) {
                $table->dropColumn('section2_content');
            }
            if (Schema::hasColumn('static_pages', 'section2_images')) {
                $table->dropColumn('section2_images');
            }

            // Drop Section 3
            if (Schema::hasColumn('static_pages', 'section3_title')) {
                $table->dropColumn('section3_title');
            }
            if (Schema::hasColumn('static_pages', 'section3_content')) {
                $table->dropColumn('section3_content');
            }
            if (Schema::hasColumn('static_pages', 'section3_images')) {
                $table->dropColumn('section3_images');
            }
        });
    }
};
