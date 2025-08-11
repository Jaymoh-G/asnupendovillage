<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // This migration is designed to safely handle any remaining foreign key constraints
        // that might be causing issues on the live site

        if (Schema::hasTable('facilities')) {
            // Check if program_id column still exists and has foreign key constraints
            if (Schema::hasColumn('facilities', 'program_id')) {
                // Use raw SQL to safely check and drop foreign keys
                $foreignKeys = $this->getForeignKeys('facilities', 'program_id');
                foreach ($foreignKeys as $foreignKey) {
                    try {
                        DB::statement("ALTER TABLE facilities DROP FOREIGN KEY {$foreignKey}");
                    } catch (\Exception $e) {
                        // Foreign key doesn't exist or can't be dropped, continue
                    }
                }

                // Use raw SQL to safely check and drop indexes
                $indexes = $this->getIndexes('facilities', 'program_id');
                foreach ($indexes as $index) {
                    try {
                        DB::statement("ALTER TABLE facilities DROP INDEX {$index}");
                    } catch (\Exception $e) {
                        // Index doesn't exist or can't be dropped, continue
                    }
                }

                // Now safely drop the program_id column
                Schema::table('facilities', function (Blueprint $table) {
                    $table->dropColumn('program_id');
                });
            }

            // Check and drop other columns that might still exist
            $columnsToCheck = [
                'program_description',
                'features',
                'accessibility_info',
                'features_list',
                'additional_info',
                'status',
                'capacity'
            ];

            foreach ($columnsToCheck as $column) {
                if (Schema::hasColumn('facilities', $column)) {
                    Schema::table('facilities', function (Blueprint $table) use ($column) {
                        $table->dropColumn($column);
                    });
                }
            }

            // Ensure content column exists
            if (!Schema::hasColumn('facilities', 'content')) {
                Schema::table('facilities', function (Blueprint $table) {
                    $table->text('content')->nullable()->after('description');
                });
            }
        }
    }

    /**
     * Get foreign key names for a specific column
     */
    private function getForeignKeys($table, $column)
    {
        $foreignKeys = [];
        try {
            $result = DB::select("
                SELECT CONSTRAINT_NAME
                FROM information_schema.KEY_COLUMN_USAGE
                WHERE TABLE_SCHEMA = DATABASE()
                AND TABLE_NAME = '{$table}'
                AND COLUMN_NAME = '{$column}'
                AND REFERENCED_TABLE_NAME IS NOT NULL
            ");

            foreach ($result as $row) {
                $foreignKeys[] = $row->CONSTRAINT_NAME;
            }
        } catch (\Exception $e) {
            // If we can't query the information schema, return empty array
        }

        return $foreignKeys;
    }

    /**
     * Get index names for a specific column
     */
    private function getIndexes($table, $column)
    {
        $indexes = [];
        try {
            $result = DB::select("
                SELECT INDEX_NAME
                FROM information_schema.STATISTICS
                WHERE TABLE_SCHEMA = DATABASE()
                AND TABLE_NAME = '{$table}'
                AND COLUMN_NAME = '{$column}'
            ");

            foreach ($result as $row) {
                $indexes[] = $row->INDEX_NAME;
            }
        } catch (\Exception $e) {
            // If we can't query the information schema, return empty array
        }

        return $indexes;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This is a cleanup migration, so down() doesn't need to recreate the dropped columns
        // as they were intentionally removed in the simplify_facilities_table_structure migration
    }
};
