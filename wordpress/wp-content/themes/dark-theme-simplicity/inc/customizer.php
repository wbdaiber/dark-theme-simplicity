<?php
/**
 * Dark Theme Simplicity Theme Customizer
 *
 * @package Dark_Theme_Simplicity
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if (!function_exists('dark_theme_simplicity_customize_register')) {
    function dark_theme_simplicity_customize_register( $wp_customize ) {
        // Add a panel for front page sections
        $wp_customize->add_panel( 'dark_theme_simplicity_frontpage_panel', array(
            'title'       => __( 'Front Page Sections', 'dark-theme-simplicity' ),
            'description' => __( 'Customize your front page sections', 'dark-theme-simplicity' ),
            'priority'    => 30,
        ) );

        // Add a section for site identity
        $wp_customize->add_section( 'dark_theme_simplicity_site_identity', array(
            'title'       => __( 'Site Identity', 'dark-theme-simplicity' ),
            'description' => __( 'Customize your site logo and title', 'dark-theme-simplicity' ),
            'priority'    => 20,
        ) );

        // Add a section for footer options
        $wp_customize->add_section( 'dark_theme_simplicity_footer_options', array(
            'title'       => __( 'Footer Options', 'dark-theme-simplicity' ),
            'description' => __( 'Customize footer elements and links', 'dark-theme-simplicity' ),
            'priority'    => 130,
        ) );

        // Add a section for social media links
        $wp_customize->add_section( 'dark_theme_simplicity_social_links', array(
            'title'       => __( 'Social Media Links', 'dark-theme-simplicity' ),
            'description' => __( 'Add your social media profile URLs here. These will display in the footer "Connect" section if you haven\'t created a Social menu. To fully customize the social links, create a menu and assign it to the "Social Menu" location.', 'dark-theme-simplicity' ),
            'priority'    => 135,
        ) );

        // Site Title
        $wp_customize->add_setting( 'dark_theme_simplicity_site_title', array(
            'default'           => __( 'Brad Daiber', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_site_title', array(
            'label'    => __( 'Site Title', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_site_identity',
            'settings' => 'dark_theme_simplicity_site_title',
            'type'     => 'text',
        ) );

        // Footer Tagline
        $wp_customize->add_setting( 'dark_theme_simplicity_footer_tagline', array(
            'default'           => __( 'Helping businesses establish a powerful online presence through strategic digital marketing solutions.', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_footer_tagline', array(
            'label'    => __( 'Footer Tagline Text', 'dark-theme-simplicity' ),
            'description' => __( 'The text that appears below the logo in the footer.', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_footer_options',
            'settings' => 'dark_theme_simplicity_footer_tagline',
            'type'     => 'textarea',
        ) );

        // Footer Copyright
        $wp_customize->add_setting( 'dark_theme_simplicity_footer_copyright', array(
            'default'           => __( 'Brad Daiber', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_footer_copyright', array(
            'label'    => __( 'Footer Copyright Name', 'dark-theme-simplicity' ),
            'description' => __( 'The name that appears in the copyright text. Year will be added automatically.', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_footer_options',
            'settings' => 'dark_theme_simplicity_footer_copyright',
            'type'     => 'text',
        ) );

        // Logo Color
        $wp_customize->add_setting( 'dark_theme_simplicity_logo_color', array(
            'default'           => '#60a5fa',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dark_theme_simplicity_logo_color', array(
            'label'    => __( 'Logo Color', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_site_identity',
            'settings' => 'dark_theme_simplicity_logo_color',
        ) ) );

        // Hero Section
        $wp_customize->add_section( 'dark_theme_simplicity_hero_section', array(
            'title'       => __( 'Hero Section', 'dark-theme-simplicity' ),
            'description' => __( 'Customize the hero section on the front page', 'dark-theme-simplicity' ),
            'panel'       => 'dark_theme_simplicity_frontpage_panel',
            'priority'    => 10,
        ) );

        // Hero Background Image
        $wp_customize->add_setting( 'dark_theme_simplicity_hero_bg_image', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'dark_theme_simplicity_hero_bg_image', array(
            'label'    => __( 'Background Image', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_hero_section',
            'settings' => 'dark_theme_simplicity_hero_bg_image',
        ) ) );

        // Hero Heading
        $wp_customize->add_setting( 'dark_theme_simplicity_hero_heading', array(
            'default'           => __( 'No fluff, just results.', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_hero_heading', array(
            'label'    => __( 'Heading', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_hero_section',
            'settings' => 'dark_theme_simplicity_hero_heading',
            'type'     => 'text',
        ) );

        // Hero Subheading
        $wp_customize->add_setting( 'dark_theme_simplicity_hero_subheading', array(
            'default'           => __( 'Digital assets that drive outsized return on investment.', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_hero_subheading', array(
            'label'    => __( 'Subheading', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_hero_section',
            'settings' => 'dark_theme_simplicity_hero_subheading',
            'type'     => 'text',
        ) );

        // Hero Button Color
        $wp_customize->add_setting( 'dark_theme_simplicity_hero_button_color', array(
            'default'           => '#0085ff', // Blue-300
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dark_theme_simplicity_hero_button_color', array(
            'label'    => __( 'Button Color', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_hero_section',
            'settings' => 'dark_theme_simplicity_hero_button_color',
        ) ) );

        // Hero Button Hover Color
        $wp_customize->add_setting( 'dark_theme_simplicity_hero_button_hover_color', array(
            'default'           => '#0057a7', // Blue-400
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dark_theme_simplicity_hero_button_hover_color', array(
            'label'    => __( 'Button Hover Color', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_hero_section',
            'settings' => 'dark_theme_simplicity_hero_button_hover_color',
        ) ) );
        
        // Hero Button Border Radius
        $wp_customize->add_setting( 'dark_theme_simplicity_hero_button_radius', array(
            'default'           => '0',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_hero_button_radius', array(
            'label'       => __( 'Button Border Radius (px)', 'dark-theme-simplicity' ),
            'section'     => 'dark_theme_simplicity_hero_section',
            'settings'    => 'dark_theme_simplicity_hero_button_radius',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 0,
                'max'  => 50,
                'step' => 1,
            ),
        ) );
        
        // Hero Button Text - Services
        $wp_customize->add_setting( 'dark_theme_simplicity_hero_button_services_text', array(
            'default'           => __( 'Services', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_hero_button_services_text', array(
            'label'    => __( 'Services Button Text', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_hero_section',
            'settings' => 'dark_theme_simplicity_hero_button_services_text',
            'type'     => 'text',
        ) );
        
        // Hero Button Text - Benefits
        $wp_customize->add_setting( 'dark_theme_simplicity_hero_button_benefits_text', array(
            'default'           => __( 'Benefits', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_hero_button_benefits_text', array(
            'label'    => __( 'Benefits Button Text', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_hero_section',
            'settings' => 'dark_theme_simplicity_hero_button_benefits_text',
            'type'     => 'text',
        ) );
        
        // Hero Button Text - Approach
        $wp_customize->add_setting( 'dark_theme_simplicity_hero_button_approach_text', array(
            'default'           => __( 'Approach', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_hero_button_approach_text', array(
            'label'    => __( 'Approach Button Text', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_hero_section',
            'settings' => 'dark_theme_simplicity_hero_button_approach_text',
            'type'     => 'text',
        ) );
        
        // Hero Button Text - About
        $wp_customize->add_setting( 'dark_theme_simplicity_hero_button_about_text', array(
            'default'           => __( 'About', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_hero_button_about_text', array(
            'label'    => __( 'About Button Text', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_hero_section',
            'settings' => 'dark_theme_simplicity_hero_button_about_text',
            'type'     => 'text',
        ) );
        
        // Hero Button Text - Contact
        $wp_customize->add_setting( 'dark_theme_simplicity_hero_button_contact_text', array(
            'default'           => __( 'Contact', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_hero_button_contact_text', array(
            'label'    => __( 'Contact Button Text', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_hero_section',
            'settings' => 'dark_theme_simplicity_hero_button_contact_text',
            'type'     => 'text',
        ) );

        // Hero Button Text Size
        $wp_customize->add_setting( 'dark_theme_simplicity_hero_button_text_size', array(
            'default'           => '18',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_hero_button_text_size', array(
            'label'       => __( 'Button Text Size (px)', 'dark-theme-simplicity' ),
            'section'     => 'dark_theme_simplicity_hero_section',
            'settings'    => 'dark_theme_simplicity_hero_button_text_size',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 12,
                'max'  => 30,
                'step' => 1,
            ),
        ) );
        
        // Hero Button Horizontal Padding
        $wp_customize->add_setting( 'dark_theme_simplicity_hero_button_padding_x', array(
            'default'           => '32',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_hero_button_padding_x', array(
            'label'       => __( 'Button Horizontal Padding (px)', 'dark-theme-simplicity' ),
            'section'     => 'dark_theme_simplicity_hero_section',
            'settings'    => 'dark_theme_simplicity_hero_button_padding_x',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 8,
                'max'  => 60,
                'step' => 2,
            ),
        ) );
        
        // Hero Button Vertical Padding
        $wp_customize->add_setting( 'dark_theme_simplicity_hero_button_padding_y', array(
            'default'           => '16',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_hero_button_padding_y', array(
            'label'       => __( 'Button Vertical Padding (px)', 'dark-theme-simplicity' ),
            'section'     => 'dark_theme_simplicity_hero_section',
            'settings'    => 'dark_theme_simplicity_hero_button_padding_y',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 4,
                'max'  => 30,
                'step' => 2,
            ),
        ) );

        // Hero Button Border Width
        $wp_customize->add_setting( 'dark_theme_simplicity_hero_button_border_width', array(
            'default'           => '0',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_hero_button_border_width', array(
            'label'       => __( 'Button Border Width (px)', 'dark-theme-simplicity' ),
            'section'     => 'dark_theme_simplicity_hero_section',
            'settings'    => 'dark_theme_simplicity_hero_button_border_width',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 0,
                'max'  => 5,
                'step' => 1,
            ),
        ) );
        
        // Hero Button Border Color
        $wp_customize->add_setting( 'dark_theme_simplicity_hero_button_border_color', array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dark_theme_simplicity_hero_button_border_color', array(
            'label'    => __( 'Button Border Color', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_hero_section',
            'settings' => 'dark_theme_simplicity_hero_button_border_color',
        ) ) );
        
        // Hero Button Font Weight
        $wp_customize->add_setting( 'dark_theme_simplicity_hero_button_font_weight', array(
            'default'           => '500',
            'sanitize_callback' => 'dark_theme_simplicity_sanitize_font_weight',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_hero_button_font_weight', array(
            'label'       => __( 'Button Font Weight', 'dark-theme-simplicity' ),
            'section'     => 'dark_theme_simplicity_hero_section',
            'settings'    => 'dark_theme_simplicity_hero_button_font_weight',
            'type'        => 'select',
            'choices'     => array(
                '300' => __( 'Light', 'dark-theme-simplicity' ),
                '400' => __( 'Regular', 'dark-theme-simplicity' ),
                '500' => __( 'Medium', 'dark-theme-simplicity' ),
                '600' => __( 'Semibold', 'dark-theme-simplicity' ),
                '700' => __( 'Bold', 'dark-theme-simplicity' ),
            ),
        ) );

        // Services Section
        $wp_customize->add_section( 'dark_theme_simplicity_services_section', array(
            'title'       => __( 'Services Section', 'dark-theme-simplicity' ),
            'description' => __( 'Customize the services section on the front page', 'dark-theme-simplicity' ),
            'panel'       => 'dark_theme_simplicity_frontpage_panel',
            'priority'    => 20,
        ) );

        // Services Section Title
        $wp_customize->add_setting( 'dark_theme_simplicity_services_title', array(
            'default'           => __( 'Our Services', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_services_title', array(
            'label'    => __( 'Section Title', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_services_section',
            'settings' => 'dark_theme_simplicity_services_title',
            'type'     => 'text',
        ) );

        // Services Section Description
        $wp_customize->add_setting( 'dark_theme_simplicity_services_description', array(
            'default'           => __( 'Comprehensive digital marketing solutions to elevate your online presence.', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_services_description', array(
            'label'    => __( 'Section Description', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_services_section',
            'settings' => 'dark_theme_simplicity_services_description',
            'type'     => 'textarea',
        ) );

        // Service Cards Background Color
        $wp_customize->add_setting( 'dark_theme_simplicity_service_card_bg_color', array(
            'default'           => '#1e1e24',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dark_theme_simplicity_service_card_bg_color', array(
            'label'    => __( 'Service Card Background Color', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_services_section',
            'settings' => 'dark_theme_simplicity_service_card_bg_color',
        ) ) );

        // Service Cards Accent Color
        $wp_customize->add_setting( 'dark_theme_simplicity_service_card_accent_color', array(
            'default'           => '#0085ff', // Blue-300
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dark_theme_simplicity_service_card_accent_color', array(
            'label'    => __( 'Service Card Accent Color', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_services_section',
            'settings' => 'dark_theme_simplicity_service_card_accent_color',
        ) ) );

        // Service Items Repeater
        $default_services = array(
            array(
                'icon' => 'globe',
                'title' => __('Strategic SEO', 'dark-theme-simplicity'),
                'description' => __('Boost your visibility with search engine optimization that drives organic traffic.', 'dark-theme-simplicity')
            ),
            array(
                'icon' => 'file-text',
                'title' => __('Content Creation', 'dark-theme-simplicity'),
                'description' => __('Engaging, on-brand content that resonates with your target audience.', 'dark-theme-simplicity')
            ),
            array(
                'icon' => 'monitor',
                'title' => __('Website Development', 'dark-theme-simplicity'),
                'description' => __('Custom websites designed for user experience and conversion optimization.', 'dark-theme-simplicity')
            ),
            array(
                'icon' => 'database',
                'title' => __('Brand Strategy', 'dark-theme-simplicity'),
                'description' => __('Cohesive visual identity and messaging that distinguishes your business.', 'dark-theme-simplicity')
            )
        );

        $wp_customize->add_setting( 'dark_theme_simplicity_service_items', array(
            'default'           => json_encode($default_services),
            'sanitize_callback' => 'dark_theme_simplicity_sanitize_repeater',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( new Dark_Theme_Simplicity_Customizer_Repeater_Control( $wp_customize, 'dark_theme_simplicity_service_items', array(
            'label'       => __( 'Service Items', 'dark-theme-simplicity' ),
            'section'     => 'dark_theme_simplicity_services_section',
            'fields'      => array(
                array(
                    'id'    => 'icon',
                    'type'  => 'select',
                    'label' => __( 'Icon', 'dark-theme-simplicity' ),
                    'choices' => array(
                        'globe'    => __( 'Globe (SEO)', 'dark-theme-simplicity' ),
                        'file-text' => __( 'Document (Content)', 'dark-theme-simplicity' ),
                        'monitor'  => __( 'Computer (Web Dev)', 'dark-theme-simplicity' ),
                        'database' => __( 'Database (Brand)', 'dark-theme-simplicity' ),
                        'bar-chart' => __( 'Chart (Analytics)', 'dark-theme-simplicity' ),
                        'users'    => __( 'Users (Social)', 'dark-theme-simplicity' ),
                        'search'   => __( 'Search', 'dark-theme-simplicity' ),
                        'mail'     => __( 'Email', 'dark-theme-simplicity' ),
                        'image'    => __( 'Image', 'dark-theme-simplicity' ),
                        'layout'   => __( 'Layout (Design)', 'dark-theme-simplicity' ),
                        'code'     => __( 'Code', 'dark-theme-simplicity' ),
                        'trending-up' => __( 'Trending Up (Growth)', 'dark-theme-simplicity' ),
                    ),
                ),
                array(
                    'id'    => 'title',
                    'type'  => 'text',
                    'label' => __( 'Title', 'dark-theme-simplicity' ),
                ),
                array(
                    'id'    => 'description',
                    'type'  => 'textarea',
                    'label' => __( 'Description', 'dark-theme-simplicity' ),
                ),
            ),
        ) ) );

        // Benefits Section
        $wp_customize->add_section( 'dark_theme_simplicity_benefits_section', array(
            'title'       => __( 'Benefits Section', 'dark-theme-simplicity' ),
            'description' => __( 'Customize the benefits section on the front page', 'dark-theme-simplicity' ),
            'panel'       => 'dark_theme_simplicity_frontpage_panel',
            'priority'    => 30,
        ) );

        // Benefits Section Title
        $wp_customize->add_setting( 'dark_theme_simplicity_benefits_title', array(
            'default'           => __( 'Key Benefits', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_benefits_title', array(
            'label'    => __( 'Section Title', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_benefits_section',
            'settings' => 'dark_theme_simplicity_benefits_title',
            'type'     => 'text',
        ) );

        // Benefits Section Description
        $wp_customize->add_setting( 'dark_theme_simplicity_benefits_description', array(
            'default'           => __( 'We deliver real results through strategic digital solutions tailored to your business goals.', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_benefits_description', array(
            'label'    => __( 'Section Description', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_benefits_section',
            'settings' => 'dark_theme_simplicity_benefits_description',
            'type'     => 'textarea',
        ) );

        // Benefits Items Repeater
        $default_benefits = array(
            array(
                'title' => __('Data-Driven', 'dark-theme-simplicity'),
                'description' => __('Our strategies are backed by thorough research and analytics for measurable outcomes.', 'dark-theme-simplicity')
            ),
            array(
                'title' => __('Customized Approach', 'dark-theme-simplicity'),
                'description' => __('Solutions are tailored to your specific industry, audience, and business objectives.', 'dark-theme-simplicity')
            ),
            array(
                'title' => __('Transparent Process', 'dark-theme-simplicity'),
                'description' => __('Clear communication and regular reporting keep you informed every step of the way.', 'dark-theme-simplicity')
            ),
            array(
                'title' => __('Continuous Optimization', 'dark-theme-simplicity'),
                'description' => __('We consistently refine strategies based on performance data to maximize ROI.', 'dark-theme-simplicity')
            )
        );

        $wp_customize->add_setting( 'dark_theme_simplicity_benefit_items', array(
            'default'           => json_encode($default_benefits),
            'sanitize_callback' => 'dark_theme_simplicity_sanitize_repeater',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( new Dark_Theme_Simplicity_Customizer_Repeater_Control( $wp_customize, 'dark_theme_simplicity_benefit_items', array(
            'label'       => __( 'Benefit Items', 'dark-theme-simplicity' ),
            'section'     => 'dark_theme_simplicity_benefits_section',
            'fields'      => array(
                array(
                    'id'    => 'title',
                    'type'  => 'text',
                    'label' => __( 'Title', 'dark-theme-simplicity' ),
                ),
                array(
                    'id'    => 'description',
                    'type'  => 'textarea',
                    'label' => __( 'Description', 'dark-theme-simplicity' ),
                ),
            ),
        ) ) );

        // Approach Section
        $wp_customize->add_section( 'dark_theme_simplicity_approach_section', array(
            'title'       => __( 'Approach Section', 'dark-theme-simplicity' ),
            'description' => __( 'Customize the approach section on the front page', 'dark-theme-simplicity' ),
            'panel'       => 'dark_theme_simplicity_frontpage_panel',
            'priority'    => 40,
        ) );

        // Approach Section Title
        $wp_customize->add_setting( 'dark_theme_simplicity_approach_title', array(
            'default'           => __( 'How I work with clients', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_approach_title', array(
            'label'    => __( 'Section Title', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_approach_section',
            'settings' => 'dark_theme_simplicity_approach_title',
            'type'     => 'text',
        ) );

        // Approach Section Description
        $wp_customize->add_setting( 'dark_theme_simplicity_approach_description', array(
            'default'           => __( 'I believe in a collaborative approach to content strategy. Your business is unique, and your content strategy should be too.', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_approach_description', array(
            'label'    => __( 'Section Description', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_approach_section',
            'settings' => 'dark_theme_simplicity_approach_description',
            'type'     => 'textarea',
        ) );

        // Approach Items Repeater
        $default_approach_items = array(
            array(
                'title' => __('1. Discovery', 'dark-theme-simplicity'),
                'description' => __('I start by understanding your business, audience, and goals to create a tailored strategy.', 'dark-theme-simplicity')
            ),
            array(
                'title' => __('2. Strategy Development', 'dark-theme-simplicity'),
                'description' => __('Based on research and your goals, I develop a content strategy aligned with your business objectives.', 'dark-theme-simplicity')
            ),
            array(
                'title' => __('3. Implementation', 'dark-theme-simplicity'),
                'description' => __('I create content that engages your audience and drives the results you\'re looking for.', 'dark-theme-simplicity')
            ),
            array(
                'title' => __('4. Analysis & Optimization', 'dark-theme-simplicity'),
                'description' => __('I continuously monitor performance and optimize your content strategy for better results.', 'dark-theme-simplicity')
            )
        );

        $wp_customize->add_setting( 'dark_theme_simplicity_approach_items', array(
            'default'           => json_encode($default_approach_items),
            'sanitize_callback' => 'dark_theme_simplicity_sanitize_repeater',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( new Dark_Theme_Simplicity_Customizer_Repeater_Control( $wp_customize, 'dark_theme_simplicity_approach_items', array(
            'label'       => __( 'Approach Items', 'dark-theme-simplicity' ),
            'section'     => 'dark_theme_simplicity_approach_section',
            'fields'      => array(
                array(
                    'id'    => 'title',
                    'type'  => 'text',
                    'label' => __( 'Title', 'dark-theme-simplicity' ),
                ),
                array(
                    'id'    => 'description',
                    'type'  => 'textarea',
                    'label' => __( 'Description', 'dark-theme-simplicity' ),
                ),
            ),
        ) ) );

        // About Section
        $wp_customize->add_section( 'dark_theme_simplicity_about_section', array(
            'title'       => __( 'About Section', 'dark-theme-simplicity' ),
            'description' => __( 'Customize the about section on the front page', 'dark-theme-simplicity' ),
            'panel'       => 'dark_theme_simplicity_frontpage_panel',
            'priority'    => 50,
        ) );

        // About Section Title
        $wp_customize->add_setting( 'dark_theme_simplicity_about_title', array(
            'default'           => __( 'Digital Marketing Specialist', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_about_title', array(
            'label'    => __( 'Section Title', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_about_section',
            'settings' => 'dark_theme_simplicity_about_title',
            'type'     => 'text',
        ) );

        // About Section Subtitle
        $wp_customize->add_setting( 'dark_theme_simplicity_about_subtitle', array(
            'default'           => __( 'With over a decade of experience helping businesses thrive online.', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_about_subtitle', array(
            'label'    => __( 'Section Subtitle', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_about_section',
            'settings' => 'dark_theme_simplicity_about_subtitle',
            'type'     => 'text',
        ) );

        // About Image
        $wp_customize->add_setting( 'dark_theme_simplicity_about_image', array(
            'default'           => get_template_directory_uri() . '/assets/images/about-image.jpg',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'dark_theme_simplicity_about_image', array(
            'label'    => __( 'About Image', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_about_section',
            'settings' => 'dark_theme_simplicity_about_image',
        ) ) );

        // About Content First Paragraph
        $wp_customize->add_setting( 'dark_theme_simplicity_about_content_1', array(
            'default'           => __( 'I\'m Brad Daiber, a seasoned digital marketing consultant with a passion for helping businesses establish a powerful online presence. With a background in SEO, content creation, and web design, I provide comprehensive solutions tailored to your specific needs.', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_about_content_1', array(
            'label'    => __( 'First Paragraph', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_about_section',
            'settings' => 'dark_theme_simplicity_about_content_1',
            'type'     => 'textarea',
        ) );

        // About Content Second Paragraph
        $wp_customize->add_setting( 'dark_theme_simplicity_about_content_2', array(
            'default'           => __( 'My approach combines data-driven strategies with creative thinking to deliver measurable results. Whether you\'re looking to increase website traffic, improve conversion rates, or establish your brand voice, I\'m here to help you achieve your goals.', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_about_content_2', array(
            'label'    => __( 'Second Paragraph', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_about_section',
            'settings' => 'dark_theme_simplicity_about_content_2',
            'type'     => 'textarea',
        ) );

        // Contact Section
        $wp_customize->add_section( 'dark_theme_simplicity_contact_section', array(
            'title'       => __( 'Contact Section', 'dark-theme-simplicity' ),
            'description' => __( 'Customize the contact section on the front page', 'dark-theme-simplicity' ),
            'panel'       => 'dark_theme_simplicity_frontpage_panel',
            'priority'    => 60,
        ) );

        // Contact Section Title
        $wp_customize->add_setting( 'dark_theme_simplicity_contact_title', array(
            'default'           => __( 'Contact Me', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_contact_title', array(
            'label'    => __( 'Section Title', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_contact_section',
            'settings' => 'dark_theme_simplicity_contact_title',
            'type'     => 'text',
        ) );

        // Contact Section Description
        $wp_customize->add_setting( 'dark_theme_simplicity_contact_description', array(
            'default'           => __( 'Let\'s discuss how we can elevate your online presence.', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_contact_description', array(
            'label'    => __( 'Section Description', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_contact_section',
            'settings' => 'dark_theme_simplicity_contact_description',
            'type'     => 'textarea',
        ) );

        // Email
        $wp_customize->add_setting( 'dark_theme_simplicity_contact_email', array(
            'default'           => 'hello@braddaiber.com',
            'sanitize_callback' => 'sanitize_email',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_contact_email', array(
            'label'    => __( 'Email Address', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_contact_section',
            'settings' => 'dark_theme_simplicity_contact_email',
            'type'     => 'text',
        ) );

        // LinkedIn
        $wp_customize->add_setting( 'dark_theme_simplicity_contact_linkedin', array(
            'default'           => 'linkedin.com/in/braddaiber',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_contact_linkedin', array(
            'label'    => __( 'LinkedIn Profile', 'dark-theme-simplicity' ),
            'description' => __( 'Enter your LinkedIn URL (e.g., linkedin.com/in/username)', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_contact_section',
            'settings' => 'dark_theme_simplicity_contact_linkedin',
            'type'     => 'text',
        ) );

        // Contact Accent Color
        $wp_customize->add_setting( 'dark_theme_simplicity_contact_accent_color', array(
            'default'           => '#0085ff', // Blue-300
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dark_theme_simplicity_contact_accent_color', array(
            'label'    => __( 'Contact Accent Color', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_contact_section',
            'settings' => 'dark_theme_simplicity_contact_accent_color',
        ) ) );

        // Privacy Policy URL
        $wp_customize->add_setting( 'dark_theme_simplicity_privacy_url', array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_privacy_url', array(
            'label'    => __( 'Privacy Policy URL', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_footer_options',
            'settings' => 'dark_theme_simplicity_privacy_url',
            'type'     => 'url',
        ) );

        // Privacy Policy Text
        $wp_customize->add_setting( 'dark_theme_simplicity_privacy_text', array(
            'default'           => __( 'Privacy Policy', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_privacy_text', array(
            'label'    => __( 'Privacy Policy Text', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_footer_options',
            'settings' => 'dark_theme_simplicity_privacy_text',
            'type'     => 'text',
        ) );

        // Terms of Service URL
        $wp_customize->add_setting( 'dark_theme_simplicity_terms_url', array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_terms_url', array(
            'label'    => __( 'Terms of Service URL', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_footer_options',
            'settings' => 'dark_theme_simplicity_terms_url',
            'type'     => 'url',
        ) );

        // Terms of Service Text
        $wp_customize->add_setting( 'dark_theme_simplicity_terms_text', array(
            'default'           => __( 'Terms of Service', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_terms_text', array(
            'label'    => __( 'Terms of Service Text', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_footer_options',
            'settings' => 'dark_theme_simplicity_terms_text',
            'type'     => 'text',
        ) );

        // Cookie Policy URL
        $wp_customize->add_setting( 'dark_theme_simplicity_cookie_url', array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_cookie_url', array(
            'label'    => __( 'Cookie Policy URL', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_footer_options',
            'settings' => 'dark_theme_simplicity_cookie_url',
            'type'     => 'url',
        ) );

        // Cookie Policy Text
        $wp_customize->add_setting( 'dark_theme_simplicity_cookie_text', array(
            'default'           => __( 'Cookie Policy', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_cookie_text', array(
            'label'    => __( 'Cookie Policy Text', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_footer_options',
            'settings' => 'dark_theme_simplicity_cookie_text',
            'type'     => 'text',
        ) );

        // LinkedIn URL
        $wp_customize->add_setting( 'dark_theme_simplicity_linkedin_url', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );
        
        $wp_customize->add_control( 'dark_theme_simplicity_linkedin_url', array(
            'label'    => __( 'LinkedIn URL', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_social_links',
            'settings' => 'dark_theme_simplicity_linkedin_url',
            'type'     => 'url',
        ) );
        
        // Twitter/X URL
        $wp_customize->add_setting( 'dark_theme_simplicity_twitter_url', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );
        
        $wp_customize->add_control( 'dark_theme_simplicity_twitter_url', array(
            'label'    => __( 'Twitter/X URL', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_social_links',
            'settings' => 'dark_theme_simplicity_twitter_url',
            'type'     => 'url',
        ) );

        // Blog Index Hero Section
        $wp_customize->add_section( 'dark_theme_simplicity_blog_hero_section', array(
            'title'       => __( 'Blog Index Hero', 'dark-theme-simplicity' ),
            'description' => __( 'Customize the hero section on the blog index page', 'dark-theme-simplicity' ),
            'priority'    => 100,
        ) );

        // Blog Hero Title
        $wp_customize->add_setting( 'dark_theme_simplicity_blog_hero_title', array(
            'default'           => __( 'Insights & Resources', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_blog_hero_title', array(
            'label'    => __( 'Blog Hero Title', 'dark-theme-simplicity' ),
            'description' => __( 'The main title displayed in the blog index hero section', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_blog_hero_section',
            'settings' => 'dark_theme_simplicity_blog_hero_title',
            'type'     => 'text',
        ) );

        // Blog Hero Description
        $wp_customize->add_setting( 'dark_theme_simplicity_blog_hero_description', array(
            'default'           => __( 'The latest tools, trends, and strategies to elevate your digital presence and maximize your business growth.', 'dark-theme-simplicity' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_blog_hero_description', array(
            'label'    => __( 'Blog Hero Description', 'dark-theme-simplicity' ),
            'description' => __( 'The description text displayed below the title in the blog index hero section', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_blog_hero_section',
            'settings' => 'dark_theme_simplicity_blog_hero_description',
            'type'     => 'textarea',
        ) );

        // Blog Hero Background Image
        $wp_customize->add_setting( 'dark_theme_simplicity_blog_hero_bg_image', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'dark_theme_simplicity_blog_hero_bg_image', array(
            'label'    => __( 'Blog Hero Background Image', 'dark-theme-simplicity' ),
            'description' => __( 'Upload or select an image for the blog index hero section background', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_blog_hero_section',
            'settings' => 'dark_theme_simplicity_blog_hero_bg_image',
        ) ) );

        // Blog Hero Background Overlay Opacity
        $wp_customize->add_setting( 'dark_theme_simplicity_blog_hero_overlay_opacity', array(
            'default'           => '70',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_blog_hero_overlay_opacity', array(
            'label'       => __( 'Background Overlay Opacity (%)', 'dark-theme-simplicity' ),
            'description' => __( 'Adjust the opacity of the dark overlay on the background image (0-100)', 'dark-theme-simplicity' ),
            'section'     => 'dark_theme_simplicity_blog_hero_section',
            'settings'    => 'dark_theme_simplicity_blog_hero_overlay_opacity',
            'type'        => 'range',
            'input_attrs' => array(
                'min'  => 0,
                'max'  => 100,
                'step' => 5,
            ),
        ) );

        // Blog Hero Title Color
        $wp_customize->add_setting( 'dark_theme_simplicity_blog_hero_title_color', array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dark_theme_simplicity_blog_hero_title_color', array(
            'label'    => __( 'Blog Hero Title Color', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_blog_hero_section',
            'settings' => 'dark_theme_simplicity_blog_hero_title_color',
        ) ) );

        // Blog Hero Description Color
        $wp_customize->add_setting( 'dark_theme_simplicity_blog_hero_desc_color', array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dark_theme_simplicity_blog_hero_desc_color', array(
            'label'    => __( 'Blog Hero Description Color', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_blog_hero_section',
            'settings' => 'dark_theme_simplicity_blog_hero_desc_color',
        ) ) );

        // Blog Hero Description Opacity
        $wp_customize->add_setting( 'dark_theme_simplicity_blog_hero_desc_opacity', array(
            'default'           => '70',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_blog_hero_desc_opacity', array(
            'label'       => __( 'Description Text Opacity (%)', 'dark-theme-simplicity' ),
            'description' => __( 'Adjust the opacity of the description text (0-100)', 'dark-theme-simplicity' ),
            'section'     => 'dark_theme_simplicity_blog_hero_section',
            'settings'    => 'dark_theme_simplicity_blog_hero_desc_opacity',
            'type'        => 'range',
            'input_attrs' => array(
                'min'  => 0,
                'max'  => 100,
                'step' => 5,
            ),
        ) );

        // Blog Hero Padding
        $wp_customize->add_setting( 'dark_theme_simplicity_blog_hero_padding', array(
            'default'           => 'medium',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_blog_hero_padding', array(
            'label'    => __( 'Blog Hero Padding', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_blog_hero_section',
            'settings' => 'dark_theme_simplicity_blog_hero_padding',
            'type'     => 'select',
            'choices'  => array(
                'small'  => __( 'Small', 'dark-theme-simplicity' ),
                'medium' => __( 'Medium (Default)', 'dark-theme-simplicity' ),
                'large'  => __( 'Large', 'dark-theme-simplicity' ),
                'extra-large' => __( 'Extra Large', 'dark-theme-simplicity' ),
            ),
        ) );

        // Blog Hero Text Alignment
        $wp_customize->add_setting( 'dark_theme_simplicity_blog_hero_alignment', array(
            'default'           => 'left',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( 'dark_theme_simplicity_blog_hero_alignment', array(
            'label'    => __( 'Blog Hero Text Alignment', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_blog_hero_section',
            'settings' => 'dark_theme_simplicity_blog_hero_alignment',
            'type'     => 'radio',
            'choices'  => array(
                'left'   => __( 'Left', 'dark-theme-simplicity' ),
                'center' => __( 'Center', 'dark-theme-simplicity' ),
                'right'  => __( 'Right', 'dark-theme-simplicity' ),
            ),
        ) );

        // Add a panel for homepage structure
        $wp_customize->add_panel( 'dark_theme_simplicity_homepage_structure', array(
            'title'       => __( 'Homepage Structure', 'dark-theme-simplicity' ),
            'description' => __( 'Control which sections appear on the homepage and their visibility', 'dark-theme-simplicity' ),
            'priority'    => 35,
        ) );
        
        // Add a section for default section visibility
        $wp_customize->add_section( 'dark_theme_simplicity_default_sections', array(
            'title'       => __( 'Default Sections Visibility', 'dark-theme-simplicity' ),
            'description' => __( 'Show or hide the default sections on the homepage', 'dark-theme-simplicity' ),
            'panel'       => 'dark_theme_simplicity_homepage_structure',
            'priority'    => 10,
        ) );
        
        // Show Default Hero Section
        $wp_customize->add_setting( 'dark_theme_simplicity_show_default_hero', array(
            'default'           => true,
            'sanitize_callback' => 'dark_theme_simplicity_sanitize_checkbox',
            'transport'         => 'refresh',
        ) );
        
        $wp_customize->add_control( 'dark_theme_simplicity_show_default_hero', array(
            'label'    => __( 'Show Default Hero Section', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_default_sections',
            'settings' => 'dark_theme_simplicity_show_default_hero',
            'type'     => 'checkbox',
        ) );
        
        // Show Default Services Section
        $wp_customize->add_setting( 'dark_theme_simplicity_show_default_services', array(
            'default'           => true,
            'sanitize_callback' => 'dark_theme_simplicity_sanitize_checkbox',
            'transport'         => 'refresh',
        ) );
        
        $wp_customize->add_control( 'dark_theme_simplicity_show_default_services', array(
            'label'    => __( 'Show Default Services Section', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_default_sections',
            'settings' => 'dark_theme_simplicity_show_default_services',
            'type'     => 'checkbox',
        ) );
        
        // Show Default Benefits Section
        $wp_customize->add_setting( 'dark_theme_simplicity_show_default_benefits', array(
            'default'           => true,
            'sanitize_callback' => 'dark_theme_simplicity_sanitize_checkbox',
            'transport'         => 'refresh',
        ) );
        
        $wp_customize->add_control( 'dark_theme_simplicity_show_default_benefits', array(
            'label'    => __( 'Show Default Benefits Section', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_default_sections',
            'settings' => 'dark_theme_simplicity_show_default_benefits',
            'type'     => 'checkbox',
        ) );
        
        // Show Default Approach Section
        $wp_customize->add_setting( 'dark_theme_simplicity_show_default_approach', array(
            'default'           => true,
            'sanitize_callback' => 'dark_theme_simplicity_sanitize_checkbox',
            'transport'         => 'refresh',
        ) );
        
        $wp_customize->add_control( 'dark_theme_simplicity_show_default_approach', array(
            'label'    => __( 'Show Default Approach Section', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_default_sections',
            'settings' => 'dark_theme_simplicity_show_default_approach',
            'type'     => 'checkbox',
        ) );
        
        // Show Default About Section
        $wp_customize->add_setting( 'dark_theme_simplicity_show_default_about', array(
            'default'           => true,
            'sanitize_callback' => 'dark_theme_simplicity_sanitize_checkbox',
            'transport'         => 'refresh',
        ) );
        
        $wp_customize->add_control( 'dark_theme_simplicity_show_default_about', array(
            'label'    => __( 'Show Default About Section', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_default_sections',
            'settings' => 'dark_theme_simplicity_show_default_about',
            'type'     => 'checkbox',
        ) );
        
        // Show Default Contact Section
        $wp_customize->add_setting( 'dark_theme_simplicity_show_default_contact', array(
            'default'           => true,
            'sanitize_callback' => 'dark_theme_simplicity_sanitize_checkbox',
            'transport'         => 'refresh',
        ) );
        
        $wp_customize->add_control( 'dark_theme_simplicity_show_default_contact', array(
            'label'    => __( 'Show Default Contact Section', 'dark-theme-simplicity' ),
            'section'  => 'dark_theme_simplicity_default_sections',
            'settings' => 'dark_theme_simplicity_show_default_contact',
            'type'     => 'checkbox',
        ) );
    }
}
add_action( 'customize_register', 'dark_theme_simplicity_customize_register' );

/**
 * Generate custom CSS for customizer settings
 */
if (!function_exists('dark_theme_simplicity_customizer_css')) {
    function dark_theme_simplicity_customizer_css() {
        // Get customizer values for quicker access
        $service_bg_color = get_theme_mod('dark_theme_simplicity_service_card_bg_color', '#1e1e24');
        $service_accent_color = get_theme_mod('dark_theme_simplicity_service_card_accent_color', '#0085ff');
        $contact_accent_color = get_theme_mod('dark_theme_simplicity_contact_accent_color', '#0085ff');
        $logo_color = get_theme_mod('dark_theme_simplicity_logo_color', '#60a5fa');
        ?>
        <style type="text/css">
            /* Logo Color */
            .site-header .text-blue-400 path,
            .site-footer .text-blue-400 path {
                stroke: <?php echo esc_attr($logo_color); ?> !important;
            }
        
            /* Hero Section */
            .hero-section {
                background-image: url('<?php echo esc_url( get_theme_mod( 'dark_theme_simplicity_hero_bg_image', 'https://braddaiber.com/wp-content/uploads/2024/03/shutterstock_134653565-1-scaled.webp' ) ); ?>');
            }
            
            .hero-btn {
                background-color: <?php echo esc_attr( get_theme_mod( 'dark_theme_simplicity_hero_button_color', '#0085ff' ) ); ?> !important;
                border-radius: <?php echo esc_attr( get_theme_mod( 'dark_theme_simplicity_hero_button_radius', '0' ) ); ?>px !important;
                padding-left: <?php echo esc_attr( get_theme_mod( 'dark_theme_simplicity_hero_button_padding_x', '32' ) ); ?>px !important;
                padding-right: <?php echo esc_attr( get_theme_mod( 'dark_theme_simplicity_hero_button_padding_x', '32' ) ); ?>px !important;
                padding-top: <?php echo esc_attr( get_theme_mod( 'dark_theme_simplicity_hero_button_padding_y', '16' ) ); ?>px !important;
                padding-bottom: <?php echo esc_attr( get_theme_mod( 'dark_theme_simplicity_hero_button_padding_y', '16' ) ); ?>px !important;
                font-size: <?php echo esc_attr( get_theme_mod( 'dark_theme_simplicity_hero_button_text_size', '18' ) ); ?>px !important;
                font-weight: <?php echo esc_attr( get_theme_mod( 'dark_theme_simplicity_hero_button_font_weight', '500' ) ); ?> !important;
                border-width: <?php echo esc_attr( get_theme_mod( 'dark_theme_simplicity_hero_button_border_width', '0' ) ); ?>px !important;
                border-style: solid !important;
                border-color: <?php echo esc_attr( get_theme_mod( 'dark_theme_simplicity_hero_button_border_color', '#ffffff' ) ); ?> !important;
                display: inline-flex !important;
                color: white !important;
            }
            
            .hero-btn:hover {
                background-color: <?php echo esc_attr( get_theme_mod( 'dark_theme_simplicity_hero_button_hover_color', '#0057a7' ) ); ?> !important;
            }
            
            /* Global section labels - keep these the default blue color */
            .section-label {
                color: #0085ff !important;
            }
            
            /* Services Section */
            /* Service Card Background */
            #what-we-do .bg-\[#1e1e24\] {
                background-color: <?php echo esc_attr($service_bg_color); ?> !important;
            }
            
            /* Service Icons */
            #what-we-do .text-blue-300 {
                color: <?php echo esc_attr($service_accent_color); ?> !important;
            }
            
            /* Service Card Border on Hover */
            #what-we-do .hover\:border-blue-500:hover {
                border-color: <?php echo esc_attr($service_accent_color); ?> !important;
            }
            
            /* Contact Section */
            /* Contact Icons */
            .contact-section .contact-icon {
                color: <?php echo esc_attr($contact_accent_color); ?> !important;
            }
            
            /* Contact Icon Backgrounds */
            .contact-section .bg-blue-300\/20 {
                background-color: <?php echo esc_attr($contact_accent_color); ?>20 !important;
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Apply service card background color via JavaScript for maximum specificity
                const serviceCards = document.querySelectorAll('#what-we-do .bg-\\[\\#1e1e24\\]');
                serviceCards.forEach(card => {
                    card.style.backgroundColor = '<?php echo esc_attr($service_bg_color); ?>';
                });
                
                // Apply service icon color via JavaScript
                const serviceIcons = document.querySelectorAll('#what-we-do .text-blue-300');
                serviceIcons.forEach(icon => {
                    icon.style.color = '<?php echo esc_attr($service_accent_color); ?>';
                });
                
                // Apply hero button colors via JavaScript to handle caching issues
                const heroButtons = document.querySelectorAll('.hero-btn');
                heroButtons.forEach(button => {
                    button.style.backgroundColor = '<?php echo esc_attr(get_theme_mod('dark_theme_simplicity_hero_button_color', '#0085ff')); ?>';
                    button.style.borderRadius = '<?php echo esc_attr(get_theme_mod('dark_theme_simplicity_hero_button_radius', '0')); ?>px';
                    button.style.borderWidth = '<?php echo esc_attr(get_theme_mod('dark_theme_simplicity_hero_button_border_width', '0')); ?>px';
                    button.style.borderColor = '<?php echo esc_attr(get_theme_mod('dark_theme_simplicity_hero_button_border_color', '#ffffff')); ?>';
                    button.style.borderStyle = 'solid';
                    button.style.color = 'white';
                    
                    // Set up hover event
                    button.addEventListener('mouseenter', function() {
                        this.style.backgroundColor = '<?php echo esc_attr(get_theme_mod('dark_theme_simplicity_hero_button_hover_color', '#0057a7')); ?>';
                    });
                    
                    // Set up mouse leave event to revert to original color
                    button.addEventListener('mouseleave', function() {
                        this.style.backgroundColor = '<?php echo esc_attr(get_theme_mod('dark_theme_simplicity_hero_button_color', '#0085ff')); ?>';
                    });
                });
            });
        </script>
        <?php
    }
}
add_action( 'wp_head', 'dark_theme_simplicity_customizer_css' );

/**
 * Sanitize repeater values
 */
if (!function_exists('dark_theme_simplicity_sanitize_repeater')) {
    function dark_theme_simplicity_sanitize_repeater( $input ) {
        $input_decoded = json_decode( $input, true );
        
        if ( !empty( $input_decoded ) && is_array( $input_decoded ) ) {
            foreach ( $input_decoded as $key => $value ) {
                // Loop through all possible fields
                if ( isset( $value['icon'] ) ) {
                    $input_decoded[ $key ]['icon'] = sanitize_text_field( $value['icon'] );
                }
                if ( isset( $value['title'] ) ) {
                    $input_decoded[ $key ]['title'] = sanitize_text_field( $value['title'] );
                }
                if ( isset( $value['description'] ) ) {
                    $input_decoded[ $key ]['description'] = sanitize_textarea_field( $value['description'] );
                }
                // Add more fields as needed
            }
            return json_encode( $input_decoded );
        }
        
        return $input;
    }
}

/**
 * Sanitize font weight
 */
if (!function_exists('dark_theme_simplicity_sanitize_font_weight')) {
    function dark_theme_simplicity_sanitize_font_weight( $input ) {
        $valid = array( '300', '400', '500', '600', '700' );
        
        if ( in_array( $input, $valid ) ) {
            return $input;
        }
        
        return '500'; // Default
    }
}

/**
 * Sanitize RGBA color value
 */
if (!function_exists('dark_theme_simplicity_sanitize_rgba')) {
    function dark_theme_simplicity_sanitize_rgba( $color ) {
        if ( empty( $color ) || is_array( $color ) ) {
            return 'rgba(255, 255, 255, 0.7)';
        }
        
        // Check if it's an rgba color
        if ( strpos( $color, 'rgba' ) !== false ) {
            // Get the rgba values
            preg_match( '/^rgba\(\s*(\d+),\s*(\d+),\s*(\d+),\s*([\d\.]+)\s*\)$/', $color, $matches );
            if ( count( $matches ) === 5 ) {
                $red = intval( $matches[1] );
                $green = intval( $matches[2] );
                $blue = intval( $matches[3] );
                $alpha = floatval( $matches[4] );
                
                // Make sure RGB values are between 0-255
                $red = max( 0, min( 255, $red ) );
                $green = max( 0, min( 255, $green ) );
                $blue = max( 0, min( 255, $blue ) );
                
                // Make sure alpha is between 0-1
                $alpha = max( 0, min( 1, $alpha ) );
                
                return sprintf( 'rgba(%d, %d, %d, %.2f)', $red, $green, $blue, $alpha );
            }
        }
        
        // If it's a hex color, just return it
        if ( preg_match( '/^#[a-f0-9]{6}$/i', $color ) ) {
            return $color;
        }
        
        // Default to semi-transparent white
        return 'rgba(255, 255, 255, 0.7)';
    }
}

/**
 * Sanitize checkbox values
 */
if (!function_exists('dark_theme_simplicity_sanitize_checkbox')) {
    function dark_theme_simplicity_sanitize_checkbox( $input ) {
        return ( isset( $input ) && true == $input ) ? true : false;
    }
} 