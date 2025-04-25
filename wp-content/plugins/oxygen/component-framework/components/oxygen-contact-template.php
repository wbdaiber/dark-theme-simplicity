
<?php
// Template for Oxygen Builder
function render_react_contact_form() {
    ob_start();
    ?>
    <div id="contact-page-root"></div>
    
    <?php
    // Enqueue necessary scripts
    wp_enqueue_script('react', 'https://unpkg.com/react@18/umd/react.production.min.js', [], null, true);
    wp_enqueue_script('react-dom', 'https://unpkg.com/react-dom@18/umd/react-dom.production.min.js', [], null, true);
    wp_enqueue_script('zod', 'https://unpkg.com/zod@3.22.4/lib/index.umd.js', [], null, true);
    wp_enqueue_script('react-hook-form', 'https://unpkg.com/@hookform/resolvers@3.3.2/dist/zod.umd.js', ['zod'], null, true);
    
    // Load the base CSS for styling
    wp_enqueue_style('contact-form-styles', plugin_dir_url(__FILE__) . 'dist/contact-form.css', [], '1.0');
    
    // Enqueue your bundled component
    wp_enqueue_script('contact-form', plugin_dir_url(__FILE__) . 'dist/contact-form.js', ['react', 'react-dom', 'zod', 'react-hook-form'], '1.0', true);
    
    // Initialize the component
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pass WP nonce to the React app
        window.wpApiSettings = {
            nonce: "<?php echo wp_create_nonce('wp_rest'); ?>"
        };
        
        const root = ReactDOM.createRoot(document.getElementById('contact-page-root'));
        root.render(React.createElement(ContactPageWP));
    });
    </script>
    <?php
    return ob_get_clean();
}

// Register shortcode
add_shortcode('react_contact_form', 'render_react_contact_form');

// Register REST API endpoint for form submission
add_action('rest_api_init', function () {
    register_rest_route('contact-form/v1', '/submit', array(
        'methods' => 'POST',
        'callback' => function($request) {
            $params = $request->get_params();
            
            // Send email
            $to = get_option('admin_email');
            $subject = sanitize_text_field($params['subject']);
            $body = sprintf(
                "Name: %s\nEmail: %s\nMessage: %s",
                sanitize_text_field($params['name']),
                sanitize_email($params['email']),
                sanitize_textarea_field($params['message'])
            );
            
            $sent = wp_mail($to, $subject, $body);
            
            if ($sent) {
                return new WP_REST_Response(['message' => 'Message sent successfully'], 200);
            } else {
                return new WP_REST_Response(['message' => 'Failed to send message'], 500);
            }
        },
        'permission_callback' => function() {
            return true;
        }
    ));
});

// Register as Oxygen element
function oxygen_add_contact_form_element() {
    if (class_exists('OxygenElement')) {
        class Oxygen_Contact_Form extends OxygenElement {
            function init() {
                $this->El->useAJAXControls();
                $this->setAssetsPath(plugin_dir_url(__FILE__));
            }
            
            function name() {
                return 'React Contact Form';
            }
            
            function slug() {
                return 'react_contact_form';
            }
            
            function icon() {
                return 'mail';
            }
            
            function render($options, $defaults, $content) {
                echo render_react_contact_form();
            }
            
            function class_names() {
                return array('react-contact-form');
            }
            
            function controls() {
                // No additional controls needed
            }
        }
        
        new Oxygen_Contact_Form();
    }
}
add_action('oxygen_add_plus_components', 'oxygen_add_contact_form_element');
