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
        // First, check if the foreign key constraint exists and drop it safely
        if (Schema::hasTable('facilities')) {
            Schema::table('facilities', function (Blueprint $table) {
                // Check if foreign key exists before trying to drop it
                try {
                    $table->dropForeign(['program_id']);
                } catch (\Exception $e) {
                    // Foreign key doesn't exist, continue
                }

                // Check if index exists before trying to drop it
                try {
                    $table->dropIndex(['program_id']);
                } catch (\Exception $e) {
                    // Index doesn't exist, continue
                }
            });
        }

        Schema::table('facilities', function (Blueprint $table) {
            // Add content field if it doesn't exist
            if (!Schema::hasColumn('facilities', 'content')) {
                $table->text('content')->nullable()->after('description');
            }

            // Drop columns safely - check if they exist first
            $columnsToDrop = [
                'program_description',
                'features',
                'accessibility_info',
                'features_list',
                'additional_info',
                'program_id',
                'status',
                'capacity'
            ];

            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('facilities', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            // Recreate dropped fields
            $table->text('program_description')->nullable()->after('description');
            $table->text('features')->nullable()->after('program_description');
            $table->text('accessibility_info')->nullable()->after('features');
            $table->text('features_list')->nullable()->after('accessibility_info');
            $table->text('additional_info')->nullable()->after('features_list');
            $table->unsignedBigInteger('program_id')->nullable()->after('additional_info');
            $table->enum('status', ['active', 'inactive'])->default('active')->after('program_id');
            $table->integer('capacity')->nullable()->after('status');

            // Drop content field
            $table->dropColumn('content');
        });

        Schema::table('facilities', function (Blueprint $table) {
            // Recreate foreign key and indexes
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('set null');
            $table->index('program_id');
            $table->index('status');
        });
    }
};
