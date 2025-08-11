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
        Schema::table('careers', function (Blueprint $table) {
            // Add new fields
            $table->longText('content')->nullable()->after('description');
            $table->string('pdf_file')->nullable()->after('content');

            // Drop the location field
            $table->dropColumn('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('careers', function (Blueprint $table) {
            // Recreate the location field
            $table->string('location')->nullable()->after('description');

            // Drop the new fields
            $table->dropColumn(['content', 'pdf_file']);
        });
    }
};
