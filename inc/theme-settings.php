<?php
/**
 * Theme Settings Page
 *
 * @package Lanier_Plumbing
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Create the Lanier Plumbing menu and settings pages
 */
function lanier_plumbing_add_admin_menu() {
    // Add the main menu item
    add_menu_page(
        'Lanier Plumbing',          // Page title
        'Lanier Plumbing',          // Menu title
        'manage_options',           // Capability required
        'lanier-plumbing',          // Menu slug
        'lanier_plumbing_dashboard_page', // Callback function
        '',                         // Icon (removed)
        4                          // Position (between Dashboard [2] and Posts [5])
    );

    // Add Dashboard submenu (to match the parent)
    add_submenu_page(
        'lanier-plumbing',
        'Dashboard',
        'Dashboard',
        'manage_options',
        'lanier-plumbing',
        'lanier_plumbing_dashboard_page'
    );

    // Add Settings submenu
    add_submenu_page(
        'lanier-plumbing',
        'Settings',
        'Settings',
        'manage_options',
        'lanier-plumbing-settings',
        'lanier_plumbing_settings_page_html'
    );
}
add_action('admin_menu', 'lanier_plumbing_add_admin_menu');

/**
 * Register theme settings
 */
function lanier_plumbing_register_settings() {
    // Register setting with validation callback
    register_setting(
        'lanier_plumbing_options',
        'lanier_plumbing_options',
        array(
            'sanitize_callback' => 'lanier_plumbing_validate_options',
            'default' => array()
        )
    );

    // Branding Section
    add_settings_section(
        'lanier_plumbing_branding_section',
        'Branding',
        'lanier_plumbing_branding_section_callback',
        'lanier-plumbing-settings'
    );

    add_settings_field(
        'site_logo',
        'Site Logo',
        'lanier_plumbing_image_field_callback',
        'lanier-plumbing-settings',
        'lanier_plumbing_branding_section',
        array(
            'label_for' => 'site_logo',
            'class' => 'lanier-plumbing-row',
            'field_name' => 'site_logo'
        )
    );

    add_settings_field(
        'business_name',
        'Business Name',
        'lanier_plumbing_text_field_callback',
        'lanier-plumbing-settings',
        'lanier_plumbing_branding_section',
        array(
            'label_for' => 'business_name',
            'class' => 'lanier-plumbing-row',
            'field_name' => 'business_name',
            'placeholder' => 'Enter your business name'
        )
    );

    add_settings_field(
        'business_tagline',
        'Business Tagline',
        'lanier_plumbing_text_field_callback',
        'lanier-plumbing-settings',
        'lanier_plumbing_branding_section',
        array(
            'label_for' => 'business_tagline',
            'class' => 'lanier-plumbing-row',
            'field_name' => 'business_tagline',
            'placeholder' => 'Your trusted neighborhood plumber'
        )
    );

    // Contact Information Section
    add_settings_section(
        'lanier_plumbing_contact_section',
        'Contact Information',
        'lanier_plumbing_contact_section_callback',
        'lanier-plumbing-settings'
    );

    add_settings_field(
        'business_phone',
        'Primary Phone',
        'lanier_plumbing_phone_field_callback',
        'lanier-plumbing-settings',
        'lanier_plumbing_contact_section',
        array(
            'label_for' => 'business_phone',
            'class' => 'lanier-plumbing-row',
            'field_name' => 'business_phone',
            'placeholder' => '+1 (800) 555-1234'
        )
    );

    add_settings_field(
        'emergency_phone',
        'Emergency Phone',
        'lanier_plumbing_phone_field_callback',
        'lanier-plumbing-settings',
        'lanier_plumbing_contact_section',
        array(
            'label_for' => 'emergency_phone',
            'class' => 'lanier-plumbing-row',
            'field_name' => 'emergency_phone',
            'placeholder' => '+1 (800) 555-1234'
        )
    );

    add_settings_field(
        'business_email',
        'Email Address',
        'lanier_plumbing_email_field_callback',
        'lanier-plumbing-settings',
        'lanier_plumbing_contact_section',
        array(
            'label_for' => 'business_email',
            'class' => 'lanier-plumbing-row',
            'field_name' => 'business_email',
            'placeholder' => 'info@example.com'
        )
    );

    // Business Address
    add_settings_field(
        'business_address',
        'Business Address',
        'lanier_plumbing_textarea_field_callback',
        'lanier-plumbing-settings',
        'lanier_plumbing_contact_section',
        array(
            'label_for' => 'business_address',
            'class' => 'lanier-plumbing-row',
            'field_name' => 'business_address',
            'placeholder' => 'Enter your business address'
        )
    );

    // Service Area
    add_settings_field(
        'service_area',
        'Service Area',
        'lanier_plumbing_textarea_field_callback',
        'lanier-plumbing-settings',
        'lanier_plumbing_contact_section',
        array(
            'label_for' => 'service_area',
            'class' => 'lanier-plumbing-row',
            'field_name' => 'service_area',
            'placeholder' => 'List the areas you serve'
        )
    );

    // Business Hours Section
    add_settings_section(
        'lanier_plumbing_hours_section',
        'Business Hours',
        'lanier_plumbing_hours_section_callback',
        'lanier-plumbing-settings'
    );

    $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
    foreach ($days as $day) {
        add_settings_field(
            'hours_' . $day,
            ucfirst($day),
            'lanier_plumbing_hours_field_callback',
            'lanier-plumbing-settings',
            'lanier_plumbing_hours_section',
            array(
                'label_for' => 'hours_' . $day,
                'class' => 'lanier-plumbing-row',
                'field_name' => 'hours_' . $day,
                'day' => $day
            )
        );
    }

    // Social Media Section
    add_settings_section(
        'lanier_plumbing_social_section',
        'Social Media Links',
        'lanier_plumbing_social_section_callback',
        'lanier-plumbing-settings'
    );

    $social_platforms = array(
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
        'twitter' => 'Twitter',
        'linkedin' => 'LinkedIn',
        'youtube' => 'YouTube',
        'yelp' => 'Yelp'
    );

    foreach ($social_platforms as $platform => $label) {
        add_settings_field(
            'social_' . $platform,
            $label . ' URL',
            'lanier_plumbing_url_field_callback',
            'lanier-plumbing-settings',
            'lanier_plumbing_social_section',
            array(
                'label_for' => 'social_' . $platform,
                'class' => 'lanier-plumbing-row',
                'field_name' => 'social_' . $platform,
                'placeholder' => 'https://' . $platform . '.com/your-profile'
            )
        );
    }
}
add_action('admin_init', 'lanier_plumbing_register_settings');

/**
 * Section callbacks
 */
function lanier_plumbing_branding_section_callback() {
    ?>
    <p>Configure your business branding and identity settings.</p>
    <?php
}

function lanier_plumbing_contact_section_callback() {
    ?>
    <p>Enter your contact information. This will be displayed throughout your website.</p>
    <?php
}

function lanier_plumbing_hours_section_callback() {
    ?>
    <p>Set your business hours. Use 24-hour format (e.g., 09:00 - 17:00) or mark as closed.</p>
    <?php
}

function lanier_plumbing_social_section_callback() {
    ?>
    <p>Enter your social media profile URLs. Leave blank to hide social media icons.</p>
    <?php
}

/**
 * Field callbacks
 */
function lanier_plumbing_text_field_callback($args) {
    $options = get_option('lanier_plumbing_options');
    $value = isset($options[$args['field_name']]) ? $options[$args['field_name']] : '';
    ?>
    <input
        type="text"
        id="<?php echo esc_attr($args['label_for']); ?>"
        name="lanier_plumbing_options[<?php echo esc_attr($args['field_name']); ?>]"
        value="<?php echo esc_attr($value); ?>"
        class="w-full max-w-lg border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
        placeholder="<?php echo esc_attr($args['placeholder']); ?>"
    >
    <?php
}

function lanier_plumbing_phone_field_callback($args) {
    $options = get_option('lanier_plumbing_options');
    $value = isset($options[$args['field_name']]) ? $options[$args['field_name']] : '';
    ?>
    <input
        type="tel"
        id="<?php echo esc_attr($args['label_for']); ?>"
        name="lanier_plumbing_options[<?php echo esc_attr($args['field_name']); ?>]"
        value="<?php echo esc_attr($value); ?>"
        class="w-full max-w-lg border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
        placeholder="<?php echo esc_attr($args['placeholder']); ?>"
        pattern="[\+]?[0-9\s\-\(\)]+"
    >
    <?php
}

function lanier_plumbing_email_field_callback($args) {
    $options = get_option('lanier_plumbing_options');
    $value = isset($options[$args['field_name']]) ? $options[$args['field_name']] : '';
    ?>
    <input
        type="email"
        id="<?php echo esc_attr($args['label_for']); ?>"
        name="lanier_plumbing_options[<?php echo esc_attr($args['field_name']); ?>]"
        value="<?php echo esc_attr($value); ?>"
        class="w-full max-w-lg border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
        placeholder="<?php echo esc_attr($args['placeholder']); ?>"
    >
    <?php
}

function lanier_plumbing_textarea_field_callback($args) {
    $options = get_option('lanier_plumbing_options');
    $value = isset($options[$args['field_name']]) ? $options[$args['field_name']] : '';
    ?>
    <textarea
        id="<?php echo esc_attr($args['label_for']); ?>"
        name="lanier_plumbing_options[<?php echo esc_attr($args['field_name']); ?>]"
        class="w-full max-w-lg border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
        rows="3"
        placeholder="<?php echo esc_attr($args['placeholder']); ?>"
    ><?php echo esc_textarea($value); ?></textarea>
    <?php
}

function lanier_plumbing_url_field_callback($args) {
    $options = get_option('lanier_plumbing_options');
    $value = isset($options[$args['field_name']]) ? $options[$args['field_name']] : '';
    ?>
    <input
        type="url"
        id="<?php echo esc_attr($args['label_for']); ?>"
        name="lanier_plumbing_options[<?php echo esc_attr($args['field_name']); ?>]"
        value="<?php echo esc_attr($value); ?>"
        class="w-full max-w-lg border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
        placeholder="<?php echo esc_attr($args['placeholder']); ?>"
    >
    <?php
}

function lanier_plumbing_hours_field_callback($args) {
    $options = get_option('lanier_plumbing_options');
    $day = $args['day'];
    $is_closed = isset($options['hours_' . $day . '_closed']) ? $options['hours_' . $day . '_closed'] : false;
    $open_time = isset($options['hours_' . $day . '_open']) ? $options['hours_' . $day . '_open'] : '';
    $close_time = isset($options['hours_' . $day . '_close']) ? $options['hours_' . $day . '_close'] : '';
    ?>
    <div class="flex items-center space-x-4">
        <label class="inline-flex items-center">
            <input
                type="checkbox"
                name="lanier_plumbing_options[hours_<?php echo esc_attr($day); ?>_closed]"
                value="1"
                <?php checked($is_closed); ?>
                class="text-blue-600 border-gray-300 rounded shadow-sm focus:border-blue-500 focus:ring-blue-500"
            >
            <span class="ml-2 text-sm text-gray-600">Closed</span>
        </label>
        <div class="flex items-center space-x-2">
            <input
                type="time"
                name="lanier_plumbing_options[hours_<?php echo esc_attr($day); ?>_open]"
                value="<?php echo esc_attr($open_time); ?>"
                <?php disabled($is_closed); ?>
                class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
            >
            <span class="text-gray-500">to</span>
            <input
                type="time"
                name="lanier_plumbing_options[hours_<?php echo esc_attr($day); ?>_close]"
                value="<?php echo esc_attr($close_time); ?>"
                <?php disabled($is_closed); ?>
                class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
            >
        </div>
    </div>
    <?php
}

function lanier_plumbing_image_field_callback($args) {
    $options = get_option('lanier_plumbing_options');
    $image_id = isset($options[$args['field_name']]) ? $options[$args['field_name']] : '';
    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'medium') : '';
    ?>
    <div class="space-y-4">
        <div class="image-preview">
            <?php if ($image_url) : ?>
                <img src="<?php echo esc_url($image_url); ?>" alt="" class="max-w-xs rounded-lg shadow-sm">
            <?php endif; ?>
        </div>
        <input
            type="hidden"
            id="<?php echo esc_attr($args['label_for']); ?>"
            name="lanier_plumbing_options[<?php echo esc_attr($args['field_name']); ?>]"
            value="<?php echo esc_attr($image_id); ?>"
        >
        <div class="flex space-x-2">
            <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm upload-image hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <?php echo $image_id ? 'Change Image' : 'Select Image'; ?>
            </button>
            <?php if ($image_id) : ?>
                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-red-700 bg-white border border-red-300 rounded-md shadow-sm remove-image hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Remove Image
                </button>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

/**
 * Validate options
 */
function lanier_plumbing_validate_options($input) {
    $output = array();
    
    // Validate text fields
    $text_fields = array('business_name', 'business_tagline', 'service_area');
    foreach ($text_fields as $field) {
        if (isset($input[$field])) {
            $output[$field] = sanitize_text_field($input[$field]);
        }
    }

    // Validate URLs
    $url_fields = array('social_facebook', 'social_instagram', 'social_twitter', 'social_linkedin', 'social_youtube', 'social_yelp');
    foreach ($url_fields as $field) {
        if (isset($input[$field])) {
            $output[$field] = esc_url_raw($input[$field]);
        }
    }

    // Validate email
    if (isset($input['business_email'])) {
        $output['business_email'] = sanitize_email($input['business_email']);
    }

    // Validate phone numbers
    $phone_fields = array('business_phone', 'emergency_phone');
    foreach ($phone_fields as $field) {
        if (isset($input[$field])) {
            // Remove everything except digits and plus sign
            $phone = preg_replace('/[^0-9\+]/', '', $input[$field]);
            $output[$field] = $phone;
        }
    }

    // Validate business hours
    $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
    foreach ($days as $day) {
        $field = 'hours_' . $day;
        if (isset($input[$field . '_closed'])) {
            $output[$field . '_closed'] = true;
        }
        if (isset($input[$field . '_open'])) {
            $output[$field . '_open'] = sanitize_text_field($input[$field . '_open']);
        }
        if (isset($input[$field . '_close'])) {
            $output[$field . '_close'] = sanitize_text_field($input[$field . '_close']);
        }
    }

    // Validate image ID
    if (isset($input['site_logo'])) {
        $output['site_logo'] = absint($input['site_logo']);
    }

    return $output;
}

/**
 * Settings page HTML
 */
function lanier_plumbing_settings_page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }

    // Show success message if settings are saved
    if (isset($_GET['settings-updated'])) {
        add_settings_error(
            'lanier_plumbing_messages',
            'lanier_plumbing_message',
            'Settings Saved',
            'updated'
        );
    }

    ?>
    <div class="wrap">
        <div class="max-w-5xl mx-auto">
            <h1 class="mb-6 text-2xl font-bold"><?php echo esc_html(get_admin_page_title()); ?></h1>
            <?php settings_errors('lanier_plumbing_messages'); ?>
            
            <form method="post" action="options.php" class="bg-white rounded-lg shadow-sm">
                <?php
                settings_fields('lanier_plumbing_options');
                ?>
                
                <div class="p-6 space-y-6">
                    <?php do_settings_sections('lanier-plumbing-settings'); ?>
                </div>

                <div class="px-6 py-4 border-t border-gray-200 rounded-b-lg bg-gray-50">
                    <?php submit_button('Save Settings', 'primary', 'submit', false, array('class' => 'px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2')); ?>
                </div>
            </form>
        </div>
    </div>

    <style>
    /* Override WordPress admin styles */
    .wrap {
        margin: 20px 20px 0 2px;
    }
    .form-table th {
        padding: 20px 10px 20px 0;
        width: 200px;
        vertical-align: top;
    }
    .form-table td {
        padding: 15px 10px;
        vertical-align: middle;
    }
    .form-table input[type="text"],
    .form-table input[type="email"],
    .form-table input[type="url"],
    .form-table input[type="tel"],
    .form-table textarea {
        width: 100%;
        max-width: 400px;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        line-height: 1.25rem;
        color: #374151;
        background-color: #fff;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }
    .form-table input[type="text"]:focus,
    .form-table input[type="email"]:focus,
    .form-table input[type="url"]:focus,
    .form-table input[type="tel"]:focus,
    .form-table textarea:focus {
        outline: 2px solid transparent;
        outline-offset: 2px;
        border-color: #2563eb;
        ring-color: #3b82f6;
        ring-offset-width: 2px;
    }
    .form-table textarea {
        min-height: 100px;
    }
    .hours-field {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .hours-inputs {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .hours-field input[type="time"] {
        padding: 0.375rem 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
    }
    .hours-field input[type="checkbox"] {
        margin-right: 0.5rem;
    }
    .image-field {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    .image-preview {
        max-width: 300px;
        margin-bottom: 10px;
    }
    .image-preview img {
        max-width: 100%;
        height: auto;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.25rem;
    }
    .button.upload-image,
    .button.remove-image {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 0.375rem;
        border: 1px solid #d1d5db;
        background-color: #fff;
        color: #374151;
        cursor: pointer;
        transition: all 150ms ease-in-out;
    }
    .button.upload-image:hover,
    .button.remove-image:hover {
        background-color: #f3f4f6;
        border-color: #9ca3af;
    }
    .button.remove-image {
        margin-left: 0.5rem;
        color: #dc2626;
        border-color: #dc2626;
    }
    .button.remove-image:hover {
        background-color: #fee2e2;
    }
    h2 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #111827;
        margin: 2rem 0 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e5e7eb;
    }
    .updated {
        background-color: #ecfdf5;
        border-color: #059669;
        color: #065f46;
    }
    </style>
    <?php
}

/**
 * Theme Options Page
 */
function lanier_plumbing_theme_options_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        
        <form method="post" action="options.php">
            <?php
            settings_fields('lanier_plumbing_theme_options');
            do_settings_sections('lanier_plumbing_theme_options');
            submit_button('Save Theme Options');
            ?>
        </form>

        <div class="theme-preview">
            <h2>Preview</h2>
            <div class="preview-box">
                <!-- Preview content will be added via JavaScript -->
            </div>
        </div>
    </div>

    <style>
    .wrap {
        max-width: 1200px;
    }
    .form-table {
        background: white;
        padding: 20px;
        border: 1px solid #ccd0d4;
        border-radius: 4px;
    }
    .color-picker {
        vertical-align: middle;
        padding: 0;
        width: 100px;
        height: 30px;
    }
    .color-value {
        margin-left: 10px;
        padding: 5px;
        background: #f0f0f1;
        border-radius: 3px;
    }
    .theme-preview {
        margin-top: 30px;
        padding: 20px;
        background: white;
        border: 1px solid #ccd0d4;
        border-radius: 4px;
    }
    .preview-box {
        margin-top: 15px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    </style>
    <?php
}

/**
 * Header Options Page
 */
function lanier_plumbing_header_page() {
    ?>
    <div class="wrap">
        <h1>Header Options</h1>
        <div class="header-options-grid">
            <div class="card">
                <h2>Header Layout</h2>
                <form method="post" action="options.php">
                    <?php
                    settings_fields('lanier_plumbing_header_options');
                    do_settings_sections('lanier_plumbing_header_options');
                    submit_button();
                    ?>
                </form>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Footer Options Page
 */
function lanier_plumbing_footer_page() {
    ?>
    <div class="wrap">
        <h1>Footer Options</h1>
        <div class="footer-options-grid">
            <div class="card">
                <h2>Footer Layout</h2>
                <form method="post" action="options.php">
                    <?php
                    settings_fields('lanier_plumbing_footer_options');
                    do_settings_sections('lanier_plumbing_footer_options');
                    submit_button();
                    ?>
                </form>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Redirect theme settings page if not accessed through Lanier Plumbing menu
 */
function lanier_plumbing_settings_access_control() {
    global $parent_file, $submenu_file;
    
    // Check if we're on our settings page
    if (isset($_GET['page']) && $_GET['page'] === 'lanier-plumbing-settings') {
        // If not accessed through our menu, redirect to our menu
        if ($parent_file !== 'lanier-plumbing') {
            wp_redirect(admin_url('admin.php?page=lanier-plumbing-settings'));
            exit;
        }
    }
}
add_action('admin_init', 'lanier_plumbing_settings_access_control');

/**
 * Dashboard page HTML
 */
function lanier_plumbing_dashboard_page() {
    wp_enqueue_style('tailwindcss', 'https://cdn.tailwindcss.com');
    ?>
    <style>
        .lucide-icon {
            width: 1rem !important;
            height: 1rem !important;
            flex-shrink: 0;
        }
    </style>

    <div class="w-full p-6 space-y-8">
        <div class="space-y-2">
            <h1 class="text-3xl font-bold tracking-tight">Welcome to Your Dashboard</h1>
            <p class="text-lg text-gray-600">Manage your website content and find helpful resources all in one place.</p>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Agency Support Card -->
            <div class="p-6 space-y-6 bg-white border rounded-lg shadow-sm">
                <div class="space-y-1">
                    <h2 class="text-2xl font-semibold">Agency Support</h2>
                    <p class="text-gray-500">Web Development Team</p>
                </div>
                <div class="space-y-4">
                    <div class="p-4 rounded-lg bg-blue-50">
                        <p class="text-blue-700">Available Monday - Friday, 9 AM - 5 PM EST</p>
                    </div>
                    <div class="space-y-3">
                        <a href="mailto:support@webagency.com" class="flex items-center text-blue-600 transition-colors hover:text-blue-800">
                            <svg class="mr-2 lucide-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                            support@webagency.com
                        </a>
                        <a href="tel:8005551234" class="flex items-center text-blue-600 transition-colors hover:text-blue-800">
                            <svg class="mr-2 lucide-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            (800) 555-1234
                        </a>
                        <a href="#" class="flex items-center text-blue-600 transition-colors hover:text-blue-800">
                            <svg class="mr-2 lucide-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                            Visit Support Portal
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="p-6 space-y-6 bg-white border rounded-lg shadow-sm">
                <h2 class="text-2xl font-semibold">Quick Actions</h2>
                <div class="grid grid-cols-2 gap-4">
                    <a href="<?php echo admin_url('admin.php?page=lanier-plumbing-settings'); ?>" 
                       class="flex items-center justify-center p-4 text-sm font-medium text-gray-700 transition-colors border rounded-lg bg-gray-50 hover:bg-gray-100">
                        <svg class="mr-2 lucide-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                        Update Settings
                    </a>
                    <a href="<?php echo admin_url('post-new.php'); ?>" 
                       class="flex items-center justify-center p-4 text-sm font-medium text-gray-700 transition-colors border rounded-lg bg-gray-50 hover:bg-gray-100">
                        <svg class="mr-2 lucide-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Add New Post
                    </a>
                    <a href="<?php echo admin_url('upload.php'); ?>" 
                       class="flex items-center justify-center p-4 text-sm font-medium text-gray-700 transition-colors border rounded-lg bg-gray-50 hover:bg-gray-100">
                        <svg class="mr-2 lucide-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                        Media Library
                    </a>
                    <a href="<?php echo admin_url('nav-menus.php'); ?>" 
                       class="flex items-center justify-center p-4 text-sm font-medium text-gray-700 transition-colors border rounded-lg bg-gray-50 hover:bg-gray-100">
                        <svg class="mr-2 lucide-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                        Edit Menus
                    </a>
                </div>
            </div>
        </div>

        <!-- Resources Section -->
        <div class="p-6 space-y-6 bg-white border rounded-lg shadow-sm">
            <h2 class="text-2xl font-semibold">Helpful Resources</h2>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <!-- WordPress Guides -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold">WordPress Guides</h3>
                    <div class="space-y-2">
                        <a href="https://wordpress.org/support/" class="flex items-center text-blue-600 transition-colors hover:text-blue-800">
                            <svg class="mr-2 lucide-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                            WordPress Support
                        </a>
                        <a href="https://wordpress.org/support/article/wordpress-editor/" class="flex items-center text-blue-600 transition-colors hover:text-blue-800">
                            <svg class="mr-2 lucide-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                            Using the Editor
                        </a>
                        <a href="https://wordpress.org/support/article/media-library-screen/" class="flex items-center text-blue-600 transition-colors hover:text-blue-800">
                            <svg class="mr-2 lucide-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                            Media Management
                        </a>
                    </div>
                </div>

                <!-- SEO Resources -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold">SEO Resources</h3>
                    <div class="space-y-2">
                        <a href="https://yoast.com/wordpress/plugins/seo/" class="flex items-center text-blue-600 transition-colors hover:text-blue-800">
                            <svg class="mr-2 lucide-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                            Yoast SEO Guide
                        </a>
                        <a href="https://search.google.com/search-console" class="flex items-center text-blue-600 transition-colors hover:text-blue-800">
                            <svg class="mr-2 lucide-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                            Google Search Console
                        </a>
                        <a href="https://developers.google.com/search/docs/beginner/seo-starter-guide" class="flex items-center text-blue-600 transition-colors hover:text-blue-800">
                            <svg class="mr-2 lucide-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                            Google SEO Guide
                        </a>
                    </div>
                </div>

                <!-- Security Tips -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold">Security Tips</h3>
                    <div class="space-y-2">
                        <a href="https://wordpress.org/support/article/hardening-wordpress/" class="flex items-center text-blue-600 transition-colors hover:text-blue-800">
                            <svg class="mr-2 lucide-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                            WordPress Security
                        </a>
                        <a href="https://www.wordfence.com/learn/" class="flex items-center text-blue-600 transition-colors hover:text-blue-800">
                            <svg class="mr-2 lucide-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                            Security Best Practices
                        </a>
                        <a href="https://wordpress.org/support/article/updating-wordpress/" class="flex items-center text-blue-600 transition-colors hover:text-blue-800">
                            <svg class="mr-2 lucide-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                            Keeping WordPress Updated
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Emergency Support Card -->
        <div class="p-6 space-y-4 bg-white border rounded-lg shadow-sm">
            <h2 class="text-2xl font-semibold">Need urgent assistance?</h2>
            <div class="space-y-2">
                <p class="text-gray-600">For emergency support outside of business hours, call our 24/7 support line at</p>
                <a href="tel:8005559999" class="flex items-center text-xl font-semibold text-blue-600 transition-colors hover:text-blue-800">
                    <svg class="mr-2 lucide-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    (800) 555-9999
                </a>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Get theme option
 */
function lanier_plumbing_get_option($key = '', $default = '') {
    $options = get_option('lanier_plumbing_options');
    return isset($options[$key]) && !empty($options[$key]) ? $options[$key] : $default;
}

/**
 * Format business hours
 */
function lanier_plumbing_get_formatted_hours() {
    $options = get_option('lanier_plumbing_options');
    
    // Check weekday hours
    $weekday_open = isset($options['hours_monday_open']) ? $options['hours_monday_open'] : '';
    $weekday_close = isset($options['hours_monday_close']) ? $options['hours_monday_close'] : '';
    
    // Check weekend hours
    $saturday_open = isset($options['hours_saturday_open']) ? $options['hours_saturday_open'] : '';
    $saturday_close = isset($options['hours_saturday_close']) ? $options['hours_saturday_close'] : '';
    $sunday_open = isset($options['hours_sunday_open']) ? $options['hours_sunday_open'] : '';
    $sunday_close = isset($options['hours_sunday_close']) ? $options['hours_sunday_close'] : '';

    // Format weekday hours
    if ($weekday_open && $weekday_close) {
        $weekday_hours = date('ga', strtotime($weekday_open)) . ' - ' . date('ga', strtotime($weekday_close));
        $weekday_text = "Mon - Fri: $weekday_hours";
    } else {
        $weekday_text = "Mon - Fri: Closed";
    }

    // Format weekend hours
    if ($saturday_open && $saturday_close && $sunday_open && $sunday_close) {
        if ($saturday_open === $sunday_open && $saturday_close === $sunday_close) {
            $weekend_hours = date('ga', strtotime($saturday_open)) . ' - ' . date('ga', strtotime($saturday_close));
            $weekend_text = "Sat - Sun: $weekend_hours";
        } else {
            $sat_hours = date('ga', strtotime($saturday_open)) . ' - ' . date('ga', strtotime($saturday_close));
            $sun_hours = date('ga', strtotime($sunday_open)) . ' - ' . date('ga', strtotime($sunday_close));
            $weekend_text = "Sat: $sat_hours | Sun: $sun_hours";
        }
    } elseif ($saturday_open && $saturday_close) {
        $sat_hours = date('ga', strtotime($saturday_open)) . ' - ' . date('ga', strtotime($saturday_close));
        $weekend_text = "Sat: $sat_hours | Sun: Closed";
    } elseif ($sunday_open && $sunday_close) {
        $sun_hours = date('ga', strtotime($sunday_open)) . ' - ' . date('ga', strtotime($sunday_close));
        $weekend_text = "Sat: Closed | Sun: $sun_hours";
    } else {
        $weekend_text = "Sat - Sun: Closed";
    }

    return "$weekday_text | $weekend_text";
}

/**
 * Enqueue admin scripts
 */
function lanier_plumbing_admin_scripts($hook) {
    // Only enqueue on our settings page
    if ('toplevel_page_lanier-plumbing' !== $hook && 'lanier-plumbing_page_lanier-plumbing-settings' !== $hook) {
        return;
    }

    // Enqueue WordPress media uploader scripts
    wp_enqueue_media();

    // Enqueue WordPress color picker
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');

    // Enqueue jQuery UI for tabs
    wp_enqueue_script('jquery-ui-tabs');
    wp_enqueue_style('wp-jquery-ui-dialog');

    // Enqueue our custom script
    wp_enqueue_script(
        'lanier-plumbing-admin',
        get_template_directory_uri() . '/js/admin.js',
        array('jquery', 'jquery-ui-tabs', 'wp-color-picker'),
        '1.0.0',
        true
    );

    // Add inline script to initialize tabs
    wp_add_inline_script('lanier-plumbing-admin', '
        jQuery(document).ready(function($) {
            // Initialize tabs
            $(".nav-tab-wrapper").on("click", ".nav-tab", function(e) {
                e.preventDefault();
                var target = $(this).attr("href");
                
                // Update active tab
                $(".nav-tab").removeClass("nav-tab-active");
                $(this).addClass("nav-tab-active");
                
                // Show target section
                $(".tab-pane").removeClass("active");
                $(target).addClass("active");
            });

            // Initialize media uploader
            $(".upload-image").on("click", function(e) {
                e.preventDefault();
                var button = $(this);
                var imageField = button.closest(".image-field");
                var imagePreview = imageField.find(".image-preview");
                var imageInput = imageField.find("input[type=hidden]");
                
                var frame = wp.media({
                    title: "Select or Upload Image",
                    button: {
                        text: "Use this image"
                    },
                    multiple: false
                });

                frame.on("select", function() {
                    var attachment = frame.state().get("selection").first().toJSON();
                    imageInput.val(attachment.id);
                    imagePreview.html("<img src=\"" + attachment.url + "\" alt=\"\">");
                    button.text("Change Image");
                    imageField.find(".remove-image").show();
                });

                frame.open();
            });

            // Handle image removal
            $(".remove-image").on("click", function(e) {
                e.preventDefault();
                var button = $(this);
                var imageField = button.closest(".image-field");
                imageField.find("input[type=hidden]").val("");
                imageField.find(".image-preview").empty();
                imageField.find(".upload-image").text("Select Image");
                button.hide();
            });
        });
    ');
}
add_action('admin_enqueue_scripts', 'lanier_plumbing_admin_scripts'); 