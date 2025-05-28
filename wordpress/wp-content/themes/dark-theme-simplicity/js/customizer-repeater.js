/**
 * Customizer Repeater JS
 * Adds the functionality for the customizer repeater control
 */
(function($) {
    'use strict';

    $(document).ready(function() {
        // Toggle item content
        $(document).on('click', '.customizer-repeater-toggle-item', function() {
            $(this).closest('.customizer-repeater-general-control-repeater-item').toggleClass('expanded');
        });

        // Add new item
        $(document).on('click', '.customizer-repeater-add-control-field', function() {
            var $this = $(this);
            var $control = $this.closest('.customizer-repeater-control-wrap');
            var $repeaterItems = $control.find('.customizer-repeater-general-control-repeater-item');
            var $firstItem = $repeaterItems.first().clone();
            
            // Reset values in the cloned item
            $firstItem.find('.customizer-repeater-field-input').each(function() {
                $(this).val('');
            });
            
            // Reset title
            $firstItem.find('.customizer-repeater-item-title').text('Service Item');
            
            // Make sure it's expanded
            $firstItem.addClass('expanded');
            
            // Insert before the Add New button
            $this.before($firstItem);
            
            // Update the value and trigger change
            updateRepeaterValue($control);
        });
        
        // Remove item
        $(document).on('click', '.customizer-repeater-remove-item', function() {
            var $this = $(this);
            var $control = $this.closest('.customizer-repeater-control-wrap');
            var $repeaterItems = $control.find('.customizer-repeater-general-control-repeater-item');
            
            // Don't remove if it's the only item
            if ($repeaterItems.length > 1) {
                $this.closest('.customizer-repeater-general-control-repeater-item').remove();
                updateRepeaterValue($control);
            }
        });
        
        // Update when field values change
        $(document).on('change keyup', '.customizer-repeater-field-input', function() {
            var $control = $(this).closest('.customizer-repeater-control-wrap');
            
            // If it's a title field, update the header title too
            if ($(this).data('field') === 'title') {
                var newTitle = $(this).val();
                if (newTitle) {
                    $(this).closest('.customizer-repeater-general-control-repeater-item')
                           .find('.customizer-repeater-item-title')
                           .text(newTitle);
                }
            }
            
            updateRepeaterValue($control);
        });
        
        // Make items sortable
        $('.customizer-repeater-general-control-repeater').sortable({
            items: '.customizer-repeater-general-control-repeater-item',
            handle: '.customizer-repeater-item-header',
            update: function(event, ui) {
                updateRepeaterValue($(this).closest('.customizer-repeater-control-wrap'));
            }
        });
        
        // Helper function to update the input value
        function updateRepeaterValue($control) {
            var repeaterValue = [];
            
            $control.find('.customizer-repeater-general-control-repeater-item').each(function() {
                var itemValue = {};
                
                $(this).find('.customizer-repeater-field-input').each(function() {
                    var $field = $(this);
                    var fieldId = $field.data('field');
                    var fieldValue = $field.val();
                    
                    if (fieldId) {
                        itemValue[fieldId] = fieldValue;
                    }
                });
                
                repeaterValue.push(itemValue);
            });
            
            $control.find('.customizer-repeater-collector').val(JSON.stringify(repeaterValue)).trigger('change');
        }
    });
})(jQuery); 