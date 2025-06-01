<?php
/**
 * Simple preview script for the theme
 * This allows viewing the single post template without a full WordPress installation
 */

// Mock WordPress functions that are used in the theme
function get_header() {
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dark Theme Simplicity Preview</title>
        <style>
            /* Basic dark theme styling */
            body {
                background-color: #121212;
                color: #f8fafc;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
                line-height: 1.6;
                margin: 0;
                padding: 0;
            }
            
            /* Include basic CSS from the theme */
            .container {
                width: 100%;
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
            }
            
            header {
                background-color: #1e1e24;
                padding: 20px 0;
                margin-bottom: 40px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }
            
            .bg-dark-300 {
                background-color: #1e1e24;
            }
            
            .rounded-xl {
                border-radius: 0.75rem;
            }
            
            .shadow-xl {
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
            
            .text-white {
                color: #ffffff;
            }
            
            .text-blue-300 {
                color: #60a5fa;
            }
            
            .mx-auto {
                margin-left: auto;
                margin-right: auto;
            }
            
            .max-w-6xl {
                max-width: 72rem;
            }
            
            .p-8 {
                padding: 2rem;
            }
            
            .mb-8 {
                margin-bottom: 2rem;
            }
            
            .flex {
                display: flex;
            }
            
            .flex-col {
                flex-direction: column;
            }
            
            .gap-8 {
                gap: 2rem;
            }
            
            .md\\:flex-row {
                flex-direction: row;
            }
            
            .entry-content {
                line-height: 1.6;
            }
            
            .prose {
                max-width: 65ch;
                color: rgba(248, 250, 252, 0.8);
            }
            
            /* Table of Contents styling */
            .table-of-contents {
                background-color: #282830;
                border-radius: 0.5rem;
                padding: 1.5rem;
                border: 1px solid rgba(255, 255, 255, 0.1);
                margin-top: 1rem;
            }
            
            .toc-heading {
                font-size: 1rem;
                font-weight: 600;
                color: #ffffff;
                margin-bottom: 1rem;
                display: block;
            }
            
            .toc-list {
                list-style: none;
                padding-left: 0.5rem;
                margin-top: 1rem;
            }
            
            .toc-item {
                margin-bottom: 0.5rem;
            }
            
            .toc-link {
                display: flex;
                align-items: flex-start;
                gap: 0.5rem;
                color: rgba(248, 250, 252, 0.85);
                text-decoration: none;
                transition: color 0.2s ease;
            }
            
            .toc-link:hover {
                color: #60a5fa;
            }
            
            /* Include CSS from seo-optimization.css */
            .entry-content h1 {
                font-size: 2.25rem;
                margin-top: 0;
                margin-bottom: 1.5rem;
                font-weight: 600;
                color: #ffffff;
            }
            
            .entry-content h2 {
                font-size: 1.875rem;
                margin-top: 3rem;
                margin-bottom: 1.25rem;
                font-weight: 600;
                color: #ffffff;
            }
            
            .entry-content h3 {
                font-size: 1.5rem;
                margin-top: 2.5rem;
                margin-bottom: 1rem;
                font-weight: 600;
                color: #ffffff;
            }
            
            .entry-content p {
                font-size: 1.125rem;
                line-height: 1.6;
                margin-bottom: 1.5em;
                max-width: 65ch;
                color: rgba(248, 250, 252, 0.85);
            }
            
            /* Responsive design */
            @media (max-width: 767px) {
                .md\\:flex-row {
                    flex-direction: column;
                }
            }
            
            /* Add override for flex-row on medium screens */
            @media (min-width: 768px) {
                .md\\:flex-row {
                    flex-direction: row;
                }
            }
        </style>
    </head>
    <body>
        <header>
            <div class="container">
                <h1>Dark Theme Simplicity</h1>
            </div>
        </header>
    ';
}

function get_footer() {
    echo '
        <footer style="margin-top: 40px; padding: 20px 0; text-align: center; background-color: #1e1e24; border-top: 1px solid rgba(255, 255, 255, 0.1);">
            <div class="container">
                <p>&copy; ' . date('Y') . ' Dark Theme Simplicity</p>
            </div>
        </footer>
    </body>
    </html>';
}

function get_post_meta($id, $key, $single) {
    // Mock function that returns sample data
    if ($key == '_show_sidebar_widgets') return 'yes';
    if ($key == '_show_table_of_contents') return 'yes';
    if ($key == '_show_share_buttons') return 'yes';
    return '';
}

function get_theme_mod($setting, $default) {
    // Just return the default value
    return $default;
}

function get_the_ID() {
    return 1;
}

function the_post() {
    // Do nothing in the mock
}

function have_posts() {
    // Return true once, then false
    static $called = false;
    if (!$called) {
        $called = true;
        return true;
    }
    return false;
}

function post_class($class = '') {
    echo 'class="' . $class . '"';
}

function the_title() {
    echo 'Example Blog Post with SEO-Optimized Structure';
}

function the_content() {
    echo '<h2 id="introduction">Introduction</h2>
    <p>This is a sample blog post to demonstrate the SEO-optimized structure of the Dark Theme Simplicity WordPress theme. The changes we\'ve made improve semantic HTML structure and accessibility.</p>
    
    <h2 id="heading-hierarchy">Heading Hierarchy</h2>
    <p>We\'ve corrected the heading hierarchy by converting non-content headings like Table of Contents and Share This to semantic divs with ARIA roles. This helps search engines correctly understand the content structure.</p>
    
    <h3 id="document-outline">Document Outline</h3>
    <p>A proper document outline is crucial for SEO as it helps search engines understand the relationship between different sections of your content.</p>
    
    <h2 id="typography">Typography Standardization</h2>
    <p>We\'ve standardized paragraph typography to 1.125rem (18px) with 1.6 line-height, which is optimal for web reading according to Nielsen Norman Group research.</p>
    
    <h3 id="line-length">Line Length Optimization</h3>
    <p>The optimal line length for reading is between 65-75 characters. We\'ve implemented this using max-width: 65ch to ensure text is easily scannable and readable.</p>
    
    <h2 id="responsive-design">Responsive Design</h2>
    <p>We\'ve consolidated breakpoints to mobile (≤767px), tablet (768-1023px), and desktop (≥1024px) for a more consistent responsive experience.</p>';
}

function get_permalink() {
    return '#';
}

function custom_urlencode($str) {
    return rawurlencode($str);
}

function esc_url($url) {
    return $url;
}

function esc_html($str) {
    return htmlspecialchars($str);
}

function esc_js($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function esc_attr($str) {
    return htmlspecialchars($str);
}

function has_post_thumbnail() {
    return false;
}

function get_the_modified_date($format = '') {
    return date('F j, Y');
}

// Include the single.php template
echo '<div class="preview-notice" style="background-color: #60a5fa; color: #000; padding: 10px; text-align: center; margin-bottom: 20px;">
    <strong>Preview Mode:</strong> This is a simplified preview of the single post template without WordPress.
</div>';

// Extract the content from single.php and display it
$single_content = file_get_contents('single.php');

// Extract the main content section
$pattern = '/<main id="content" class="site-main.*?<\/main>/s';
if (preg_match($pattern, $single_content, $matches)) {
    echo '<div class="container">';
    // Output a simplified version of the content
    $main_content = $matches[0];
    
    // Replace PHP variables with placeholders
    $main_content = preg_replace('/\$[a-zA-Z_]+/', 'sample-class', $main_content);
    
    // Remove PHP conditionals and loops but keep their content
    $main_content = preg_replace('/<\?php\s+if\s+\([^)]+\)\s*:\s*\?>/', '', $main_content);
    $main_content = preg_replace('/<\?php\s+endif;\s*\?>/', '', $main_content);
    $main_content = preg_replace('/<\?php\s+while\s+\([^)]+\)\s*:\s*\?>/', '', $main_content);
    $main_content = preg_replace('/<\?php\s+endwhile;\s*\?>/', '', $main_content);
    $main_content = preg_replace('/<\?php\s+foreach\s+\([^)]+\)\s*:\s*\?>/', '', $main_content);
    $main_content = preg_replace('/<\?php\s+endforeach;\s*\?>/', '', $main_content);
    
    // Replace other PHP code with empty strings
    $main_content = preg_replace('/<\?php.*?\?>/s', '', $main_content);
    
    echo $main_content;
    echo '</div>';
} else {
    echo '<div class="container">';
    echo '<article class="max-w-6xl mx-auto bg-dark-300 rounded-xl shadow-xl overflow-hidden">
        <div class="p-8">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="flex-1 content-container">
                    <div class="entry-content prose prose-invert max-w-none text-light-100/80">
                        <h1>Example Blog Post</h1>
                        <p>This is a simplified preview of the blog post template. The SEO improvements include proper heading hierarchy, standardized typography, and accessible navigation.</p>
                        
                        <h2 id="heading-two">Example Heading Two</h2>
                        <p>Here is an example of content under a level two heading. Notice how the headings follow a proper hierarchy which is important for SEO.</p>
                        
                        <h3 id="heading-three">Example Heading Three</h3>
                        <p>This is content under a level three heading. The typography has been standardized to 1.125rem (18px) with 1.6 line-height for optimal readability.</p>
                    </div>
                </div>
                
                <div class="hidden md:block flex-shrink-0">
                    <div class="sticky top-24 space-y-4">
                        <div class="table-of-contents p-6 bg-dark-400 rounded-lg border border-white/10 mt-4">
                            <div class="toc-heading text-xl font-bold mb-4 text-white" role="heading" aria-level="2">Table of Contents</div>
                            <ul class="space-y-2 toc-list">
                                <li class="toc-item text-light-100/80 hover:text-blue-300">
                                    <a href="#heading-two" class="toc-link flex items-start gap-1 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-300 toc-caret mt-1 flex-shrink-0"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                        <span class="toc-text break-words">Example Heading Two</span>
                                    </a>
                                </li>
                                <li class="toc-item text-light-100/80 hover:text-blue-300">
                                    <a href="#heading-three" class="toc-link flex items-start gap-1 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-300 toc-caret mt-1 flex-shrink-0"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                        <span class="toc-text break-words">Example Heading Three</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>';
    echo '</div>';
}
?> 