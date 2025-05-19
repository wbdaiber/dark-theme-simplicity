
# WordPress Theme Conversion Structure

This folder contains the organized components for WordPress theme conversion.

## Structure Overview:

- `static/`: UI elements that remain consistent (header, footer, layouts)
- `dynamic/`: Components that will receive WordPress data (posts, pages, etc.)
- `templates/`: Page templates that combine static and dynamic components
- `utils/`: Helper functions for WordPress integration

## WordPress Mapping:

- `static/Header.tsx` → `header.php`
- `static/Footer.tsx` → `footer.php`
- `templates/Homepage.tsx` → `front-page.php`
- `templates/Blog.tsx` → `index.php` and/or `archive.php`
- `templates/BlogPost.tsx` → `single.php`
- `templates/Page.tsx` → `page.php`
- `dynamic/PostList.tsx` → Used within WordPress loop contexts
- `dynamic/PostCard.tsx` → Used for individual post display
- `dynamic/PageContent.tsx` → Used for flexible content areas

## Conversion Notes:

When converting to WordPress:
1. Replace React Router with WordPress template hierarchy
2. Replace static content with WordPress template tags and functions
3. Convert React state management to WordPress data fetching
4. Ensure all assets are properly enqueued in WordPress
