# Home Sliders Management Module

## 🎯 Overview

A comprehensive home sliders management system for the ASN Upendo Village website. This module allows administrators to create, manage, and display dynamic slider content on the homepage.

## ✅ Features

### 🏗️ **Core Functionality**

-   **Dynamic Slider Management**: Create and manage multiple slider entries
-   **Image Management**: Upload and manage slider images using the existing image system
-   **Content Management**: Manage titles, subtitles, descriptions, and call-to-action buttons
-   **SEO Optimization**: Meta titles and descriptions for each slider
-   **Status Control**: Active/inactive status for each slider
-   **Featured Sliders**: Mark specific sliders as featured
-   **Sort Order**: Control the display order of sliders

### 🖼️ **Image Features**

-   **Multiple Images**: Upload multiple images per slider
-   **Existing Image Selection**: Choose from images already uploaded to the system
-   **Featured Images**: Set a featured image for each slider
-   **Image Management**: View, delete, and manage images through the admin interface
-   **Responsive Design**: Images are optimized for different screen sizes
-   **16:9 Aspect Ratio**: Recommended aspect ratio for consistent display
-   **Search Functionality**: Search through existing images by filename

### 🎨 **Frontend Integration**

-   **Livewire Component**: Dynamic slider display on the homepage
-   **Fallback Content**: Default content when no sliders are available
-   **Responsive Design**: Works on all device sizes
-   **Swiper Integration**: Uses the existing Swiper.js slider functionality

## 📁 File Structure

```
app/
├── Models/
│   └── HomeSlider.php                 # Home slider model
├── Filament/Resources/
│   └── HomeSliderResource.php         # Admin interface
├── Filament/Resources/HomeSliderResource/Pages/
│   ├── ListHomeSliders.php
│   ├── CreateHomeSlider.php
│   └── EditHomeSlider.php
├── Livewire/Frontend/
│   └── HomeSlider.php                 # Frontend component
└── Services/
    └── ImageService.php               # Image management (existing)

resources/views/
├── filament/resources/home-slider-resource/
│   ├── components/
│   │   └── existing-images.blade.php
│   └── modals/
│       └── view-images.blade.php
└── livewire/frontend/
    └── home-slider.blade.php

database/
├── migrations/
│   └── 2025_01_01_000003_create_home_sliders_table.php
└── seeders/
    └── HomeSliderSeeder.php
```

## 🗄️ Database Schema

### Home Sliders Table

```sql
CREATE TABLE home_sliders (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    subtitle VARCHAR(255) NULL,
    description TEXT NULL,
    button_text VARCHAR(100) NULL,
    button_url VARCHAR(255) NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'active',
    sort_order INT DEFAULT 0,
    is_featured BOOLEAN DEFAULT FALSE,
    meta_title VARCHAR(255) NULL,
    meta_description TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

## 🚀 Usage

### Admin Interface

1. **Access the Admin Panel**

    - Navigate to `/admin` in your browser
    - Login with admin credentials

2. **Manage Home Sliders**

    - Click on "Home Sliders" in the "Content Management" section
    - View all existing sliders in a table format
    - Create new sliders using the "Create" button
    - Edit existing sliders using the "Edit" action

3. **Creating a New Slider**

    - Click "Create Home Slider"
    - Fill in the required fields:
        - **Title**: Main heading for the slider
        - **Subtitle**: Secondary text (optional)
        - **Description**: Detailed description (optional)
        - **Button Text**: Call-to-action button text (optional)
        - **Button URL**: Link for the button (optional)
        - **Status**: Active or Inactive
        - **Sort Order**: Display order (lower numbers appear first)
        - **Featured**: Mark as featured slider
        - **Meta Title**: SEO title (optional)
        - **Meta Description**: SEO description (optional)

4. **Managing Images**
   - **Upload New Images**: Use the "Upload New Images" tab to upload new images
   - **Select Existing Images**: Use the "Select from Existing" tab to choose from images already in the system
   - **Search Images**: Type in the search box to find specific images by filename
   - **View Current Images**: See all images currently assigned to this slider
   - **Remove Images**: Use the delete button on each image to remove them
   - **Multiple Selection**: Select multiple images at once from the existing images modal

### Frontend Display

The home sliders are automatically displayed on the homepage using the Livewire component. The component:

-   Fetches active sliders from the database
-   Displays them in a Swiper.js slider
-   Shows fallback content if no sliders are available
-   Supports responsive design for all devices

## 🔧 Configuration

### Image Settings

The module uses the following image settings:

-   **Directory**: `home-sliders`
-   **Aspect Ratio**: 16:9 (recommended)
-   **Max Size**: 5MB per image
-   **Accepted Formats**: JPEG, PNG, WebP
-   **Resize Dimensions**: 1920x1080 (recommended)

### Slider Settings

-   **Effect**: Fade transition
-   **Auto Height**: Enabled
-   **Autoplay**: 6 seconds delay
-   **Navigation**: Previous/Next arrows
-   **Pagination**: Bullet indicators

## 📝 API Methods

### HomeSlider Model

```php
// Get all active sliders
HomeSlider::getActiveSliders();

// Get featured sliders only
HomeSlider::getFeaturedSliders();

// Get sliders with custom ordering
HomeSlider::active()->ordered()->get();

// Get a specific slider by slug
HomeSlider::where('slug', 'my-slider')->first();
```

### Livewire Component

```php
// Use in blade templates
@livewire('frontend.home-slider-component')

// With featured only parameter
@livewire('frontend.home-slider-component', ['featuredOnly' => true])
```

## 🎨 Customization

### Styling

The slider uses the existing theme CSS classes:

-   `.th-hero-wrapper`: Main wrapper
-   `.hero-inner`: Individual slide container
-   `.hero-style1`: Content styling
-   `.hero-title`: Main title
-   `.hero-subtitle`: Subtitle
-   `.hero-text`: Description text
-   `.hero-btn`: Button container

### Adding Custom Fields

To add custom fields to the slider:

1. **Update the Migration**

    ```php
    $table->string('custom_field')->nullable();
    ```

2. **Update the Model**

    ```php
    protected $fillable = [
        // ... existing fields
        'custom_field',
    ];
    ```

3. **Update the Filament Resource**

    ```php
    Forms\Components\TextInput::make('custom_field')
        ->label('Custom Field')
        ->maxLength(255),
    ```

4. **Update the Frontend View**
    ```php
    @if($slider->custom_field)
        <div class="custom-field">{{ $slider->custom_field }}</div>
    @endif
    ```

## 🔒 Security

-   **File Upload Validation**: Only image files are accepted
-   **File Size Limits**: Maximum 5MB per image
-   **Admin Authentication**: All management features require admin login
-   **CSRF Protection**: All forms include CSRF tokens
-   **Input Validation**: All user inputs are validated

## 🐛 Troubleshooting

### Common Issues

1. **Images Not Displaying**

    - Check file permissions on storage directory
    - Verify image paths are correct
    - Ensure images are uploaded to the correct directory

2. **Sliders Not Showing**

    - Verify sliders are marked as "active"
    - Check if the Livewire component is properly included
    - Ensure the database migration has been run

3. **Admin Panel Not Accessible**
    - Verify admin user credentials
    - Check Filament configuration
    - Ensure proper routes are registered

### Debug Commands

```bash
# Check if migration ran successfully
php artisan migrate:status

# Re-run migrations if needed
php artisan migrate:fresh --seed

# Clear cache if needed
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 📈 Performance

-   **Image Optimization**: Images are automatically resized and optimized
-   **Database Indexing**: Proper indexes on frequently queried fields
-   **Caching**: Consider implementing caching for slider queries
-   **Lazy Loading**: Images are loaded as needed

## 🔄 Updates and Maintenance

### Regular Maintenance

1. **Clean Up Unused Images**: Remove images that are no longer needed
2. **Update Content**: Regularly update slider content to keep it fresh
3. **Monitor Performance**: Check for any performance issues
4. **Backup Data**: Regular backups of slider content

### Version Updates

When updating the module:

1. Run migrations: `php artisan migrate`
2. Clear caches: `php artisan cache:clear`
3. Test functionality in admin panel
4. Verify frontend display

## 🤝 Contributing

When contributing to this module:

1. Follow Laravel coding standards
2. Add proper documentation for new features
3. Include tests for new functionality
4. Update this documentation file
5. Test thoroughly before submitting

---

**Created**: January 2025
**Version**: 1.0.0
**Compatibility**: Laravel 10+, PHP 8.1+
