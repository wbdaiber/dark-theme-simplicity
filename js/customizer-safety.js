/**
 * Dark Theme Simplicity - Customizer Safety
 * Protects against customizer operations that could cause the site to break
 */
(function($) {
    'use strict';

    // Safety wrapper for customizer operations
    var safetyWrapper = {
        // Safe JSON stringify for repeater fields
        safeStringify: function(data) {
            try {
                return JSON.stringify(data);
            } catch (e) {
                console.error('Failed to stringify data:', e);
                // Return empty array if stringify fails
                return '[]';
            }
        },
        
        // Safe JSON parse for repeater fields
        safeParse: function(jsonString) {
            try {
                var data = JSON.parse(jsonString);
                return (data && typeof data === 'object') ? data : [];
            } catch (e) {
                console.error('Failed to parse JSON:', e);
                return [];
            }
        },
        
        // Validate approach items to ensure they won't break the site
        validateApproachItems: function(items) {
            var validItems = [];
            
            // If items isn't an array, return empty array
            if (!Array.isArray(items)) {
                return validItems;
            }
            
            // Filter out invalid items
            items.forEach(function(item) {
                // Make sure item is an object
                if (typeof item !== 'object' || item === null) {
                    return;
                }
                
                // Ensure it has required fields
                var validItem = {
                    title: item.title || 'Title',
                    description: item.description || 'Description'
                };
                
                // Add icon if present
                if (item.icon) {
                    validItem.icon = item.icon;
                }
                
                validItems.push(validItem);
            });
            
            return validItems;
        }
    };
    
    // Override customizer repeater functionality to include safety checks
    $(document).ready(function() {
        // Safe update for repeater value
        var originalUpdateRepeaterValue = window.updateRepeaterValue;
        
        if (typeof originalUpdateRepeaterValue === 'function') {
            window.updateRepeaterValue = function($control) {
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
                
                // Validate approach items before saving
                var validatedValue = safetyWrapper.validateApproachItems(repeaterValue);
                
                // Use safe stringify
                var jsonValue = safetyWrapper.safeStringify(validatedValue);
                
                // Update the hidden field with validated JSON
                $control.find('.customizer-repeater-collector').val(jsonValue).trigger('change');
                
                // Log success
                console.log('Safely updated repeater value:', validatedValue);
            };
        }
        
        // Add safety backup functionality
        var safetyCheckInterval = setInterval(function() {
            // Check if we have a repeater collector
            var $collector = $('.customizer-repeater-collector');
            
            if ($collector.length) {
                // For each collector, save a backup value
                $collector.each(function() {
                    var value = $(this).val();
                    var id = $(this).attr('id') || 'repeater';
                    
                    // Only backup if we have a valid value
                    if (value) {
                        try {
                            // Test parse to ensure it's valid JSON
                            JSON.parse(value);
                            // If valid, store in localStorage
                            localStorage.setItem('dt_backup_' + id, value);
                        } catch (e) {
                            console.error('Invalid JSON in repeater, not backing up:', e);
                        }
                    }
                });
            }
        }, 10000); // Check every 10 seconds
    });
    
})(jQuery); 