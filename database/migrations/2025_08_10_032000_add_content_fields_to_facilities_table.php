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
        Schema::table('facilities', function (Blueprint $table) {
            $table->text('program_description')->nullable()->after('description');
            $table->text('features')->nullable()->after('program_description');
            $table->text('accessibility_info')->nullable()->after('features');
            $table->text('features_list')->nullable()->after('accessibility_info');
            $table->text('additional_info')->nullable()->after('features_list');
            $table->text('meta_description')->nullable()->after('additional_info');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->dropColumn([
                'program_description',
                'features',
                'accessibility_info',
                'features_list',
                'additional_info',
                'meta_description'
            ]);
        });
    }
};
