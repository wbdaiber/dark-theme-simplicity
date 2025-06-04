# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Development Commands

This WordPress theme uses a **no-build development approach** - there are no npm scripts, webpack, or build processes. Development is done by directly editing files.

**Common development workflow:**
- Edit PHP templates directly in root directory and `/template-parts/`
- Modify CSS in `/assets/css/` for component-specific styles
- Edit JavaScript in `/assets/js/` for functionality updates
- Use WordPress Customizer for content and styling configuration

**No build commands needed:**
- No `npm install` or `npm run build`
- CSS is pre-compiled Tailwind (edit `style.css` directly or component CSS files)
- JavaScript files are already consolidated and minified

## Architecture Overview

**Core Theme Structure:**
- **Homepage System**: Section-based architecture with customizable template parts in `/template-parts/homepage/`
- **Customizer Integration**: Extensive customizer system (1,600+ lines) with custom repeater controls for dynamic content
- **Asset Management**: Conditional loading strategy - homepage styles only on front page, blog styles only on blog pages
- **Error Recovery**: Built-in automatic recovery from blank pages and corrupted customizer data

**Key Architectural Components:**

1. **Modular Customizer System** (`/inc/customizer.php`):
   - Custom repeater controls for Services, Benefits, and Approach sections
   - JSON-based storage with validation and sanitization
   - Error recovery mechanisms for corrupted data

2. **Homepage Sections** (`/template-parts/homepage/`):
   - `section-services.php` - Dynamic service cards with icons
   - `section-benefits.php` - Feature showcase with repeater content
   - `section-approach.php` - Process steps with automatic numbering
   - `section-about.php` - About section with image support
   - `section-contact.php` - Contact information and CTA

3. **Asset Loading** (`/inc/enqueue.php`):
   - Conditional loading based on page type
   - Consolidated JavaScript files to reduce HTTP requests
   - Component-specific CSS files for modularity

**Customizer Data Structure:**
- Services: `get_theme_mod('services_list')` - JSON array of service objects
- Benefits: `get_theme_mod('benefits_list')` - JSON array of benefit objects  
- Approach: `get_theme_mod('approach_items')` - JSON array of process steps
- All sections have fallback defaults if customizer data is missing/corrupted

**Critical Code Patterns:**
- Always use `wp_kses_post()` for HTML sanitization in customizer outputs
- Use `esc_url()` for all URL outputs
- JSON data is validated and automatically repaired if corrupted
- Error recovery functions check for blank page issues and auto-fix theme mod keys

**File Organization Logic:**
- `/inc/` contains all functionality modules (customizer, enqueue, accessibility, etc.)
- `/assets/` contains optimized, production-ready assets
- `/src/` contains source files (minimal - just Tailwind input)
- Template parts are organized by functionality (homepage sections, general template parts)

## Important Notes

- Theme uses pre-compiled Tailwind CSS - edit `style.css` directly or component CSS files
- Customizer repeater control requires specific JSON structure for Services/Benefits/Approach
- Always test customizer changes as theme has error recovery but complex JSON structure
- Homepage sections are dynamically generated from customizer data with automatic fallbacks
- Theme is accessibility-ready with proper ARIA labels and semantic HTML structure