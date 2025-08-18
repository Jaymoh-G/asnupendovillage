# 🚀 Production Deployment Checklist

## 🔧 Environment Configuration

### 1. Update .env File

Make sure your production `.env` file has the correct settings:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://asn1.breezetech.co.ke

# Filesystem Configuration
FILESYSTEM_DISK=public

# Cache Configuration
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

### 2. Storage Configuration

Ensure your storage is properly configured:

```bash
# Create storage link (if not already done)
php artisan storage:link

# Set proper permissions
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

## 🖼️ Image Upload Fixes Applied

### RichEditor Fields Updated

The following Filament resources have been updated to use the correct disk configuration:

-   ✅ **NewsResource** - `fileAttachmentsDisk('public')` + `fileAttachmentsDirectory('news/content')`
-   ✅ **FacilityResource** - `fileAttachmentsDisk('public')` + `fileAttachmentsDirectory('facilities/content')`
-   ✅ **ProjectResource** - `fileAttachmentsDisk('public')` + `fileAttachmentsDirectory('projects/content')`
-   ✅ **CareerResource** - `fileAttachmentsDisk('public')` + `fileAttachmentsDirectory('careers/content')`
-   ✅ **ProgramResource** - `fileAttachmentsDisk('public')` + `fileAttachmentsDirectory('programs/content')`
-   ✅ **EventsResource** - `fileAttachmentsDisk('public')` + `fileAttachmentsDirectory('events/content')`
-   ✅ **TestimonialResource** - `fileAttachmentsDisk('public')` + `fileAttachmentsDirectory('testimonials/content')`
-   ✅ **StaticPageResource** - Already properly configured

### FileUpload Fields

All FileUpload fields are already configured with:

-   `->disk('public')` or `->visibility('public')`
-   Proper directory structure

## 🔍 Verification Steps

### 1. Check Current Configuration

```bash
php artisan config:show app.url
php artisan config:show filesystems.disks.public.url
```

### 2. Test Image Upload

1. Go to any Filament resource with RichEditor
2. Upload an image through the content field
3. Check if the image URL uses the correct domain
4. Verify the image displays correctly on the frontend

### 3. Check Storage Links

```bash
# Verify storage link exists
ls -la public/storage

# Should point to: storage/app/public
```

## 🚨 Common Issues & Solutions

### Issue: Images still showing localhost URLs

**Solution**:

1. Clear all caches: `php artisan optimize:clear`
2. Check if `.env` file is being loaded correctly
3. Verify `APP_URL` is set to `https://asn1.breezetech.co.ke`

### Issue: Storage link broken

**Solution**:

```bash
# Remove existing link
rm public/storage

# Recreate link
php artisan storage:link
```

### Issue: Permission denied errors

**Solution**:

```bash
# Set proper ownership and permissions
chown -R www-data:www-data storage/
chmod -R 775 storage/
```

## 📁 Directory Structure

```
storage/app/public/
├── news/content/          # RichEditor images from news
├── facilities/content/     # RichEditor images from facilities
├── projects/content/       # RichEditor images from projects
├── careers/content/        # RichEditor images from careers
├── programs/content/       # RichEditor images from programs
├── events/content/         # RichEditor images from events
├── testimonials/content/   # RichEditor images from testimonials
├── static-pages/           # Static page content images
├── static-pages/section1/  # Section 1 content images
├── static-pages/section2/  # Section 2 content images
├── static-pages/section3/  # Section 3 content images
└── [other upload directories]
```

## 🔄 After Deployment

1. **Clear all caches**:

    ```bash
    php artisan optimize:clear
    ```

2. **Test image uploads** in RichEditor fields

3. **Verify image URLs** use the correct domain

4. **Check frontend display** of uploaded images

## 📞 Support

If issues persist after following this checklist:

1. Check Laravel logs: `storage/logs/laravel.log`
2. Verify environment variables are loaded
3. Ensure storage permissions are correct
4. Check if any CDN or proxy is interfering with URLs
