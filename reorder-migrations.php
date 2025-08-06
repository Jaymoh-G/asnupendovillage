<?php

/**
 * Migration Reordering Script
 * This script reorders migrations to handle dependencies properly
 */

$migrations = [
    // 1. Core Laravel tables (no dependencies)
    '0001_01_01_000000_create_users_table.php',
    '0001_01_01_000001_create_cache_table.php',
    '0001_01_01_000002_create_jobs_table.php',

    // 2. Base tables (no foreign key dependencies)
    '2025_01_01_000000_create_images_table.php',
    '2025_01_01_000001_create_albums_table.php',
    '2025_01_01_000003_create_home_sliders_table.php',
    '2025_01_01_000010_create_programs_table.php',
    '2025_01_01_000001_create_page_banners_table.php',
    '2025_01_01_000002_create_events_table.php',

    // 3. Independent content tables
    '2025_07_01_113218_create_news_table.php',
    '2025_07_02_112815_create_testimonials_table.php',
    '2025_07_02_121341_create_teams_table.php',
    '2025_07_02_122306_create_facilities_table.php',
    '2025_07_02_124411_create_projects_table.php',
    '2025_07_02_130334_create_program_team_table.php',
    '2025_07_02_131533_create_permission_tables.php',
    '2025_07_23_054542_create_donations_table.php',
    '2025_07_23_055325_create_downloads_table.php',
    '2025_07_23_055611_create_careers_table.php',
    '2025_07_28_074935_create_galleries_table.php',
    '2025_07_29_000001_add_slug_to_careers_table.php',
    '2025_07_31_061407_create_home_page_contents_table.php',
    '2025_07_31_101040_create_settings_table.php',
    '2025_07_29_180834_create_static_pages_table.php',

    // 4. Tables with foreign key dependencies (run after base tables)
    '2025_01_01_000005_add_gallery_id_to_albums.php',
    '2025_07_28_131030_add_sort_order_and_gallery_id_to_albums_table.php',
    '2025_07_28_143801_add_slug_to_projects_table.php',
    '2025_07_28_181249_add_capacity_and_slug_to_facilities_table.php',
    '2025_07_29_075158_add_slug_to_teams_table.php',
    '2025_07_29_075447_add_slug_to_teams_table_simple.php',
    '2025_07_29_083142_add_position_to_testimonials_table.php',
    '2025_07_29_084523_remove_status_from_testimonials_table.php',
    '2025_07_29_091151_remove_status_from_testimonials_table.php',
    '2025_07_31_094258_add_bank_to_payment_methods_in_donations_table.php',
];

$migrationsDir = 'database/migrations/';
$tempDir = 'database/migrations/temp/';

// Create temp directory
if (!is_dir($tempDir)) {
    mkdir($tempDir, 0755, true);
}

echo "🔄 Reordering migrations...\n";

// Move files to temp directory with new timestamps
foreach ($migrations as $index => $migration) {
    $oldPath = $migrationsDir . $migration;
    if (file_exists($oldPath)) {
        // Create new timestamp (2025_01_01_000000 + index)
        $newTimestamp = sprintf('2025_01_01_%06d', $index);
        $newName = $newTimestamp . '_' . substr($migration, strpos($migration, '_', 4) + 1);
        $newPath = $tempDir . $newName;

        copy($oldPath, $newPath);
        echo "✅ Moved: $migration -> $newName\n";
    } else {
        echo "⚠️  Missing: $migration\n";
    }
}

// Backup original migrations
$backupDir = 'database/migrations/backup_' . date('Y_m_d_H_i_s') . '/';
mkdir($backupDir, 0755, true);

// Move original files to backup
$originalFiles = glob($migrationsDir . '*.php');
foreach ($originalFiles as $file) {
    $filename = basename($file);
    copy($file, $backupDir . $filename);
}

// Move reordered files back
$reorderedFiles = glob($tempDir . '*.php');
foreach ($reorderedFiles as $file) {
    $filename = basename($file);
    copy($file, $migrationsDir . $filename);
}

// Clean up temp directory
array_map('unlink', glob($tempDir . '*.php'));
rmdir($tempDir);

echo "\n🎉 Migration reordering complete!\n";
echo "📁 Original migrations backed up to: $backupDir\n";
echo "📋 New migration order:\n";

$finalFiles = glob($migrationsDir . '*.php');
sort($finalFiles);
foreach ($finalFiles as $file) {
    echo "  - " . basename($file) . "\n";
}

echo "\n💡 Next steps:\n";
echo "1. Update your .env file with correct database credentials\n";
echo "2. Run: php artisan migrate:fresh\n";
echo "3. Run: php artisan db:seed\n";
