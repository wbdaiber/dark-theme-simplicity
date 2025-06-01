/**
 * Customizer Repeater JS
 * Adds the functionality for the customizer repeater control
 */
(function($) {
    'use strict';

    // Only run the initialization once when the document is ready
    $(document).ready(function() {
        // Remove any previously attached event handlers to prevent duplicates
        $(document).off('click', '.customizer-repeater-toggle-item');
        $(document).off('click', '.customizer-repeater-add-control-field');
        $(document).off('click', '.customizer-repeater-remove-item');
        
        // Safety function for JSON operations
        function safeJSONStringify(obj) {
            try {
                return JSON.stringify(obj);
            } catch (e) {
                console.error('JSON stringify error:', e);
                return '[]';
            }
        }
        
        // Initialize: Ensure expanded items show content
        $('.customizer-repeater-general-control-repeater-item.expanded .customizer-repeater-item-content').show();
        
        // Toggle item content
        $(document).on('click', '.customizer-repeater-toggle-item', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            var $item = $(this).closest('.customizer-repeater-general-control-repeater-item');
            $item.toggleClass('expanded');
            $item.find('.customizer-repeater-item-content').slideToggle(300);
            
            return false;
        });

        // Add new item
        $(document).on('click', '.customizer-repeater-add-control-field', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            var $control = $(this).closest('.customizer-repeater-control-wrap');
            var $repeaterItems = $control.find('.customizer-repeater-general-control-repeater');
            var $firstItem = $repeaterItems.find('.customizer-repeater-general-control-repeater-item').first().clone();
            
            // Reset values in the cloned item
            $firstItem.find('.customizer-repeater-field-input').each(function() {
                $(this).val('');
            });
            
            // Reset title
            $firstItem.find('.customizer-repeater-item-title').text('New Item');
            
            // Make sure it's expanded
            $firstItem.addClass('expanded');
            $firstItem.find('.customizer-repeater-item-content').show();
            
            // Add to the container
            $repeaterItems.append($firstItem);
            
            // Update the value and trigger change
            updateRepeaterValue($control);
            
            return false;
        });
        
        // Remove item
        $(document).on('click', '.customizer-repeater-remove-item', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            var $control = $(this).closest('.customizer-repeater-control-wrap');
            var $repeaterItems = $control.find('.customizer-repeater-general-control-repeater-item');
            
            // Don't remove if it's the only item
            if ($repeaterItems.length > 1) {
                $(this).closest('.customizer-repeater-general-control-repeater-item').remove();
                updateRepeaterValue($control);
            }
            
            return false;
        });
        
        // Update when field values change
        $(document).on('change keyup input', '.customizer-repeater-field-input', function() {
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
        window.updateRepeaterValue = function($control) {
            try {
                var repeaterValue = [];
                
                $control.find('.customizer-repeater-general-control-repeater-item').each(function() {
                    var itemValue = {};
                    
                    $(this).find('.customizer-repeater-field-input').each(function() {
                        var $field = $(this);
                        var fieldId = $field.data('field');
                        var fieldValue = $field.val();
                        
                        if (fieldId) {
                            // Make sure we have valid values
                            if (fieldId === 'title' && !fieldValue) {
                                fieldValue = 'Title';
                            }
                            
                            if (fieldId === 'description' && !fieldValue) {
                                fieldValue = 'Description';
                            }
                            
                            itemValue[fieldId] = fieldValue;
                        }
                    });
                    
                    repeaterValue.push(itemValue);
                });
                
                // Use the safe JSON stringify function
                var jsonValue = safeJSONStringify(repeaterValue);
                
                // Save backup before setting
                try {
                    var id = $control.find('.customizer-repeater-collector').attr('id') || 'repeater';
                    localStorage.setItem('dt_backup_' + id, jsonValue);
                } catch (e) {
                    console.error('Error saving backup:', e);
                }
                
                $control.find('.customizer-repeater-collector').val(jsonValue).trigger('change');
            } catch (error) {
                console.error('Error updating repeater value:', error);
                
                // Try to recover using default empty value
                $control.find('.customizer-repeater-collector').val('[]').trigger('change');
            }
        };
        
        // Debug log if control is present
        if ($('.customizer-repeater-control-wrap').length) {
            console.log('Customizer repeater control initialized');
        } else {
            console.log('No customizer repeater control found on page');
        }
    });
})(jQuery); 