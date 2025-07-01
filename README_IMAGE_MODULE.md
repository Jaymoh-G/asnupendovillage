# Reusable Image Module

## 🎯 Overview

A clean, modular, and reusable image management system for Laravel applications. This module provides polymorphic image relationships that can be easily integrated into any model.

## ✅ Core Features

### 🏗️ **Clean Architecture**

-   **Single Responsibility**: Each component has a clear, focused purpose
-   **Modular Design**: Easy to extend and maintain
-   **Polymorphic Relationships**: One table for all image types
-   **Service Layer**: Centralized image operations

### 🖼️ **Reusable Components**

-   **`Image` Model**: Core image entity with rich metadata
-   **`HasImages` Trait**: Drop-in image functionality for any model
-   **`ImageService`**: Advanced image processing and management
-   **`ImageResource`**: Complete Filament admin interface

### ⚡ **Efficient Storage**

-   **Automatic Thumbnails**: 300x300 thumbnails generated on upload
-   **Optimized Queries**: Indexed polymorphic relationships
-   **File Management**: Automatic cleanup and organization
-   **URL Helpers**: Easy access to full and thumbnail URLs

## 📁 File Structure

```
app/
├── Models/
│   └── Image.php                 # Core image model
├── Traits/
│   └── HasImages.php             # Reusable image functionality
├── Services/
│   └── ImageService.php          # Image processing service
├── Filament/Resources/
│   └── ImageResource.php         # Admin interface
└── Filament/Resources/ImageResource/Pages/
    ├── ListImages.php
    ├── CreateImage.php
    └── EditImage.php

database/migrations/
└── 2025_01_01_000000_create_images_table.php
```

## 🗄️ Database Schema

### Images Table

```sql
CREATE TABLE images (
    id BIGINT PRIMARY KEY,
    filename VARCHAR(255),           -- Generated filename
    original_name VARCHAR(255),      -- Original uploaded filename
    path VARCHAR(255),               -- Storage path
    mime_type VARCHAR(255),          -- File MIME type
    size INT UNSIGNED,               -- File size in bytes
    alt_text VARCHAR(255) NULL,      -- Alt text for accessibility
    caption TEXT NULL,               -- Image caption
    featured BOOLEAN DEFAULT FALSE,  -- Featured image flag
    sort_order INT DEFAULT 0,        -- Display order
    imageable_type VARCHAR(255),     -- Polymorphic model type
    imageable_id BIGINT,             -- Polymorphic model ID
    created_at TIMESTAMP,
    updated_at TIMESTAMP,

    -- Indexes for performance
    INDEX idx_imageable (imageable_type, imageable_id),
    INDEX idx_featured (featured),
    INDEX idx_sort_order (sort_order)
);
```

## 🚀 Quick Start

### 1. Run Migration

```bash
php artisan migrate
```

### 2. Create Storage Link

```bash
php artisan storage:link
```

### 3. Add to Any Model

```php
use App\Traits\HasImages;

class YourModel extends Model
{
    use HasFactory, HasImages;

    // Your model code...
}
```

### 4. Upload Images

```php
$model = YourModel::find(1);

// Single image
$model->uploadImages($request->file('image'), 'your-directory');

// Multiple images
$model->uploadImages($request->file('images'), 'your-directory');
```

### 5. Access Images

```php
// All images
$images = $model->images;

// Featured images
$featuredImages = $model->featuredImages;

// Main featured image
$featuredImage = $model->featuredImage;

// Image URLs
$imageUrl = $model->featured_image_url;
$thumbnailUrl = $model->featured_image_thumbnail_url;
```

## 📊 Model Features

### Image Model

```php
// Access URLs
$image->url;              // Full image URL
$image->thumbnail_url;    // Thumbnail URL
$image->formatted_size;   // Human readable file size

// Scopes
Image::featured();        // Get featured images
Image::ordered();         // Get ordered images

// Properties
$image->is_image;         // Check if it's an image file
```

### HasImages Trait Methods

```php
// Upload
$model->uploadImages($files, $directory);

// Featured
$model->setFeaturedImage($imageId);

// Delete
$model->deleteImage($imageId);

// Reorder
$model->reorderImages([1, 3, 2, 4]);

// Update metadata
$model->updateImageMetadata($imageId, ['alt_text' => 'New alt text']);

// Access
$model->images;                    // All images
$model->featuredImages;            // Featured images
$model->featuredImage;             // Main featured image
$model->image_count;               // Image count
$model->featured_image_url;        // Featured image URL
$model->featured_image_thumbnail_url; // Featured thumbnail URL
```

## 🔧 Advanced Usage

### ImageService

```php
use App\Services\ImageService;

$imageService = new ImageService();

// Upload with processing
$images = $imageService->uploadImages($files, $model, 'custom-directory');

// Delete with cleanup
$imageService->deleteImage($imageId);

// Set featured
$imageService->setFeaturedImage($model, $imageId);

// Reorder
$imageService->reorderImages($model, [1, 2, 3, 4]);
```

### Custom Thumbnail Sizes

```php
// In ImageService, modify createThumbnail method
protected function createThumbnail($imagePath, $directory)
{
    // Change dimensions here
    $this->resizeImage($fullPath, $thumbnailFullPath, 400, 400);
}
```

### Multiple Image Sizes

```php
// Extend ImageService to create multiple sizes
public function createImageSizes($imagePath, $directory)
{
    $sizes = [
        'thumb' => [150, 150],
        'small' => [300, 300],
        'medium' => [600, 600],
        'large' => [1200, 1200],
    ];

    foreach ($sizes as $size => $dimensions) {
        $this->createResizedImage($imagePath, $directory, $size, $dimensions[0], $dimensions[1]);
    }
}
```

## 🎨 Filament Integration

### ImageResource Features

-   **File Upload**: Drag & drop with image editing
-   **Image Gallery**: Visual management interface
-   **Metadata Editing**: Alt text, captions, featured status
-   **Bulk Operations**: Delete multiple images
-   **Filtering**: By model type, featured status
-   **Sorting**: By upload date, size, name

### Usage in Other Resources

```php
// In any Filament resource form
FileUpload::make('images')
    ->multiple()
    ->image()
    ->imageEditor()
    ->directory('your-model')
    ->columnSpanFull(),

// In table columns
ImageColumn::make('featuredImage.path')
    ->label('Image')
    ->circular()
    ->size(40),
```

## 🔒 Security & Validation

### File Validation

```php
// In your form requests
'images.*' => [
    'required',
    'image',
    'mimes:jpeg,png,jpg,gif,webp',
    'max:5120', // 5MB
],
```

### Storage Security

-   Files stored in `public` disk for web access
-   Automatic filename generation prevents conflicts
-   MIME type validation
-   File size limits

## 📈 Performance

### Optimizations

-   **Indexed Queries**: Polymorphic relationships indexed
-   **Eager Loading**: Load images with relationships
-   **Lazy Loading**: Images loaded on demand
-   **Caching**: URL generation cached

### Best Practices

```php
// Eager load images
$models = YourModel::with('images')->get();

// Load only featured images
$models = YourModel::with(['featuredImage'])->get();

// Count images efficiently
$count = YourModel::withCount('images')->get();
```

## 🔮 Extensibility

### Adding New Image Types

```php
// Create new image model
class Document extends Model
{
    use HasFactory, HasImages;

    // Custom document logic
}
```

### Custom Image Processing

```php
// Extend ImageService
class CustomImageService extends ImageService
{
    public function addWatermark($imagePath, $watermarkPath)
    {
        // Custom watermark logic
    }
}
```

### Custom Storage

```php
// Use different storage disks
protected function storeImage(UploadedFile $file, $directory = 'uploads')
{
    $path = $file->storeAs($directory, $filename, 's3'); // Use S3
    // ... rest of logic
}
```

## 🧪 Testing

### Unit Tests

```php
// Test image upload
public function test_can_upload_image()
{
    $model = YourModel::factory()->create();
    $file = UploadedFile::fake()->image('test.jpg');

    $model->uploadImages($file, 'test');

    $this->assertCount(1, $model->images);
    $this->assertTrue(Storage::disk('public')->exists($model->images->first()->path));
}
```

### Feature Tests

```php
// Test image relationships
public function test_model_has_images()
{
    $model = YourModel::factory()->create();
    $image = Image::factory()->create([
        'imageable_type' => YourModel::class,
        'imageable_id' => $model->id,
    ]);

    $this->assertTrue($model->images->contains($image));
}
```

## 📝 Notes

-   **GD Extension**: Required for image processing (usually included with PHP)
-   **Storage Permissions**: Ensure `storage/app/public` is writable
-   **File Limits**: Configure `upload_max_filesize` and `post_max_size` in PHP
-   **Memory Limits**: Large images may require increased memory limits

## 🎯 Benefits

✅ **Reusable**: One implementation for all models
✅ **Clean**: Modular, maintainable architecture
✅ **Efficient**: Optimized queries and storage
✅ **Flexible**: Easy to extend and customize
✅ **Admin Ready**: Complete Filament integration
✅ **Production Ready**: Security, validation, and error handling
