# WordPress Theme Conversion Guide

This document provides comprehensive instructions for converting our React components into a WordPress theme. It serves as a reference for developers handling the conversion process.

## 1. Project & Goal Context

### Project Synopsis
This React application is a modern, responsive website with a dark theme design focused on blog content delivery. It includes a homepage, blog listing, single post view, about page, and 404 page. The scope encompasses converting all React components to WordPress templates while maintaining visual consistency and interactive features. The conversion is considered "done" when the WordPress theme renders identically to the React app, maintains the same user experience, and meets all performance criteria.

### Target WordPress Environment
- **WordPress Version:** 6.4+ 
- **PHP Version:** 7.4+ (8.0+ recommended)
- **Theme Paradigm:** Classic theme with Block Editor (Gutenberg) compatibility
- **Browser Support:** Latest two versions of Chrome, Firefox, Safari, and Edge

### Acceptance Criteria
- **Performance:** Lighthouse score 90+ on all metrics
- **Accessibility:** WCAG 2.1 AA compliant
- **SEO:** Perfect on-page optimization  
- **Plugin Compatibility:** Contact Form 7, Yoast SEO, WP Super Cache, Advanced Custom Fields

## 2. Pre-conversion Prerequisites

### Local Development Environment
- **PHP:** 7.4+ 
- **MySQL/MariaDB:** 5.7+ / 10.4+
- **Node.js:** 16+
- **npm/yarn:** Latest stable
- **WordPress CLI:** Latest version

### Bootstrap Script
Create a `setup.sh` script in the project root:

```bash
#!/bin/bash
# Setup script for local development

# Variables
WP_DIR="wordpress"
THEME_NAME="your-theme-name"
THEME_DIR="$WP_DIR/wp-content/themes/$THEME_NAME"

# Download WordPress core
if [ ! -d "$WP_DIR" ]; then
  wp core download --path=$WP_DIR
  
  # Configure WordPress
  cp wp-config-sample.php $WP_DIR/wp-config.php
  # Replace DB settings in wp-config.php
  sed -i '' 's/database_name_here/wordpress/g' $WP_DIR/wp-config.php
  sed -i '' 's/username_here/root/g' $WP_DIR/wp-config.php
  sed -i '' 's/password_here/root/g' $WP_DIR/wp-config.php
  
  # Create database
  wp db create --path=$WP_DIR
  
  # Install WordPress
  wp core install --path=$WP_DIR --url=http://localhost:8080 --title="Your Site Title" --admin_user=admin --admin_password=admin --admin_email=admin@example.com
fi

# Create theme directory
mkdir -p $THEME_DIR

# Copy theme files
cp -R theme/* $THEME_DIR/

# Install required plugins
wp plugin install advanced-custom-fields contact-form-7 wordpress-seo wp-super-cache --activate --path=$WP_DIR

# Import demo content
if [ -f "demo-content.xml" ]; then
  wp import demo-content.xml --authors=create --path=$WP_DIR
fi

echo "Setup complete! Your WordPress installation is ready at ./wordpress"
```

Make the script executable:
```bash
chmod +x setup.sh
```

## Directory Structure

Our WordPress theme should follow this structure:

```
theme-name/
├── assets/             # Compiled CSS, JS, and images
├── inc/               # PHP functions and utilities
├── template-parts/    # Reusable template parts
│   ├── content/       # Post/page content templates
│   ├── header/        # Header components
│   ├── footer/        # Footer components
│   └── navigation/    # Navigation elements  
├── templates/         # Block templates for FSE themes
├── functions.php      # Theme functions and setup
├── index.php          # Main template file
├── front-page.php     # Homepage template
├── single.php         # Single post template
├── page.php           # Page template
├── archive.php        # Archive template
├── header.php         # Header template
├── footer.php         # Footer template
└── style.css          # Theme stylesheet and metadata
```

## 3. Asset Build & Watch Pipeline

### Build System Configuration

Create the following configuration files for asset compilation:

#### package.json for theme development

```json
{
  "name": "your-theme-name",
  "version": "1.0.0",
  "description": "WordPress theme with Tailwind CSS",
  "scripts": {
    "build:css": "postcss src/css/tailwind.css -o assets/css/tailwind.css --minify",
    "watch:css": "postcss src/css/tailwind.css -o assets/css/tailwind.css --watch",
    "build:js": "esbuild src/js/*.js --bundle --minify --outdir=assets/js",
    "watch:js": "esbuild src/js/*.js --bundle --outdir=assets/js --watch",
    "build": "npm run build:css && npm run build:js",
    "dev": "concurrently \"npm run watch:css\" \"npm run watch:js\"",
    "prod": "cross-env NODE_ENV=production npm run build"
  },
  "devDependencies": {
    "@tailwindcss/typography": "^3.0.0",
    "autoprefixer": "^10.4.14",
    "concurrently": "^8.0.1",
    "cross-env": "^7.0.3",
    "cssnano": "^6.0.0",
    "esbuild": "^0.17.19",
    "postcss": "^8.4.23",
    "postcss-cli": "^10.1.0",
    "tailwindcss": "^3.3.2"
  }
}
```

#### tailwind.config.js

```js
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './inc/**/*.php',
    './template-parts/**/*.php',
    './templates/**/*.php',
    './src/js/**/*.js'
  ],
  theme: {
    extend: {
      colors: {
        'blue-300': '#3b82f6',
        'dark-100': '#0f172a',
        'dark-200': '#0a0f1c',
        'dark-300': '#0d1424',
        'light-100': '#f8fafc',
      },
      fontFamily: {
        'display': ['var(--font-display)', 'sans-serif'],
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
}
```

#### postcss.config.js

```js
module.exports = {
  plugins: {
    tailwindcss: {},
    autoprefixer: {},
    ...(process.env.NODE_ENV === 'production' ? { cssnano: {} } : {})
  }
}
```

### Development Workflow

1. **Install dependencies:**
   ```bash
   npm install
   ```

2. **Development mode with watch:**
   ```bash
   npm run dev
   ```
   This will watch both CSS and JS files, recompiling on changes.

3. **Production build:**
   ```bash
   npm run prod
   ```
   This will minify CSS and JS for production use.

### Source Maps Policy

- **Development:** Source maps are enabled by default in dev mode
- **Production:** Source maps are disabled in production builds

To toggle development/production asset stacks:
```bash
# Development (with source maps)
npm run dev

# Production (minified, no source maps)
npm run prod
```

## 4. Data & Content Modeling

### React Data to WordPress Mapping

| React Data Source | WordPress Implementation | Notes |
|------------------|--------------------------|-------|
| `/posts` endpoint | Default WP post type | Core WordPress posts |
| `/pages/:id` | Default WP page type | Page templates will render these |
| User data | WordPress users | User roles mapped to capabilities |
| Categories | WordPress categories | Built-in taxonomy |
| Tags | WordPress tags | Built-in taxonomy |
| Image gallery | WordPress media library | Use `wp_get_attachment_image()` |
| Settings/Config | Theme Customizer API | Global site settings |

### Custom Fields Structure

For complex data structures, use Advanced Custom Fields with these field groups:

1. **Post Extended Fields**
   - Featured (boolean)
   - Subtitle (text)
   - Reading Time (number)

2. **Author Extended Fields**
   - Title/Position (text)
   - Social Links (repeater)
   - Profile Image (image)

### Demo Content Import

Create a WXR (WordPress eXtended RSS) export file from a test site, or use WP-CLI to generate sample content:

```bash
# Create 10 sample posts
wp post generate --count=10 --post_type=post --post_status=publish

# Create 5 pages
wp post generate --count=5 --post_type=page --post_status=publish

# Create categories
wp term create category "Technology" --description="Tech related posts"
wp term create category "Design" --description="Design related posts"

# Assign categories to posts
wp post term set 1 category technology
```

## 5. Route / Navigation Mapping

### React Routes to WordPress Permalinks

| React Route | WordPress Permalink | Notes |
|-------------|---------------------|-------|
| `/` | `/` | Homepage |
| `/blog` | `/blog/` | Blog archive page |
| `/blog/:slug` | `/blog/%postname%/` | Single post |
| `/about` | `/about/` | About page |
| `*` (404) | Any non-existent URL | 404 template |

### Permalink Configuration

In WordPress admin, go to Settings → Permalinks and select "Post name" option.

For the blog section, create a page named "Blog" and set it as the posts page in Settings → Reading.

### Redirection Strategy

Create a `.htaccess` file in the root directory with the following rules for any URL changes:

```apache
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /

# Redirect old URL format to new format if needed
# RewriteRule ^old-path/(.*)$ /new-path/$1 [R=301,L]
</IfModule>
```

## 6. Global State, API Calls & Interactivity

### State Management Strategy

| React Pattern | WordPress Implementation | Notes |
|---------------|--------------------------|-------|
| Context API | Theme Customizer API | For theme-wide settings |
| Redux Store | WordPress options API | For site-wide data |
| API Data Fetching | WP REST API | For dynamic data |
| Local Component State | Vanilla JS / Alpine.js | For UI interactivity |

### REST API Implementation

For custom data needs, register custom REST API endpoints:

```php
<?php
// In inc/api.php

function theme_register_rest_routes() {
    register_rest_route('theme/v1', '/settings', array(
        'methods' => 'GET',
        'callback' => 'theme_get_settings',
        'permission_callback' => '__return_true'
    ));
}
add_action('rest_api_init', 'theme_register_rest_routes');

function theme_get_settings() {
    return array(
        'site_name' => get_bloginfo('name'),
        'description' => get_bloginfo('description'),
        'logo' => get_theme_mod('custom_logo') ? wp_get_attachment_url(get_theme_mod('custom_logo')) : '',
        'primary_color' => get_theme_mod('primary_color', '#3b82f6')
    );
}
```

### Authentication Handling

If the React app used authentication:

```php
<?php
// In inc/auth.php

function theme_auth_endpoints() {
    register_rest_route('theme/v1', '/auth', array(
        'methods' => 'POST',
        'callback' => 'theme_auth_callback',
        'permission_callback' => '__return_true'
    ));
}
add_action('rest_api_init', 'theme_auth_endpoints');

function theme_auth_callback($request) {
    $params = $request->get_params();
    $user = wp_authenticate($params['username'], $params['password']);
    
    if (is_wp_error($user)) {
        return new WP_Error('invalid_credentials', 'Invalid credentials', array('status' => 401));
    }
    
    $token = wp_generate_password(32, false);
    update_user_meta($user->ID, 'auth_token', $token);
    
    return array(
        'token' => $token,
        'user_id' => $user->ID,
        'user_login' => $user->user_login
    );
}

function theme_validate_auth_token($token) {
    global $wpdb;
    
    $user_id = $wpdb->get_var($wpdb->prepare(
        "SELECT user_id FROM $wpdb->usermeta WHERE meta_key = 'auth_token' AND meta_value = %s",
        $token
    ));
    
    return $user_id ? get_user_by('ID', $user_id) : false;
}
```

## 7. PHP & JS Coding Standards

### Coding Style Configuration

#### .editorconfig

```
root = true

[*]
charset = utf-8
end_of_line = lf
insert_final_newline = true
trim_trailing_whitespace = true
indent_style = space
indent_size = 2

[*.php]
indent_size = 4

[*.md]
trim_trailing_whitespace = false
```

#### phpcs.xml

```xml
<?xml version="1.0"?>
<ruleset name="WordPress Theme Coding Standards">
    <description>PHPCS configuration file for WordPress theme development</description>
    
    <!-- Scan all files in directory -->
    <file>.</file>
    
    <!-- Exclude paths -->
    <exclude-pattern>/vendor/*</exclude-pattern>
    <exclude-pattern>/node_modules/*</exclude-pattern>
    <exclude-pattern>/assets/*</exclude-pattern>
    
    <!-- Include WordPress standards -->
    <rule ref="WordPress-Core" />
    <rule ref="WordPress-Docs" />
    <rule ref="WordPress.WP.I18n" />
    
    <!-- Text domain -->
    <rule ref="WordPress.WP.I18n">
        <properties>
            <property name="text_domain" type="array">
                <element value="theme-textdomain"/>
            </property>
        </properties>
    </rule>
    
    <!-- PHP version compatibility -->
    <config name="testVersion" value="7.4-"/>
    <rule ref="PHPCompatibilityWP" />
</ruleset>
```

#### .eslintrc.js

```js
module.exports = {
  root: true,
  env: {
    browser: true,
    commonjs: true,
    es6: true,
    node: true
  },
  extends: [
    'eslint:recommended'
  ],
  parserOptions: {
    ecmaVersion: 2020,
    sourceType: 'module'
  },
  rules: {
    'no-console': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
    'no-debugger': process.env.NODE_ENV === 'production' ? 'warn' : 'off'
  }
};
```

### Naming Conventions

- **Files:** lowercase-with-hyphens.php
- **Functions:** prefix_descriptive_name()
- **Classes:** Prefix_Descriptive_Name
- **Text Domain:** theme-textdomain (used in all i18n functions)

### Code Organization Guidelines

- Each function should do one thing well
- Use descriptive function and variable names
- Document code with PHPDoc comments
- Prefix all functions and hooks with theme prefix to avoid conflicts
- Place related functionality in separate files in the /inc directory

## 8. Automated & Manual Testing

### Unit Testing Setup

#### PHPUnit for PHP

Create phpunit.xml in theme root:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit bootstrap="tests/bootstrap.php" colors="true">
    <testsuites>
        <testsuite name="Theme Test Suite">
            <directory suffix=".php">./tests/</directory>
        </testsuite>
    </testsuites>
</phpunit>
```

Create tests/bootstrap.php:

```php
<?php
// First, load WordPress test environment
$_tests_dir = '/tmp/wordpress-tests-lib';

// Load WordPress
require_once $_tests_dir . '/includes/bootstrap.php';

// Load theme functions
require_once dirname(__DIR__) . '/functions.php';
```

Sample test file (tests/test-theme-functions.php):

```php
<?php
class Test_Theme_Functions extends WP_UnitTestCase {
    function test_theme_setup() {
        // Test that theme support is added correctly
        $this->assertTrue(current_theme_supports('post-thumbnails'));
        $this->assertTrue(current_theme_supports('title-tag'));
    }
}
```

#### Jest for JavaScript

Add to package.json:

```json
{
  "scripts": {
    "test": "jest"
  },
  "devDependencies": {
    "jest": "^29.5.0"
  },
  "jest": {
    "testEnvironment": "jsdom",
    "testMatch": [
      "**/tests/js/**/*.test.js"
    ]
  }
}
```

Sample JS test (tests/js/navigation.test.js):

```javascript
describe('Navigation', () => {
  // Setup DOM elements
  beforeEach(() => {
    document.body.innerHTML = `
      <button class="mobile-menu-toggle"></button>
      <div class="mobile-menu hidden"></div>
    `;
  });
  
  test('toggle mobile menu shows/hides menu', () => {
    // Simulate loading the script
    require('../../src/js/navigation.js');
    
    const toggle = document.querySelector('.mobile-menu-toggle');
    const menu = document.querySelector('.mobile-menu');
    
    // Initial state
    expect(menu.classList.contains('hidden')).toBe(true);
    
    // Click to show
    toggle.click();
    expect(menu.classList.contains('hidden')).toBe(false);
    
    // Click to hide
    toggle.click();
    expect(menu.classList.contains('hidden')).toBe(true);
  });
});
```

### Visual Regression Testing

Using Percy for visual testing:

1. Install Percy CLI:
```bash
npm install --save-dev @percy/cli
```

2. Add to package.json:
```json
{
  "scripts": {
    "percy": "percy snapshot ./percy-snapshots.yml"
  }
}
```

3. Create percy-snapshots.yml:
```yaml
version: 1
snapshot:
  widths: [375, 768, 1280]
  minHeight: 1024
  percyCSS: ""
  enableJavaScript: true
  disableShadowDOM: false
urls:
  - /
  - /blog
  - /blog/sample-post
  - /about
```

### Cross-browser Testing Checklist

- [ ] Chrome (latest 2 versions)
- [ ] Firefox (latest 2 versions)
- [ ] Safari 14+
- [ ] Edge (latest 2 versions)
- [ ] Mobile Safari (iOS 14+)
- [ ] Chrome for Android (latest)
- [ ] Check responsive layouts at 320px, 768px, 1024px, 1440px

## 9. Deployment & Version Control

### Git Workflow

```bash
# Create feature branch
git checkout -b feature/component-name

# Make changes, then commit
git add .
git commit -m "feat: Convert component-name to WordPress template"

# Push to remote
git push origin feature/component-name

# Create PR for review
# After review, merge to develop branch
```

### CI/CD Pipeline

Create .github/workflows/ci-cd.yml:

```yaml
name: Theme CI/CD

on:
  push:
    branches: [main, develop]
  pull_request:
    branches: [main, develop]

jobs:
  lint:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - name: Setup Node.js
        uses: actions/setup-node@v3
        with:
          node-version: '16'
      - name: Install dependencies
        run: npm ci
      - name: Lint JavaScript
        run: npx eslint src/js/
      - name: Lint PHP
        uses: szepeviktor/phpcs-action@v1
        with:
          standard: phpcs.xml
  
  build:
    needs: lint
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - name: Setup Node.js
        uses: actions/setup-node@v3
        with:
          node-version: '16'
      - name: Install dependencies
        run: npm ci
      - name: Build assets
        run: npm run prod
      - name: Upload build artifacts
        uses: actions/upload-artifact@v3
        with:
          name: theme-build
          path: assets/
  
  test:
    needs: build
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - name: Setup Node.js
        uses: actions/setup-node@v3
        with:
          node-version: '16'
      - name: Install dependencies
        run: npm ci
      - name: Run JavaScript tests
        run: npm test
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '7.4'
          tools: composer:v2
      - name: Install PHP dependencies
        run: composer install
      - name: Run PHP tests
        run: vendor/bin/phpunit
  
  deploy:
    if: github.ref == 'refs/heads/main'
    needs: test
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - name: Download build artifacts
        uses: actions/download-artifact@v3
        with:
          name: theme-build
          path: assets/
      - name: Create theme package
        run: |
          mkdir -p build
          zip -r build/theme.zip . -x "node_modules/*" ".git/*" "tests/*" "*.log" "build/*"
      - name: Deploy to production
        uses: burnett01/rsync-deployments@5.2
        with:
          switches: -avz --delete
          path: build/theme.zip
          remote_path: ${{ secrets.DEPLOY_PATH }}
          remote_host: ${{ secrets.DEPLOY_HOST }}
          remote_user: ${{ secrets.DEPLOY_USER }}
          remote_key: ${{ secrets.DEPLOY_KEY }}
      - name: Create GitHub release
        uses: softprops/action-gh-release@v1
        if: startsWith(github.ref, 'refs/tags/')
        with:
          files: build/theme.zip
          name: Release ${{ github.ref_name }}
          body_path: CHANGELOG.md
```

### Version Management

Create `.version` file for semantic versioning:

```
1.0.0
```

Add release script to package.json:

```json
{
  "scripts": {
    "version": "conventional-changelog -p angular -i CHANGELOG.md -s && git add CHANGELOG.md",
    "release:patch": "npm version patch && git push && git push --tags",
    "release:minor": "npm version minor && git push && git push --tags",
    "release:major": "npm version major && git push && git push --tags"
  },
  "devDependencies": {
    "conventional-changelog-cli": "^2.2.2"
  }
}
```

## 10. Security, SEO & Performance

### Security Hardening

1. **Input Validation and Sanitization**:
   - User inputs: `sanitize_text_field()`, `sanitize_textarea_field()`, `sanitize_email()`
   - URLs: `esc_url()`, `esc_url_raw()`
   - HTML output: `esc_html()`, `wp_kses_post()`

2. **Nonce Verification**:
   - Forms: `wp_create_nonce()` and `wp_verify_nonce()`
   - AJAX: Check nonces on all requests

3. **Capability Checks**:
   - Always check user capabilities: `current_user_can()`

4. **Secure Headers**:
   Enable these headers via PHP or .htaccess:
   ```
   Content-Security-Policy
   X-XSS-Protection
   X-Content-Type-Options
   Referrer-Policy
   ```

### SEO Implementation

Replace React Helmet with proper WordPress head functions:

```php
<?php
// In functions.php or inc/seo.php

function theme_meta_description() {
    if (is_singular()) {
        global $post;
        
        // Try custom field first
        $description = get_post_meta($post->ID, 'meta_description', true);
        
        // Fall back to excerpt
        if (!$description) {
            $description = wp_trim_words(get_the_excerpt(), 30, '...');
        }
        
        if ($description) {
            echo '<meta name="description" content="' . esc_attr($description) . '" />';
        }
    }
}
add_action('wp_head', 'theme_meta_description');

function theme_open_graph_tags() {
    if (is_singular()) {
        global $post;
        
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '" />';
        echo '<meta property="og:type" content="article" />';
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />';
        
        if (has_post_thumbnail()) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            echo '<meta property="og:image" content="' . esc_url($image[0]) . '" />';
        }
    }
}
add_action('wp_head', 'theme_open_graph_tags');
```

### Performance Optimization

1. **Script Loading**:
   ```php
   wp_enqueue_script('theme-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', array(
       'strategy' => 'defer',
       'in_footer' => true,
   ));
   ```

2. **Image Optimization**:
   ```php
   add_theme_support('responsive-embeds');
   add_image_size('blog-thumbnail', 800, 450, true);
   ```

3. **Resource Hints**:
   ```php
   function theme_resource_hints($hints, $relation_type) {
       if ('preconnect' === $relation_type) {
           // Add Google Fonts domain
           $hints[] = 'https://fonts.googleapis.com';
           $hints[] = 'https://fonts.gstatic.com';
       }
       return $hints;
   }
   add_filter('wp_resource_hints', 'theme_resource_hints', 10, 2);
   ```

4. **Performance Targets**:
   - Time to First Byte (TTFB): < 200ms
   - First Contentful Paint (FCP): < 1s
   - Largest Contentful Paint (LCP): < 2.5s
   - Cumulative Layout Shift (CLS): < 0.1
   - Total Blocking Time (TBT): < 300ms

## 11. AI-Agent-Specific Guidance

### Task Breakdown

```json
{
  "conversionTasks": [
    {
      "id": "setup",
      "name": "Setup project structure",
      "dependencies": [],
      "steps": [
        "Create theme directory structure",
        "Configure package.json and build tools",
        "Setup theme style.css and functions.php"
      ]
    },
    {
      "id": "static-components",
      "name": "Convert static components",
      "dependencies": ["setup"],
      "steps": [
        "Convert Header.tsx to header.php",
        "Convert Footer.tsx to footer.php",
        "Convert Layout.tsx structure to be used in templates"
      ]
    },
    {
      "id": "templates",
      "name": "Convert page templates",
      "dependencies": ["static-components"],
      "steps": [
        "Convert Homepage.tsx to front-page.php",
        "Convert BlogTemplate.tsx to index.php and archive.php",
        "Convert SinglePostTemplate.tsx to single.php",
        "Convert PageTemplate.tsx to page.php",
        "Create 404.php from NotFound.tsx"
      ]
    },
    {
      "id": "dynamic-components",
      "name": "Convert dynamic components",
      "dependencies": ["static-components"],
      "steps": [
        "Convert PostCard.tsx to template-parts/content/content-card.php",
        "Convert TableOfContents.tsx to template-parts/content/table-of-contents.php",
        "Convert other dynamic components to template parts"
      ]
    },
    {
      "id": "scripts",
      "name": "Convert JavaScript functionality",
      "dependencies": ["templates", "dynamic-components"],
      "steps": [
        "Convert navigation.js to vanilla JS",
        "Convert table-of-contents.js to vanilla JS",
        "Ensure all interactive elements work properly"
      ]
    },
    {
      "id": "build-assets",
      "name": "Build and optimize assets",
      "dependencies": ["scripts"],
      "steps": [
        "Compile CSS with Tailwind",
        "Bundle and minify JavaScript",
        "Optimize images and other assets"
      ]
    },
    {
      "id": "test",
      "name": "Test the theme",
      "dependencies": ["build-assets"],
      "steps": [
        "Test in development environment",
        "Verify all pages render correctly",
        "Check responsive layouts",
        "Validate accessibility compliance"
      ]
    }
  ]
}
```

### Error Handling Guidelines

1. **Build Failures**:
   - Check console output for specific error messages
   - Verify file paths and imports
   - Check for syntax errors in PHP files
   - Validate CSS selector syntax

2. **WordPress Hook Issues**:
   - If a WordPress hook is missing, verify:
     - Hook name spelling
     - Hook priority (default is 10)
     - Number of arguments (default is 1)
     - Hook is registered before it's used

3. **PHP Errors**:
   - Check the PHP error log: `wp-content/debug.log`
   - Use `try/catch` blocks for error-prone code
   - Validate data before using it

### Progress Logging Format

Create a `logs/agent.log` file with this structure:

```
[YYYY-MM-DD HH:MM:SS] [LEVEL] Message
```

Example logging implementation:

```php
function agent_log($message, $level = 'INFO') {
    $log_file = __DIR__ . '/logs/agent.log';
    $timestamp = date('Y-m-d H:i:s');
    $log_message = "[{$timestamp}] [{$level}] {$message}" . PHP_EOL;
    
    if (!file_exists(dirname($log_file))) {
        mkdir(dirname($log_file), 0755, true);
    }
    
    file_put_contents($log_file, $log_message, FILE_APPEND);
}

// Usage
agent_log('Starting conversion of Header component', 'INFO');
agent_log('Error in navigation.js: Uncaught TypeError', 'ERROR');
```

## Component to Template Mapping

| React Component | WordPress File | Description |
|-----------------|----------------|-------------|
| `static/Header.tsx` | `header.php` | Site header with navigation |
| `static/Footer.tsx` | `footer.php` | Site footer with copyright and links |
| `static/Layout.tsx` | Incorporated into all templates | Layout wrapper |
| `templates/Homepage.tsx` | `front-page.php` | Home page template |
| `templates/BlogTemplate.tsx` | `index.php` & `archive.php` | Blog listing template |
| `templates/SinglePostTemplate.tsx` | `single.php` | Single post display |
| `templates/PageTemplate.tsx` | `page.php` | Page display |
| `dynamic/PostList.tsx` | WordPress loop in templates | Post listing logic |
| `dynamic/PostCard.tsx` | Template part for post display | Individual post card |
| `dynamic/PageContent.tsx` | Template part for content | Page content display |
| `TableOfContents.tsx` | Custom function/shortcode | Table of contents feature |

## Conversion Steps

### 1. Setup Theme Basics

1. Create a new folder in `wp-content/themes/` with your theme name
2. Create `style.css` with theme metadata:

```css
/*
Theme Name: [Your Theme Name]
Theme URI: [Your Theme URI]
Author: [Your Name]
Author URI: [Your Website]
Description: [Theme Description]
Version: 1.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: [theme-text-domain]
*/
```

3. Create `functions.php` with basic theme setup:

```php
<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Theme setup
function theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'theme-textdomain'),
        'footer' => __('Footer Menu', 'theme-textdomain'),
    ));
}
add_action('after_setup_theme', 'theme_setup');

// Enqueue scripts and styles
function theme_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('theme-style', get_stylesheet_uri());
    
    // Enqueue Tailwind CSS
    wp_enqueue_style('tailwind-css', get_template_directory_uri() . '/assets/css/tailwind.css');
    
    // Enqueue theme JavaScript
    wp_enqueue_script('theme-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'theme_scripts');

// Include additional functionality
require_once get_template_directory() . '/inc/template-functions.php';
require_once get_template_directory() . '/inc/table-of-contents.php';

```

### 2. Converting Static Components

#### Header.tsx to header.php

```php
<?php
/**
 * The header for our theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-dark-200'); ?>>
<?php wp_body_open(); ?>

<header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 <?php echo (is_front_page() && !is_paged()) ? 'bg-transparent py-2 md:py-4' : 'bg-dark-100/90 backdrop-blur-md shadow-md'; ?>">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between <?php echo (is_front_page() && !is_paged()) ? 'h-16 md:h-20' : 'h-16'; ?>">
            <!-- Logo -->
            <div class="flex items-center">
                <?php if (has_custom_logo()): ?>
                    <div class="flex items-center space-x-2 group">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else: ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center space-x-2 group">
                        <div class="w-8 h-8 md:w-10 md:h-10 relative flex items-center justify-center">
                            <!-- SVG Logo converted to inline PHP -->
                            <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full transition-transform duration-300 ease-out group-hover:scale-110">
                                <path d="M50 5L95 27.5V72.5L50 95L5 72.5V27.5L50 5Z" stroke="currentColor" stroke-width="2" class="text-blue-300"/>
                                <path d="M50 20L85 37.5V70L50 87.5L15 70V37.5L50 20Z" stroke="currentColor" stroke-width="2" class="text-white"/>
                                <path d="M15 37.5L50 55L85 37.5" stroke="currentColor" stroke-width="2" class="text-white"/>
                                <path d="M50 55V87.5" stroke="currentColor" stroke-width="2" class="text-white"/>
                            </svg>
                        </div>
                        <span class="text-lg md:text-xl font-display font-medium tracking-tight">
                            <?php bloginfo('name'); ?>
                        </span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-6">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => '',
                    'fallback_cb' => false,
                    'items_wrap' => '%3$s',
                    'depth' => 1,
                    'walker' => new Main_Nav_Walker() // Custom walker defined in inc/walker.php
                ));
                ?>
            </nav>

            <!-- Mobile Menu Button -->
            <button type="button" class="inline-flex items-center justify-center md:hidden mobile-menu-toggle">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6 text-light-100 menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg class="h-6 w-6 text-light-100 close-icon hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden mobile-menu hidden absolute top-[64px] right-4 w-44 bg-dark-100/95 backdrop-blur-md shadow-lg rounded-md transition-all duration-300">
        <div class="px-2 py-2 space-y-1">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => '',
                'fallback_cb' => false,
                'items_wrap' => '%3$s',
                'depth' => 1,
                'walker' => new Mobile_Nav_Walker() // Custom walker defined in inc/walker.php
            ));
            ?>
        </div>
    </div>
</header>
```

#### Footer.tsx to footer.php

```php
<?php
/**
 * The template for displaying the footer
 */
?>

<footer class="bg-dark-300 border-t border-white/5">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo and Description -->
            <div class="md:col-span-2">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center space-x-2 mb-4">
                    <!-- SVG Logo -->
                    <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-8 h-8">
                        <path d="M50 5L95 27.5V72.5L50 95L5 72.5V27.5L50 5Z" stroke="currentColor" stroke-width="2" class="text-blue-300"/>
                        <path d="M50 20L85 37.5V70L50 87.5L15 70V37.5L50 20Z" stroke="currentColor" stroke-width="2" class="text-white"/>
                        <path d="M15 37.5L50 55L85 37.5" stroke="currentColor" stroke-width="2" class="text-white"/>
                        <path d="M50 55V87.5" stroke="currentColor" stroke-width="2" class="text-white"/>
                    </svg>
                    <span class="text-lg font-display font-medium">
                        <?php bloginfo('name'); ?>
                    </span>
                </a>
                <p class="text-light-100/60 max-w-md">
                    <?php echo get_theme_mod('footer_description', 'Providing the best content, SEO strategy, and web design services to grow your business online.'); ?>
                </p>
            </div>
            
            <!-- Navigation Links -->
            <div>
                <h4 class="text-sm font-medium uppercase tracking-wider mb-4 text-light-100/40">Navigation</h4>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container' => 'ul',
                    'container_class' => '',
                    'menu_class' => 'space-y-2',
                    'fallback_cb' => false,
                    'depth' => 1,
                    'walker' => new Footer_Nav_Walker() // Custom walker defined in inc/walker.php
                ));
                ?>
            </div>
            
            <!-- Social Links -->
            <div>
                <h4 class="text-sm font-medium uppercase tracking-wider mb-4 text-light-100/40">Connect</h4>
                <div class="flex space-x-4">
                    <?php if (get_theme_mod('social_twitter')): ?>
                    <a href="<?php echo esc_url(get_theme_mod('social_twitter')); ?>" target="_blank" rel="noopener noreferrer" class="text-light-100/70 hover:text-blue-300 transition-colors duration-200" aria-label="X (formerly Twitter)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </a>
                    <?php endif; ?>
                    
                    <?php if (get_theme_mod('social_linkedin')): ?>
                    <a href="<?php echo esc_url(get_theme_mod('social_linkedin')); ?>" target="_blank" rel="noopener noreferrer" class="text-light-100/70 hover:text-blue-300 transition-colors duration-200" aria-label="LinkedIn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="mt-12 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm text-light-100/40">
                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
            </p>
            <div class="mt-4 md:mt-0 flex space-x-6">
                <a href="<?php echo esc_url(get_privacy_policy_url()); ?>" class="text-sm text-light-100/40 hover:text-light-100/70 transition-colors duration-200">
                    Privacy Policy
                </a>
                <?php if (get_theme_mod('terms_page')): ?>
                <a href="<?php echo esc_url(get_permalink(get_theme_mod('terms_page'))); ?>" class="text-sm text-light-100/40 hover:text-light-100/70 transition-colors duration-200">
                    Terms of Service
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
```

### 3. Converting Dynamic Components

#### BlogTemplate.tsx to index.php/archive.php

```php
<?php
/**
 * The main template file
 */

get_header();
?>

<div class="pt-24 md:pt-32">
    <!-- Blog Header -->
    <div class="container mx-auto px-4 py-12 text-center">
        <div class="mb-4 bg-blue-300/10 text-blue-300 border-blue-300/20 py-1 px-3 rounded-full inline-block">
            <?php _e('Our Blog', 'theme-textdomain'); ?>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white hover:text-blue-300 transition-colors">
            <?php
            if (is_home()) {
                echo get_the_title(get_option('page_for_posts', true));
            } elseif (is_category()) {
                single_cat_title();
            } elseif (is_tag()) {
                single_tag_title();
            } elseif (is_author()) {
                the_post();
                echo get_the_author();
                rewind_posts();
            } elseif (is_day()) {
                echo get_the_date();
            } elseif (is_month()) {
                echo get_the_date('F Y');
            } elseif (is_year()) {
                echo get_the_date('Y');
            } else {
                _e('Archives', 'theme-textdomain');
            }
            ?>
        </h1>
        <p class="text-xl text-light-100/70 max-w-2xl mx-auto">
            <?php
            if (is_category() || is_tag()) {
                echo term_description();
            } elseif (is_home()) {
                echo get_post_field('post_content', get_option('page_for_posts'));
            } else {
                _e('Latest insights and updates from our team', 'theme-textdomain');
            }
            ?>
        </p>
    </div>
    
    <!-- Post List -->
    <section class="py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        get_template_part('template-parts/content/content', 'card');
                    endwhile;
                else :
                    get_template_part('template-parts/content/content', 'none');
                endif;
                ?>
            </div>
            
            <!-- Pagination -->
            <?php the_posts_pagination(array(
                'prev_text' => __('Previous', 'theme-textdomain'),
                'next_text' => __('Next', 'theme-textdomain'),
                'class' => 'mt-12 flex justify-center',
            )); ?>
        </div>
    </section>
</div>

<?php
get_footer();
```

#### SinglePostTemplate.tsx to single.php

```php
<?php
/**
 * The template for displaying single posts
 */

get_header();
?>

<article class="pt-24 md:pt-32">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <div class="mb-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center flex-wrap">
                    <li class="flex items-center">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-blue-300 hover:text-blue-200">Home</a>
                        <span class="mx-2 text-light-100/40">/</span>
                    </li>
                    <li class="flex items-center">
                        <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="text-blue-300 hover:text-blue-200">Blog</a>
                        <span class="mx-2 text-light-100/40">/</span>
                    </li>
                    <li class="text-light-100">
                        <?php the_title(); ?>
                    </li>
                </ol>
            </nav>
        </div>
        
        <!-- Back button -->
        <div class="mb-8">
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="inline-flex items-center text-blue-300 hover:text-blue-200 font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 w-4 h-4"><path d="m12 19-7-7 7-7"></path><path d="M19 12H5"></path></svg>
                Back to Blog
            </a>
        </div>
        
        <div class="max-w-4xl mx-auto flex">
            <!-- Main content area -->
            <div class="flex-1">
                <!-- Post Header with Featured Image -->
                <header class="mb-12 flex flex-col md:flex-row justify-between items-start gap-8">
                    <div class="flex-1">
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
                            <?php the_title(); ?>
                        </h1>
                        
                        <div class="text-light-100/60 text-sm">
                            <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                        </div>
                    </div>
                    
                    <!-- Featured Image as Thumbnail -->
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="w-full md:w-48 lg:w-64 flex-shrink-0 rounded-lg overflow-hidden">
                        <?php the_post_thumbnail('medium', array('class' => 'w-full h-auto object-cover')); ?>
                    </div>
                    <?php endif; ?>
                </header>
                
                <!-- Add Save and Share buttons -->
                <div class="flex justify-between mb-8">
                    <div class="flex items-center">
                        <div class="flex gap-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center rounded-full h-8 w-8 border border-white/10 hover:bg-dark-100/50">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-300"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center rounded-full h-8 w-8 border border-white/10 hover:bg-dark-100/50">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-300"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path></svg>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center rounded-full h-8 w-8 border border-white/10 hover:bg-dark-100/50">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-300"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect width="4" height="12" x="2" y="9"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="button" class="flex items-center px-3 py-2 text-sm text-blue-300 border-white/10 hover:bg-dark-100/50 hover:text-blue-400 border rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1 text-blue-300"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            Save
                        </button>
                        <button type="button" class="flex items-center px-3 py-2 text-sm text-blue-300 border-white/10 hover:bg-dark-100/50 hover:text-blue-400 border rounded-md js-share-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1 text-blue-300"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg>
                            Share
                        </button>
                    </div>
                </div>
                
                <!-- Post Content -->
                <div id="post-content" class="prose prose-lg prose-invert max-w-none">
                    <?php the_content(); ?>
                </div>
            </div>
            
            <!-- Table of Contents -->
            <?php get_template_part('template-parts/content/table-of-contents'); ?>
        </div>
    </div>
</article>

<?php
get_footer();
```

#### PageTemplate.tsx to page.php

```php
<?php
/**
 * The template for displaying pages
 */

get_header();
?>

<div class="pt-24 md:pt-32">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Page Header with Featured Image -->
            <header class="mb-12 flex flex-col md:flex-row justify-between items-start gap-8">
                <div class="flex-1">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
                        <?php the_title(); ?>
                    </h1>
                </div>
                
                <!-- Featured Image as Thumbnail -->
                <?php if (has_post_thumbnail()) : ?>
                <div class="w-full md:w-48 lg:w-64 flex-shrink-0 rounded-lg overflow-hidden">
                    <?php the_post_thumbnail('medium', array('class' => 'w-full h-auto object-cover')); ?>
                </div>
                <?php endif; ?>
            </header>
            
            <!-- Page Content -->
            <div class="prose prose-lg prose-invert max-w-none">
                <?php 
                while (have_posts()) : 
                    the_post();
                    the_content();
                endwhile;
                ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
```

### 4. Converting Dynamic Components to Template Parts

#### PostCard.tsx to template-parts/content/content-card.php

```php
<?php
/**
 * Template part for displaying post cards
 */
?>

<article class="glass-card rounded-xl overflow-hidden transition-all duration-300 hover:shadow-lg">
    <?php if (has_post_thumbnail()) : ?>
    <div class="relative h-48 overflow-hidden">
        <?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover transition-transform duration-300 hover:scale-105')); ?>
    </div>
    <?php endif; ?>
    
    <div class="p-6">
        <?php
        $categories = get_the_category();
        if ($categories) : 
        ?>
        <div class="flex flex-wrap gap-2 mb-3">
            <?php foreach ($categories as $category) : ?>
            <span class="bg-blue-300/10 text-blue-300 py-1 px-2 text-xs rounded-full">
                <?php echo esc_html($category->name); ?>
            </span>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        
        <time class="text-sm text-light-100/60 mb-2 block"><?php echo get_the_date(); ?></time>
        
        <h3 class="text-xl font-medium mb-3 line-clamp-2">
            <a href="<?php the_permalink(); ?>" class="text-white hover:text-blue-300 transition-colors">
                <?php the_title(); ?>
            </a>
        </h3>
        
        <p class="text-light-100/70 mb-4 line-clamp-3">
            <?php echo get_the_excerpt(); ?>
        </p>
        
        <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-blue-300 hover:text-blue-200 font-medium transition-colors">
            Read More 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1 w-4 h-4"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
        </a>
    </div>
</article>
```

#### TableOfContents.tsx to template-parts/content/table-of-contents.php

```php
<?php
/**
 * Template part for displaying table of contents
 */
?>

<?php 
// Generate table of contents
$content = apply_filters('the_content', get_the_content());
preg_match_all('/<h([2-4]).*?id="(.*?)".*?>(.*?)<\/h[2-4]>/', $content, $matches);

if (count($matches[0]) > 0) : ?>
<div class="w-64 flex-shrink-0 hidden xl:block ml-8">
    <div class="sticky top-24 space-y-4">
        <div class="flex items-center gap-2 font-medium text-blue-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="6" height="6" x="4" y="4"></rect><rect width="6" height="6" x="14" y="4"></rect><rect width="6" height="6" x="4" y="14"></rect><rect width="6" height="6" x="14" y="14"></rect></svg>
            <h3>Table of Contents</h3>
        </div>
        
        <div class="h-[calc(100vh-200px)] pr-4 overflow-y-auto">
            <nav class="flex flex-col space-y-1">
                <?php for ($i = 0; $i < count($matches[0]); $i++) : 
                    $level = intval($matches[1][$i]);
                    $id = $matches[2][$i];
                    $title = strip_tags($matches[3][$i]);
                    
                    // Generate classes based on heading level
                    $classes = "text-sm py-1 hover:text-blue-300 transition-colors";
                    if ($level === 2) {
                        $classes .= " font-medium text-light-100/70";
                    } elseif ($level === 3) {
                        $classes .= " pl-3 text-xs text-light-100/70";
                    } elseif ($level === 4) {
                        $classes .= " pl-6 text-xs text-light-100/70";
                    }
                ?>
                    <a href="#<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
                        <?php echo esc_html($title); ?>
                    </a>
                <?php endfor; ?>
            </nav>
        </div>
    </div>
</div>
<?php endif; ?>
```

### 5. Custom Functions and Utilities

#### inc/table-of-contents.php

```php
<?php
/**
 * Table of Contents functionality
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Generate Table of Contents from content
 * 
 * @param string $content The post content
 * @return array Array of headings with id, text and level
 */
function theme_get_toc_items($content) {
    $headings = array();
    
    // Extract headings from content
    preg_match_all('/<h([2-4]).*?id="(.*?)".*?>(.*?)<\/h[2-4]>/', $content, $matches);
    
    if (count($matches[0]) > 0) {
        for ($i = 0; $i < count($matches[0]); $i++) {
            $headings[] = array(
                'level' => intval($matches[1][$i]),
                'id' => $matches[2][$i],
                'text' => strip_tags($matches[3][$i])
            );
        }
    }
    
    return $headings;
}

/**
 * Add IDs to headings in content for TOC
 *
 * @param string $content The post content
 * @return string Modified content with IDs added to headings
 */
function theme_add_ids_to_headings($content) {
    $content = preg_replace_callback('/<h([2-4])>(.*?)<\/h([2-4])>/', function($matches) {
        // Create ID from heading text
        $id = sanitize_title($matches[2]);
        return sprintf('<h%1$s id="%3$s">%2$s</h%1$s>', $matches[1], $matches[2], $id);
    }, $content);
    
    return $content;
}
add_filter('the_content', 'theme_add_ids_to_headings', 99);

/**
 * Add JavaScript for TOC interactivity
 */
function theme_toc_scripts() {
    if (is_single()) {
        // Only add to single posts
        wp_enqueue_script(
            'toc-script',
            get_template_directory_uri() . '/assets/js/table-of-contents.js',
            array('jquery'),
            '1.0.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'theme_toc_scripts');
```

#### inc/template-functions.php

```php
<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Add custom classes to the array of body classes
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function theme_body_classes($classes) {
    // Add a class if there is a cover image
    if (has_post_thumbnail()) {
        $classes[] = 'has-cover-image';
    }
    
    // Add specific class to blog page
    if (is_home() || is_archive() || is_search()) {
        $classes[] = 'blog-page';
    }
    
    return $classes;
}
add_filter('body_class', 'theme_body_classes');

/**
 * Register widget areas
 */
function theme_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'theme-textdomain'),
        'id'            => 'footer-widgets',
        'description'   => __('Widgets in this area will be displayed in the footer.', 'theme-textdomain'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-sm font-medium uppercase tracking-wider mb-4 text-light-100/40">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'theme_widgets_init');

/**
 * Custom navigation menu walkers
 */
class Main_Nav_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        
        $output .= '<a href="' . esc_url($item->url) . '" class="text-base md:text-lg font-medium text-light-100 hover:text-blue-300 transition-colors duration-200 hover-underline">' . $item->title . '</a>';
    }
}

class Mobile_Nav_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        
        $output .= '<a href="' . esc_url($item->url) . '" class="block py-2 px-3 text-sm font-medium rounded-md hover:bg-dark-300 transition-colors text-light-100">' . $item->title . '</a>';
    }
}

class Footer_Nav_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        
        $output .= '<li><a href="' . esc_url($item->url) . '" class="text-light-100/70 hover:text-light-100 transition-colors duration-200">' . $item->title . '</a></li>';
    }
}
```

### 6. Assets and Additional Files

#### assets/js/main.js

```js
/**
 * Main theme JavaScript file
 */

// Mobile menu functionality
document.addEventListener('DOMContentLoaded', function() {
  const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
  const mobileMenu = document.querySelector('.mobile-menu');
  const menuIcon = document.querySelector('.menu-icon');
  const closeIcon = document.querySelector('.close-icon');
  
  if (mobileMenuToggle) {
    mobileMenuToggle.addEventListener('click', function() {
      mobileMenu.classList.toggle('hidden');
      menuIcon.classList.toggle('hidden');
      closeIcon.classList.toggle('hidden');
    });
  }
  
  // Close mobile menu on window resize (to desktop)
  window.addEventListener('resize', function() {
    if (window.innerWidth >= 768) {
      if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
        mobileMenu.classList.add('hidden');
        menuIcon.classList.remove('hidden');
        closeIcon.classList.add('hidden');
      }
    }
  });
});

// Add header background on scroll
window.addEventListener('scroll', function() {
  const header = document.querySelector('header');
  if (header) {
    if (window.scrollY > 20) {
      header.classList.add('bg-dark-100/90', 'backdrop-blur-md', 'shadow-md');
      header.classList.remove('py-2', 'md:py-4');
    } else {
      header.classList.remove('bg-dark-100/90', 'backdrop-blur-md', 'shadow-md');
      if (document.body.classList.contains('home')) {
        header.classList.add('py-2', 'md:py-4');
      }
    }
  }
});
```

#### assets/js/table-of-contents.js

```js
/**
 * Table of Contents functionality
 */

document.addEventListener('DOMContentLoaded', function() {
  // Handle smooth scrolling for TOC links
  const tocLinks = document.querySelectorAll('.w-64 a[href^="#"]');
  
  tocLinks.forEach(function(link) {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const targetId = this.getAttribute('href').substring(1);
      const targetElement = document.getElementById(targetId);
      
      if (targetElement) {
        window.scrollTo({
          top: targetElement.offsetTop - 100,
          behavior: 'smooth'
        });
      }
    });
  });
  
  // Active TOC item highlighting on scroll
  const headings = document.querySelectorAll('h2[id], h3[id], h4[id]');
  
  if (headings.length > 0) {
    const observerOptions = {
      rootMargin: '0px 0px -80% 0px',
      threshold: 0.1
    };
    
    const headingObserver = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          // Remove active class from all TOC items
          document.querySelectorAll('.w-64 a').forEach(function(item) {
            item.classList.remove('text-blue-300');
          });
          
          // Add active class to current TOC item
          const activeLink = document.querySelector('.w-64 a[href="#' + entry.target.id + '"]');
          if (activeLink) {
            activeLink.classList.add('text-blue-300');
          }
        }
      });
    }, observerOptions);
    
    headings.forEach(function(heading) {
      headingObserver.observe(heading);
    });
  }
});
```

### 7. Theme Customizer Settings

Add this to `functions.php`:

```php
/**
 * Customizer settings
 */
require_once get_template_directory() . '/inc/customizer.php';
```

And create `inc/customizer.php`:

```php
<?php
/**
 * Theme Customizer settings
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

function theme_customize_register($wp_customize) {
    // Social Media Section
    $wp_customize->add_section('theme_social_settings', array(
        'title'    => __('Social Media', 'theme-textdomain'),
        'priority' => 30,
    ));
    
    // Twitter URL
    $wp_customize->add_setting('social_twitter', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('social_twitter', array(
        'label'    => __('Twitter URL', 'theme-textdomain'),
        'section'  => 'theme_social_settings',
        'type'     => 'url',
    ));
    
    // LinkedIn URL
    $wp_customize->add_setting('social_linkedin', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('social_linkedin', array(
        'label'    => __('LinkedIn URL', 'theme-textdomain'),
        'section'  => 'theme_social_settings',
        'type'     => 'url',
    ));
    
    // Footer Settings
    $wp_customize->add_section('theme_footer_settings', array(
        'title'    => __('Footer Settings', 'theme-textdomain'),
        'priority' => 40,
    ));
    
    // Footer Description
    $wp_customize->add_setting('footer_description', array(
        'default'           => __('Providing the best content, SEO strategy, and web design services to grow your business online.', 'theme-textdomain'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('footer_description', array(
        'label'    => __('Footer Description', 'theme-textdomain'),
        'section'  => 'theme_footer_settings',
        'type'     => 'textarea',
    ));
    
    // Terms Page
    $wp_customize->add_setting('terms_page', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('terms_page', array(
        'label'    => __('Terms of Service Page', 'theme-textdomain'),
        'section'  => 'theme_footer_settings',
        'type'     => 'dropdown-pages',
    ));
}
add_action('customize_register', 'theme_customize_register');
```

## Integration of Tailwind CSS

### Option 1: Include Pre-built CSS

1. Build your React project with Tailwind
2. Copy the final CSS output to the WordPress theme
3. Enqueue the CSS in your WordPress theme

### Option 2: Build Tailwind in WordPress

1. Set up a build process in your WordPress theme
2. Include a package.json and tailwind.config.js
3. Configure Tailwind to scan your PHP files
4. Use a script to build CSS when developing

Example tailwind.config.js for WordPress theme:

```js
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './inc/**/*.php',
    './template-parts/**/*.php',
  ],
  theme: {
    extend: {
      colors: {
        'blue-300': '#3b82f6',
        'dark-100': '#0f172a',
        'dark-200': '#0a0f1c',
        'dark-300': '#0d1424',
        'light-100': '#f8fafc',
      },
      fontFamily: {
        'display': ['var(--font-display)', 'sans-serif'],
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
  darkMode: 'class',
}
```

## JavaScript Conversion Notes

1. Replace React state hooks with JavaScript variables and DOM manipulation
2. Replace React event handlers with native event listeners
3. Replace React components with template parts
4. Use PHP to generate dynamic content instead of JSX

## Important Considerations

1. **Template Hierarchy**: WordPress uses a specific template hierarchy to decide which template file to use. Make sure to understand this when converting React routes.

2. **WordPress Hooks**: Use WordPress action and filter hooks instead of React lifecycle methods.

3. **Database Integration**: WordPress stores content in a database. Use WordPress functions like `get_posts()`, `the_content()`, etc. to retrieve content.

4. **Asset Enqueueing**: Use WordPress' `wp_enqueue_style()` and `wp_enqueue_script()` functions to include CSS and JavaScript.

5. **Plugin Compatibility**: Ensure your theme works with popular WordPress plugins.

6. **Translation/i18n**: Use WordPress' translation functions (`__()`, `_e()`, etc.) for multilingual support.

## Final Checklist

- [ ] Theme structure follows WordPress standards
- [ ] All static components converted to PHP templates
- [ ] All dynamic components use WordPress data fetching
- [ ] Styles properly converted and enqueued
- [ ] JavaScript properly converted and enqueued
- [ ] Theme supports WordPress features (menus, widgets, etc.)
- [ ] Theme is responsive and matches original design
- [ ] All paths and URLs are properly rendered using WordPress functions

## 12. Expanded Final Checklist

✅ | Area | Tool/Command
---|------|------------
[ ] | Local environment setup | `./setup.sh`
[ ] | Tailwind builds on file save | `npm run dev`
[ ] | PHP syntax validation | `php -l file.php`
[ ] | ESLint passes | `npx eslint src/js/`
[ ] | PHPCS passes | `vendor/bin/phpcs`
[ ] | All React routes mapped to WP permalinks | Manual verification
[ ] | Custom post types registered | Check in WP admin
[ ] | ACF fields registered | Check in WP admin
[ ] | Responsive on mobile devices | Browser testing
[ ] | WCAG 2.1 AA compliance | Accessibility audit
[ ] | Lighthouse performance score > 90 | Lighthouse CI
[ ] | Cross-browser compatibility | Manual testing
[ ] | SEO meta tags present | View page source
[ ] | Security headers enabled | Mozilla Observatory
[ ] | JS interactivity works | Manual testing
[ ] | Theme packaged and version tagged | `npm run release:patch`
[ ] | All PHP errors and warnings fixed | Check debug.log
[ ] | Page load time < 2s | Chrome DevTools
[ ] | Code splitting implemented | Verify build output
[ ] | Images optimized | Check image sizes
[ ] | SVGs minified | Check SVG content
