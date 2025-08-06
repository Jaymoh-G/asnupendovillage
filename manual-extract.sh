#!/bin/bash

echo "🚀 Laravel Manual Deployment Extraction"
echo "========================================"

# Check if deploy.zip exists
if [ ! -f "deploy.zip" ]; then
    echo "❌ deploy.zip not found!"
    echo "Please upload deploy.zip to this directory first."
    exit 1
fi

# Check file size
file_size=$(stat -c%s "deploy.zip")
file_size_mb=$(echo "scale=2; $file_size/1024/1024" | bc)
echo "📦 File size: ${file_size_mb} MB"

if [ "$file_size" -eq 0 ]; then
    echo "❌ deploy.zip is empty! Please download a valid file."
    exit 1
fi

# Check available disk space
free_space=$(df . | awk 'NR==2 {print $4}')
free_space_mb=$(echo "scale=2; $free_space*1024/1024/1024" | bc)
echo "💾 Available disk space: ${free_space_mb} GB"

# Test zip integrity
echo "🔍 Testing zip integrity..."
unzip -t deploy.zip > /dev/null 2>&1
if [ $? -ne 0 ]; then
    echo "❌ Zip file is corrupted or invalid!"
    echo "Please download the file again from GitHub Actions."
    exit 1
fi

echo "✅ Zip file is valid!"

# Show zip contents
echo "📁 Zip contents preview:"
unzip -l deploy.zip | head -10

# Extract files
echo "📂 Extracting files..."
unzip -o deploy.zip

if [ $? -eq 0 ]; then
    echo "✅ Files extracted successfully!"

    # Set permissions
    echo "🔐 Setting file permissions..."
    chmod -R 755 .
    chmod -R 775 storage 2>/dev/null || true
    chmod -R 775 bootstrap/cache 2>/dev/null || true

    # Clean up
    rm -f deploy.zip
    rm -f extract.php
    rm -f manual-extract.sh

    echo "🎉 Deployment Complete!"
    echo ""
    echo "Next steps:"
    echo "1. Set up your .env file with database credentials"
    echo "2. Run: php artisan migrate"
    echo "3. Run: php artisan storage:link"
    echo "4. Clear caches: php artisan config:clear && php artisan cache:clear"

else
    echo "❌ Extraction failed!"
    echo "Please check disk space and permissions."
fi

echo "========================================"
