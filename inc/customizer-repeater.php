<?php
/**
 * Customizer Repeater Class
 * A custom control for the WordPress Customizer that allows users to add multiple fields with the same set of inputs.
 *
 * @package Dark_Theme_Simplicity
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return null;
}

/**
 * Repeater Custom Control
 */
class Dark_Theme_Simplicity_Customizer_Repeater_Control extends WP_Customize_Control {
    /**
     * Control type
     *
     * @var string
     */
    public $type = 'repeater';

    /**
     * Fields to repeat
     *
     * @var array
     */
    public $fields = array();

    /**
     * Constructor
     */
    public function __construct( $manager, $id, $args = array() ) {
        parent::__construct( $manager, $id, $args );
        if ( isset( $args['fields'] ) && is_array( $args['fields'] ) ) {
            $this->fields = $args['fields'];
        }
        add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }

    /**
     * Enqueue control related scripts/styles
     */
    public function enqueue_scripts() {
        wp_enqueue_script( 'customizer-repeater-script', get_template_directory_uri() . '/js/customizer-repeater.js', array( 'jquery', 'customize-controls' ), '1.0.0', true );
        wp_enqueue_style( 'customizer-repeater-style', get_template_directory_uri() . '/css/customizer-repeater.css', array(), '1.0.0' );
    }

    /**
     * Refresh the parameters passed to the JavaScript via JSON.
     */
    public function to_json() {
        parent::to_json();
        $this->json['fields'] = $this->fields;
        $this->json['value'] = json_decode( $this->value(), true );
        if ( empty( $this->json['value'] ) && is_array( $this->json['value'] ) ) {
            $this->json['value'] = array( array() );
        }
    }

    /**
     * Don't render content via PHP, as it's rendered via JS
     */
    public function render_content() {
        ?>
        <label>
            <?php if ( ! empty( $this->label ) ) : ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php endif; ?>
            <?php if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php endif; ?>
        </label>

        <div class="customizer-repeater-control-wrap">
            <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" class="customizer-repeater-collector" />
            <div class="customizer-repeater-general-control-repeater">
                <?php 
                $values = json_decode( $this->value(), true );
                if ( is_array( $values ) ) {
                    foreach ( $values as $value ) {
                        $this->render_repeater_item( $value );
                    }
                } else {
                    $this->render_repeater_item();
                }
                ?>
                <button type="button" class="button customizer-repeater-add-control-field"><?php esc_html_e( 'Add New Item', 'dark-theme-simplicity' ); ?></button>
            </div>
        </div>
        <?php
    }

    /**
     * Render a single repeater item
     */
    private function render_repeater_item( $value = array() ) {
        ?>
        <div class="customizer-repeater-general-control-repeater-item">
            <div class="customizer-repeater-item-header">
                <span class="customizer-repeater-item-title">
                    <?php 
                    if ( isset( $value['title'] ) && ! empty( $value['title'] ) ) {
                        echo esc_html( $value['title'] );
                    } else {
                        esc_html_e( 'Service Item', 'dark-theme-simplicity' );
                    }
                    ?>
                </span>
                <span class="customizer-repeater-item-controls">
                    <button type="button" class="customizer-repeater-toggle-item"><?php esc_html_e( 'Toggle', 'dark-theme-simplicity' ); ?></button>
                    <button type="button" class="customizer-repeater-remove-item"><?php esc_html_e( 'Remove', 'dark-theme-simplicity' ); ?></button>
                </span>
            </div>
            <div class="customizer-repeater-item-content">
                <?php foreach ( $this->fields as $field ) : ?>
                    <?php $field_value = isset( $value[ $field['id'] ] ) ? $value[ $field['id'] ] : ''; ?>
                    <?php if ( $field['type'] === 'text' ) : ?>
                        <div class="customizer-repeater-field">
                            <label for="<?php echo esc_attr( $field['id'] ); ?>">
                                <?php echo esc_html( $field['label'] ); ?>
                            </label>
                            <input type="text" id="<?php echo esc_attr( $field['id'] ); ?>" 
                                   class="customizer-repeater-field-input" 
                                   data-field="<?php echo esc_attr( $field['id'] ); ?>" 
                                   value="<?php echo esc_attr( $field_value ); ?>" />
                        </div>
                    <?php elseif ( $field['type'] === 'textarea' ) : ?>
                        <div class="customizer-repeater-field">
                            <label for="<?php echo esc_attr( $field['id'] ); ?>">
                                <?php echo esc_html( $field['label'] ); ?>
                            </label>
                            <textarea id="<?php echo esc_attr( $field['id'] ); ?>" 
                                      class="customizer-repeater-field-input" 
                                      data-field="<?php echo esc_attr( $field['id'] ); ?>"><?php echo esc_textarea( $field_value ); ?></textarea>
                        </div>
                    <?php elseif ( $field['type'] === 'select' && isset( $field['choices'] ) ) : ?>
                        <div class="customizer-repeater-field">
                            <label for="<?php echo esc_attr( $field['id'] ); ?>">
                                <?php echo esc_html( $field['label'] ); ?>
                            </label>
                            <select id="<?php echo esc_attr( $field['id'] ); ?>" 
                                    class="customizer-repeater-field-input" 
                                    data-field="<?php echo esc_attr( $field['id'] ); ?>">
                                <?php foreach ( $field['choices'] as $choice_value => $choice_label ) : ?>
                                    <option value="<?php echo esc_attr( $choice_value ); ?>" 
                                            <?php selected( $field_value, $choice_value ); ?>>
                                        <?php echo esc_html( $choice_label ); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
} 