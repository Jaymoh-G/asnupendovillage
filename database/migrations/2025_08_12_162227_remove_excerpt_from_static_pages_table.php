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
            if (Schema::hasColumn('static_pages', 'excerpt')) {
                $table->dropColumn('excerpt');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('static_pages', function (Blueprint $table) {
            if (!Schema::hasColumn('static_pages', 'excerpt')) {
                $table->text('excerpt')->nullable()->after('content');
            }
        });
    }
};
