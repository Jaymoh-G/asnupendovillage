# News Image Management System

## Overview

The News Image Management System automatically handles images uploaded through both dedicated image fields and the RichEditor content field. All images are unified and displayed in the "Current Images" section for easy management.

## How It Works

### 1. RichEditor Image Uploads

-   Images uploaded through the rich content editor are automatically detected
-   They are processed and added to the image management system
-   URLs are generated using the `APP_URL` configuration from your `.env` file

### 2. Dedicated Image Fields

-   Images uploaded through the "Upload New Images with Captions" section
-   Support for captions, featured image selection, and ordering
-   Full CRUD operations (create, read, update, delete)

### 3. Unified Display

-   All images appear in the "Current Images" section
-   Rich content images are marked with "(Rich Content)" label
-   Featured images are marked with "(Featured)" label
-   Visual distinction with green border for rich content images

## Configuration Requirements

### APP_URL Setting

**CRITICAL**: Ensure your `.env` file has the correct `APP_URL` setting:

```env
# For local development
APP_URL=http://127.0.0.1:8000

# For production
APP_URL=https://yourdomain.com

# For staging
APP_URL=https://staging.yourdomain.com
```

### Why This Matters

-   Images uploaded through RichEditor use this URL for storage
-   When you deploy to production, all image URLs will automatically use the new domain
-   No need to manually update image URLs in content

## Commands

### Process Existing RichEditor Images

```bash
# Process all news articles
php artisan news:process-rich-editor-images

# Process specific article
php artisan news:process-rich-editor-images --news-id=1
```

### Fix Localhost URLs

```bash
# Check what would be changed (dry run)
php artisan news:fix-localhost-urls --dry-run

# Actually fix the URLs
php artisan news:fix-localhost-urls

# Fix specific article
php artisan news:fix-localhost-urls --news-id=1
```

## Best Practices

1. **Always set APP_URL correctly** before uploading images
2. **Use the RichEditor** for inline images in content
3. **Use dedicated image fields** for featured images and galleries
4. **Run the fix commands** when migrating between environments
5. **Clear caches** after changing APP_URL: `php artisan config:clear`

## Troubleshooting

### Images Not Displaying

-   Check if `APP_URL` is set correctly in `.env`
-   Clear configuration cache: `php artisan config:clear`
-   Verify storage symlink exists: `php artisan storage:link`

### Localhost URLs in Production

-   Run: `php artisan news:fix-localhost-urls`
-   Update your `.env` file with correct production URL
-   Clear caches and restart the application

### Missing Images After Migration

-   Run: `php artisan news:process-rich-editor-images`
-   Check storage permissions and symlinks
-   Verify file paths in the database

## File Structure

```
storage/app/public/
├── news/                    # News article images
│   ├── content/            # RichEditor uploaded images
│   └── [other images]      # Dedicated field images
└── [other directories]
```

## Database Schema

Images are stored in the `images` table with:

-   `path`: Storage path relative to public disk
-   `imageable_type`: Model class (e.g., `App\Models\News`)
-   `imageable_id`: News article ID
-   `featured`: Boolean for featured image status
-   `caption`: Optional image caption
-   `sort_order`: Display order
