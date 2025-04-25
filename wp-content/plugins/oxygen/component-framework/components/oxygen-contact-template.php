
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
    
    // Enqueue your bundled component (you'll need to adjust the path)
    wp_enqueue_script('contact-form', plugin_dir_url(__FILE__) . 'dist/contact-form.js', ['react', 'react-dom'], '1.0', true);
    
    // Initialize the component
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
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
