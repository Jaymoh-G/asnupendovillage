# Homepage Content Management System

This system allows you to manage all static content on the homepage through the admin dashboard.

## Features

-   **Dynamic Content Management**: Edit titles, descriptions, buttons, and other content without touching code
-   **Section-based Organization**: Manage different sections of the homepage separately
-   **Statistics Management**: Update counter numbers and labels dynamically
-   **Checklist Items**: Manage about us checklist items with custom colors
-   **Media Management**: Upload images and set video URLs
-   **Active/Inactive Toggle**: Show or hide sections as needed

## Available Sections

### 1. About Us Section

-   **Location**: Main about us area on homepage
-   **Manageable Content**:
    -   Title and subtitle
    -   Main description
    -   Checklist items with custom colors
    -   Button text and URL

### 2. Statistics Section

-   **Location**: Video area with counter cards
-   **Manageable Content**:
    -   Section title and description
    -   Statistics with numbers, suffixes, labels, and colors
    -   Up to 4 statistics displayed

### 3. CTA Section

-   **Location**: Call-to-action area with dark background
-   **Manageable Content**:
    -   Main title
    -   Button text and URL

### 4. Story Section

-   **Location**: Success story area
-   **Manageable Content**:
    -   Subtitle, title, and description
    -   Button text and URL

### 5. Video Section

-   **Location**: Video area
-   **Manageable Content**:
    -   Title and description
    -   Video URL (YouTube or other)

## How to Use

### Accessing the Management Interface

1. Log into your admin dashboard
2. Navigate to **Site Management** → **Homepage Content**
3. You'll see a list of all homepage sections

### Editing Content

1. Click **Edit** on any section
2. Update the content as needed:
    - **Section Information**: Choose section type, toggle active status, set sort order
    - **Content**: Update titles, subtitles, and descriptions
    - **Call to Action**: Set button text and URLs
    - **Media**: Upload images or set video URLs
    - **Statistics**: Add/edit counter numbers and labels (for statistics section)
    - **Checklist Items**: Add/edit checklist items with colors (for about us section)
3. Click **Save** to update the homepage

### Managing Statistics

For the Statistics section:

-   Add up to 4 statistics
-   Each statistic has:
    -   **Number**: The main number (e.g., 15, 1000)
    -   **Suffix**: Additional text (e.g., "k", "+")
    -   **Label**: Description (e.g., "Incredible Volunteers")
    -   **Color**: Optional custom color

### Managing Checklist Items

For the About Us section:

-   Add multiple checklist items
-   Each item has:
    -   **Text**: The checklist item text
    -   **Color**: Optional custom color (CSS color value)

### Best Practices

1. **Keep Content Concise**: Homepage content should be brief and impactful
2. **Test Changes**: Always preview changes before making them live
3. **Use Active/Inactive**: Hide sections temporarily instead of deleting them
4. **Image Optimization**: Use appropriately sized images for better performance
5. **Regular Updates**: Keep statistics and content current

## Technical Details

-   **Database Table**: `home_page_contents`
-   **Model**: `App\Models\HomePageContent`
-   **Resource**: `App\Filament\Resources\HomePageContentResource`
-   **Widget**: `App\Filament\Widgets\HomePageContentOverview`

## Fallback Content

If any section is not configured or inactive, the system will display default content to ensure the homepage always looks complete.

## Support

For technical support or questions about the homepage content management system, please contact the development team.
