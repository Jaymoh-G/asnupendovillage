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

// Extract files
echo "<p>📂 Extracting files...</p>";
$extractResult = $zip->extractTo('./');

if ($extractResult === TRUE) {
    echo "<p style='color: green;'>✅ Files extracted successfully!</p>";

    // Count extracted files
    $fileCount = $zip->numFiles;
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
    system('chmod -R 755 . 2>&1', $chmodResult);
    system('chmod -R 775 storage 2>&1', $storageResult);
    system('chmod -R 775 bootstrap/cache 2>&1', $cacheResult);

    echo "<p style='color: green;'>✅ Permissions set!</p>";

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
    $zip->close();
}

echo "<hr>";
echo "<p><small>Extraction script completed at: " . date('Y-m-d H:i:s') . "</small></p>";
