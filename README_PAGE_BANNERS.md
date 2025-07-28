# Page Banner Management System

## 🎯 Overview

A flexible banner image management system for different pages in the application. This system allows administrators to customize banner images, titles, and descriptions for various pages through the Filament admin panel.

## ✅ Features

### 🖼️ **Dynamic Banner Management**

-   **Custom Banner Images**: Upload and manage banner images for each page
-   **Page Titles**: Override default page titles with custom ones
-   **Page Descriptions**: Add descriptions for SEO and context
-   **Fallback System**: Automatic fallback to default banner if no custom image is set
-   **Active/Inactive Toggle**: Enable or disable banners as needed

### 📱 **Admin Interface**

-   **Filament Integration**: Full admin interface for banner management
-   **Image Upload**: Drag & drop image upload with editing capabilities
-   **Page Selection**: Dropdown to select which page the banner is for
-   **Preview**: Visual preview of banner images in the admin panel

### 🔧 **Developer Friendly**

-   **Trait Integration**: Easy-to-use `HasPageBanner` trait for components
-   **Helper Methods**: Convenient methods for getting banner data
-   **Polymorphic Design**: Extensible system for future page types

## 📁 File Structure

```
app/
├── Models/
│   └── PageBanner.php                 # Page banner model
├── Traits/
│   └── HasPageBanner.php              # Helper trait for components
├── Filament/Resources/
│   └── PageBannerResource.php         # Admin interface
└── Filament/Resources/PageBannerResource/Pages/
    ├── ListPageBanners.php
    ├── CreatePageBanner.php
    ├── ViewPageBanner.php
    └── EditPageBanner.php

database/
├── migrations/
│   └── 2025_01_01_000001_create_page_banners_table.php
└── seeders/
    └── PageBannerSeeder.php
```

## 🗄️ Database Schema

### Page Banners Table

```sql
CREATE TABLE page_banners (
    id BIGINT PRIMARY KEY,
    page_name VARCHAR(255) UNIQUE,      -- Page identifier (e.g., 'downloads')
    title VARCHAR(255) NULL,            -- Custom page title
    description TEXT NULL,              -- Page description
    banner_image_path VARCHAR(255) NULL, -- Path to banner image
    banner_image_alt VARCHAR(255) NULL,  -- Alt text for accessibility
    is_active BOOLEAN DEFAULT TRUE,     -- Active status
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

## 🚀 Quick Start

### 1. Run Migration

```bash
php artisan migrate
```

### 2. Seed Default Banners

```bash
php artisan db:seed --class=PageBannerSeeder
```

### 3. Use in Livewire Components

```php
use App\Traits\HasPageBanner;

class YourComponent extends Component
{
    use HasPageBanner;

    public function mount()
    {
        $this->pageBanner = $this->getPageBanner('your-page-name');
    }
}
```

### 4. Use in Blade Templates

```blade
<div class="breadcumb-wrapper"
     data-bg-src="{{ $pageBanner ? $pageBanner->effective_banner_url : asset('assets/img/bg/breadcumb-bg.jpg') }}">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">
                {{ $pageBanner && $pageBanner->title ? $pageBanner->title : 'Default Title' }}
            </h1>
        </div>
    </div>
</div>
```

## 📊 Available Pages

The system supports the following pages by default:

-   **downloads** - Downloads page
-   **news** - News page
-   **contact-us** - Contact Us page
-   **gallery** - Gallery page
-   **team** - Team page
-   **testimonials** - Testimonials page
-   **faqs** - FAQs page
-   **donate-now** - Donate Now page
-   **careers** - Careers page
-   **media-centre** - Media Centre page

## 🔧 API Methods

### PageBanner Model

```php
// Get banner for specific page
$banner = PageBanner::getBannerForPage('downloads');

// Get banner image URL
$imageUrl = $banner->banner_image_url;

// Get effective banner URL (custom or default)
$effectiveUrl = $banner->effective_banner_url;

// Get default banner URL
$defaultUrl = $banner->getDefaultBannerUrl();
```

### HasPageBanner Trait

```php
// Get page banner
$banner = $this->getPageBanner('downloads');

// Get banner image URL
$imageUrl = $this->getBannerImageUrl('downloads');

// Get page title
$title = $this->getPageTitle('downloads', 'Default Title');

// Get page description
$description = $this->getPageDescription('downloads');
```

## 🎨 Admin Interface

### Accessing the Admin Panel

1. Navigate to `/admin` in your browser
2. Go to "Site Management" → "Page Banners"
3. Create or edit banner configurations

### Creating a New Banner

1. Click "Create Page Banner"
2. Select the page from the dropdown
3. Upload a banner image (recommended: 1920x1080px, 16:9 aspect ratio)
4. Add custom title and description (optional)
5. Set alt text for accessibility
6. Toggle active status
7. Save the banner

### Image Requirements

-   **Format**: JPEG, PNG, WebP
-   **Size**: Maximum 5MB
-   **Dimensions**: Recommended 1920x1080px
-   **Aspect Ratio**: 16:9 (automatically enforced)
-   **Storage**: Files stored in `storage/app/public/page-banners/`

## 🔄 Adding New Pages

To add support for a new page:

### 1. Update the Resource

```php
// In PageBannerResource.php
Forms\Components\Select::make('page_name')
    ->options([
        // ... existing options
        'your-new-page' => 'Your New Page',
    ])
```

### 2. Update the Seeder

```php
// In PageBannerSeeder.php
$pages = [
    // ... existing pages
    'your-new-page' => [
        'title' => 'Your New Page',
        'description' => 'Description for your new page.',
    ],
];
```

### 3. Use in Component

```php
// In your Livewire component
use App\Traits\HasPageBanner;

class YourNewPageComponent extends Component
{
    use HasPageBanner;

    public function mount()
    {
        $this->pageBanner = $this->getPageBanner('your-new-page');
    }
}
```

## 🔒 Security & Validation

### File Validation

-   **MIME Types**: Only image files (JPEG, PNG, WebP)
-   **File Size**: Maximum 5MB per image
-   **Storage**: Files stored in public disk for web access
-   **Automatic Resizing**: Images automatically resized to 1920x1080px

### Access Control

-   **Admin Only**: Banner management restricted to authenticated admin users
-   **Unique Pages**: Each page can only have one banner configuration
-   **Active Status**: Banners can be disabled without deletion

## 📈 Performance

### Optimizations

-   **Database Indexing**: `page_name` field indexed for fast lookups
-   **Caching**: Banner data can be cached for better performance
-   **Lazy Loading**: Images loaded only when needed
-   **CDN Ready**: URLs compatible with CDN integration

### Best Practices

```php
// Cache banner data for better performance
$banner = Cache::remember("page_banner_{$pageName}", 3600, function() use ($pageName) {
    return PageBanner::getBannerForPage($pageName);
});

// Use eager loading when fetching multiple banners
$banners = PageBanner::whereIn('page_name', $pageNames)->get();
```

## 🔮 Future Enhancements

### Planned Features

-   **Multiple Banners**: Support for multiple banners per page
-   **Scheduled Banners**: Time-based banner activation
-   **A/B Testing**: Banner testing capabilities
-   **Analytics**: Banner performance tracking
-   **Mobile Optimization**: Different banners for mobile devices

### Customization Options

-   **Banner Overlays**: Custom overlay effects
-   **Text Positioning**: Customizable text placement
-   **Animation Effects**: CSS animation support
-   **Responsive Images**: Different sizes for different devices

## 📝 Troubleshooting

### Common Issues

1. **Banner Not Showing**: Check if banner is active and image path is correct
2. **Image Not Loading**: Verify file exists in storage and permissions are correct
3. **Default Banner Showing**: Ensure custom banner is uploaded and active
4. **Admin Access**: Verify user has proper permissions to access banner management

### Debug Commands

```bash
# Clear cache if banners not updating
php artisan cache:clear

# Regenerate storage link if images not loading
php artisan storage:link

# Check banner data
php artisan tinker
>>> App\Models\PageBanner::getBannerForPage('downloads')
```
