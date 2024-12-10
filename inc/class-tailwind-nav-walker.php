<?php
/**
 * Custom Navigation Walker for Tailwind CSS
 */

class Tailwind_Nav_Walker extends Walker_Nav_Menu {
    /**
     * Starts the element output.
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        
        // Base classes for all menu items
        $base_classes = array(
            'text-sm',
            'transition-colors',
            'hover:text-red-600',
        );

        // Add location-specific classes
        if (isset($args->theme_location) && $args->theme_location === 'footer-menu') {
            // Footer menu items don't need additional classes
            $output .= '<li>';
        } else {
            // Header menu classes
            $base_classes = array_merge($base_classes, array(
                'block',
                'w-full',
                'md:w-auto',
                'md:p-0',
                'py-2',
                'md:py-0',
            ));

            // Add text color based on current/active state for header menu
            if (in_array('current-menu-item', $classes)) {
                $base_classes[] = 'text-red-600';
            } else {
                $base_classes[] = 'text-gray-700';
            }
        }
        
        // Merge with existing classes and filter
        $classes = array_merge($classes, $base_classes);
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        // Build the output
        $output .= '<a' . $class_names . ' href="' . esc_url($item->url) . '">';
        $output .= apply_filters('the_title', $item->title, $item->ID);
        $output .= '</a>';

        // Close the li tag for footer menu
        if (isset($args->theme_location) && $args->theme_location === 'footer-menu') {
            $output .= '</li>';
        }
    }

    /**
     * Starts the list before the elements are added.
     */
    public function start_lvl(&$output, $depth = 0, $args = array()) {
        if (isset($args->theme_location) && $args->theme_location === 'footer-menu') {
            $output .= '<ul class="space-y-2">';
        } else {
            $output .= '<ul>';
        }
    }

    /**
     * Ends the list of after the elements are added.
     */
    public function end_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '</ul>';
    }

    /**
     * Ends the element output, if needed.
     */
    public function end_el(&$output, $item, $depth = 0, $args = array()) {
        $output .= "\n";
    }
} 