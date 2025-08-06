<?php

/**
 * Manual Extraction Script for Laravel Deployment
 * Upload this file to your server and run it to extract deploy.zip
 */

echo "<h2>🚀 Laravel Deployment Extraction</h2>";

// Check if deploy.zip exists
if (!file_exists('deploy.zip')) {
    echo "<p style='color: red;'>❌ deploy.zip not found!</p>";
    echo "<p>Please upload deploy.zip to this directory first.</p>";
    exit;
}

// Check file size
$fileSize = filesize('deploy.zip');
echo "<p>📦 File size: " . number_format($fileSize / 1024 / 1024, 2) . " MB</p>";

// Check available disk space
$freeSpace = disk_free_space('.');
$freeSpaceMB = round($freeSpace / 1024 / 1024, 2);
echo "<p>💾 Available disk space: " . number_format($freeSpaceMB, 2) . " MB</p>";

if ($freeSpaceMB < 100) {
    echo "<p style='color: orange;'>⚠️ Warning: Low disk space! You need at least 100MB free.</p>";
}

// Check current directory permissions
$currentDir = getcwd();
echo "<p>📁 Current directory: $currentDir</p>";
echo "<p>🔐 Directory writable: " . (is_writable('.') ? '✅ Yes' : '❌ No') . "</p>";

// Check if zip file is valid
$zip = new ZipArchive();
$result = $zip->open('deploy.zip');

if ($result !== TRUE) {
    echo "<p style='color: red;'>❌ Invalid or corrupted zip file!</p>";
    echo "<p>Error code: $result</p>";

    // Try to repair or provide alternative
    echo "<h3>🔧 Troubleshooting:</h3>";
    echo "<ul>";
    echo "<li>Make sure the file was uploaded completely</li>";
    echo "<li>Try downloading the file again from GitHub Actions</li>";
    echo "<li>Check if the file transfer was interrupted</li>";
    echo "</ul>";
    exit;
}

echo "<p style='color: green;'>✅ Zip file is valid!</p>";

// Get zip file info
$fileCount = $zip->numFiles;
$totalSize = 0;
for ($i = 0; $i < $fileCount; $i++) {
    $totalSize += $zip->statIndex($i)['size'];
}
$totalSizeMB = round($totalSize / 1024 / 1024, 2);

echo "<p>📊 Total files in zip: $fileCount</p>";
echo "<p>📏 Estimated extraction size: " . number_format($totalSizeMB, 2) . " MB</p>";

// Check if we have enough space
if ($freeSpaceMB < $totalSizeMB) {
    echo "<p style='color: red;'>❌ Not enough disk space! Need " . number_format($totalSizeMB, 2) . " MB, have " . number_format($freeSpaceMB, 2) . " MB</p>";
    $zip->close();
    exit;
}

// Extract files with detailed error handling
echo "<p>📂 Extracting files...</p>";

// Try to create a test directory first
$testDir = 'test_extract_' . time();
if (!mkdir($testDir, 0755, true)) {
    echo "<p style='color: red;'>❌ Cannot create directories - permission issue!</p>";
    echo "<p>Current permissions: " . substr(sprintf('%o', fileperms('.')), -4) . "</p>";
    $zip->close();
    exit;
}
rmdir($testDir);

// Extract files
$extractResult = $zip->extractTo('./');

if ($extractResult === TRUE) {
    echo "<p style='color: green;'>✅ Files extracted successfully!</p>";

    // Count extracted files
    echo "<p>📊 Total files extracted: $fileCount</p>";

    // Show some extracted files
    echo "<h3>📁 Extracted files (first 10):</h3>";
    echo "<ul>";
    for ($i = 0; $i < min(10, $fileCount); $i++) {
        $filename = $zip->getNameIndex($i);
        echo "<li>$filename</li>";
    }
    if ($fileCount > 10) {
        echo "<li>... and " . ($fileCount - 10) . " more files</li>";
    }
    echo "</ul>";

    // Set permissions
    echo "<p>🔐 Setting file permissions...</p>";
    $chmodResult = system('chmod -R 755 . 2>&1', $chmodReturn);
    $storageResult = system('chmod -R 775 storage 2>&1', $storageReturn);
    $cacheResult = system('chmod -R 775 bootstrap/cache 2>&1', $cacheReturn);

    if ($chmodReturn === 0 && $storageReturn === 0 && $cacheResult === 0) {
        echo "<p style='color: green;'>✅ Permissions set successfully!</p>";
    } else {
        echo "<p style='color: orange;'>⚠️ Some permission commands failed, but continuing...</p>";
    }

    // Clean up
    $zip->close();
    unlink('deploy.zip');
    unlink('extract.php');

    echo "<h3>🎉 Deployment Complete!</h3>";
    echo "<p>Your Laravel application has been deployed successfully.</p>";
    echo "<p><strong>Next steps:</strong></p>";
    echo "<ul>";
    echo "<li>Set up your .env file with database credentials</li>";
    echo "<li>Run: <code>php artisan migrate</code></li>";
    echo "<li>Run: <code>php artisan storage:link</code></li>";
    echo "<li>Clear caches: <code>php artisan config:clear && php artisan cache:clear</code></li>";
    echo "</ul>";
} else {
    echo "<p style='color: red;'>❌ Failed to extract files!</p>";

    // Get detailed error information
    echo "<h3>🔍 Debug Information:</h3>";
    echo "<ul>";
    echo "<li>PHP version: " . PHP_VERSION . "</li>";
    echo "<li>ZipArchive available: " . (class_exists('ZipArchive') ? 'Yes' : 'No') . "</li>";
    echo "<li>Current user: " . get_current_user() . "</li>";
    echo "<li>Process user ID: " . getmyuid() . "</li>";
    echo "<li>Process group ID: " . getmygid() . "</li>";
    echo "<li>Memory limit: " . ini_get('memory_limit') . "</li>";
    echo "<li>Max execution time: " . ini_get('max_execution_time') . " seconds</li>";
    echo "</ul>";

    // Try alternative extraction method
    echo "<h3>🔄 Trying alternative extraction method...</h3>";

    // Use system unzip command
    $unzipResult = system('unzip -o deploy.zip 2>&1', $unzipReturn);

    if ($unzipReturn === 0) {
        echo "<p style='color: green;'>✅ Alternative extraction successful!</p>";

        // Clean up
        unlink('deploy.zip');
        unlink('extract.php');

        echo "<h3>🎉 Deployment Complete!</h3>";
        echo "<p>Your Laravel application has been deployed successfully using alternative method.</p>";
    } else {
        echo "<p style='color: red;'>❌ Alternative extraction also failed!</p>";
        echo "<p>Unzip output: $unzipResult</p>";

        echo "<h3>🔧 Manual Steps:</h3>";
        echo "<ol>";
        echo "<li>SSH into your server</li>";
        echo "<li>Navigate to: $currentDir</li>";
        echo "<li>Run: <code>unzip -o deploy.zip</code></li>";
        echo "<li>Run: <code>chmod -R 755 .</code></li>";
        echo "<li>Run: <code>chmod -R 775 storage bootstrap/cache</code></li>";
        echo "</ol>";
    }

    $zip->close();
}

echo "<hr>";
echo "<p><small>Extraction script completed at: " . date('Y-m-d H:i:s') . "</small></p>";
