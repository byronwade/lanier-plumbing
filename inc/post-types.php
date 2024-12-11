<?php
/**
 * Custom Post Types
 *
 * @package Lanier_Plumbing
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register custom post types
 */
function lanier_plumbing_register_post_types() {
    // Services Post Type
    $labels = array(
        'name'                  => _x('Services', 'Post type general name', 'lanier-plumbing'),
        'singular_name'         => _x('Service', 'Post type singular name', 'lanier-plumbing'),
        'menu_name'            => _x('Services', 'Admin Menu text', 'lanier-plumbing'),
        'name_admin_bar'       => _x('Service', 'Add New on Toolbar', 'lanier-plumbing'),
        'add_new'              => __('Add New', 'lanier-plumbing'),
        'add_new_item'         => __('Add New Service', 'lanier-plumbing'),
        'new_item'             => __('New Service', 'lanier-plumbing'),
        'edit_item'            => __('Edit Service', 'lanier-plumbing'),
        'view_item'            => __('View Service', 'lanier-plumbing'),
        'all_items'            => __('All Services', 'lanier-plumbing'),
        'search_items'         => __('Search Services', 'lanier-plumbing'),
        'parent_item_colon'    => __('Parent Services:', 'lanier-plumbing'),
        'not_found'            => __('No services found.', 'lanier-plumbing'),
        'not_found_in_trash'   => __('No services found in Trash.', 'lanier-plumbing'),
        'featured_image'       => _x('Service Cover Image', 'Overrides the "Featured Image" phrase', 'lanier-plumbing'),
        'set_featured_image'   => _x('Set cover image', 'Overrides the "Set featured image" phrase', 'lanier-plumbing'),
        'remove_featured_image' => _x('Remove cover image', 'Overrides the "Remove featured image" phrase', 'lanier-plumbing'),
        'use_featured_image'   => _x('Use as cover image', 'Overrides the "Use as featured image" phrase', 'lanier-plumbing'),
        'archives'             => _x('Service archives', 'The post type archive label used in nav menus', 'lanier-plumbing'),
        'insert_into_item'     => _x('Insert into service', 'Overrides the "Insert into post" phrase', 'lanier-plumbing'),
        'uploaded_to_this_item' => _x('Uploaded to this service', 'Overrides the "Uploaded to this post" phrase', 'lanier-plumbing'),
        'filter_items_list'    => _x('Filter services list', 'Screen reader text for the filter links', 'lanier-plumbing'),
        'items_list_navigation' => _x('Services list navigation', 'Screen reader text for the pagination', 'lanier-plumbing'),
        'items_list'           => _x('Services list', 'Screen reader text for the items list', 'lanier-plumbing'),
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'services'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-admin-tools',
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'custom-fields',
            'revisions',
            'page-attributes',
        ),
        'show_in_rest'        => true, // Enable Gutenberg editor
        'rest_base'           => 'services',
        'template'            => array(
            array('core/paragraph', array(
                'placeholder' => 'Add a brief description of this service...'
            )),
            array('core/heading', array(
                'content' => 'Service Details',
                'level' => 2
            )),
            array('core/list'),
            array('core/heading', array(
                'content' => 'Why Choose Us',
                'level' => 2
            )),
            array('core/paragraph'),
        ),
        'template_lock'       => false,
    );

    register_post_type('service', $args);

    // Flush rewrite rules only on theme activation
    if (get_option('lanier_plumbing_flush_rewrite_rules')) {
        flush_rewrite_rules();
        delete_option('lanier_plumbing_flush_rewrite_rules');
    }
}
add_action('init', 'lanier_plumbing_register_post_types');

/**
 * Add custom meta boxes for services
 */
function lanier_plumbing_add_service_meta_boxes() {
    add_meta_box(
        'service_details',
        __('Service Details', 'lanier-plumbing'),
        'lanier_plumbing_service_details_callback',
        'service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'lanier_plumbing_add_service_meta_boxes');

/**
 * Service details meta box callback
 */
function lanier_plumbing_service_details_callback($post) {
    // Add nonce for security
    wp_nonce_field('lanier_plumbing_service_details', 'lanier_plumbing_service_details_nonce');

    // Get existing values
    $price_range = get_post_meta($post->ID, '_service_price_range', true);
    $duration = get_post_meta($post->ID, '_service_duration', true);
    $emergency = get_post_meta($post->ID, '_service_emergency', true);

    ?>
    <div class="service-meta-box">
        <p>
            <label for="service_price_range"><?php _e('Price Range:', 'lanier-plumbing'); ?></label>
            <input type="text" id="service_price_range" name="service_price_range" 
                   value="<?php echo esc_attr($price_range); ?>" class="widefat"
                   placeholder="e.g., $100-$500">
        </p>
        <p>
            <label for="service_duration"><?php _e('Typical Duration:', 'lanier-plumbing'); ?></label>
            <input type="text" id="service_duration" name="service_duration" 
                   value="<?php echo esc_attr($duration); ?>" class="widefat"
                   placeholder="e.g., 1-2 hours">
        </p>
        <p>
            <label>
                <input type="checkbox" name="service_emergency" value="1" 
                       <?php checked($emergency, '1'); ?>>
                <?php _e('Available for Emergency Service', 'lanier-plumbing'); ?>
            </label>
        </p>
    </div>
    <style>
        .service-meta-box {
            padding: 12px;
        }
        .service-meta-box p {
            margin: 1em 0;
        }
        .service-meta-box label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .service-meta-box input[type="text"] {
            width: 100%;
            padding: 8px;
        }
    </style>
    <?php
}

/**
 * Save service meta box data
 */
function lanier_plumbing_save_service_meta($post_id) {
    // Check if our nonce is set and verify it
    if (!isset($_POST['lanier_plumbing_service_details_nonce']) ||
        !wp_verify_nonce($_POST['lanier_plumbing_service_details_nonce'], 'lanier_plumbing_service_details')) {
        return;
    }

    // If this is an autosave, don't do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save price range
    if (isset($_POST['service_price_range'])) {
        update_post_meta(
            $post_id,
            '_service_price_range',
            sanitize_text_field($_POST['service_price_range'])
        );
    }

    // Save duration
    if (isset($_POST['service_duration'])) {
        update_post_meta(
            $post_id,
            '_service_duration',
            sanitize_text_field($_POST['service_duration'])
        );
    }

    // Save emergency service availability
    $emergency = isset($_POST['service_emergency']) ? '1' : '0';
    update_post_meta($post_id, '_service_emergency', $emergency);
}
add_action('save_post_service', 'lanier_plumbing_save_service_meta'); 