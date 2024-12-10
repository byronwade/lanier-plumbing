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

    // Add core WordPress pages but keep their original URLs
    add_submenu_page(
        'lanier-plumbing',
        'Customize',
        'Customize Theme',
        'manage_options',
        'customize.php?return=' . urlencode(admin_url('admin.php?page=lanier-plumbing-settings')),
        ''
    );

    add_submenu_page(
        'lanier-plumbing',
        'Menus',
        'Navigation Menus',
        'manage_options',
        'nav-menus.php',
        ''
    );

    add_submenu_page(
        'lanier-plumbing',
        'Widgets',
        'Widgets',
        'manage_options',
        'widgets.php',
        ''
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
        class="regular-text"
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
        class="regular-text"
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
        class="regular-text"
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
        class="large-text"
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
        class="regular-text"
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
    <div class="hours-field">
        <label>
            <input
                type="checkbox"
                name="lanier_plumbing_options[hours_<?php echo esc_attr($day); ?>_closed]"
                value="1"
                <?php checked($is_closed); ?>
            >
            Closed
        </label>
        <div class="hours-inputs">
            <input
                type="time"
                name="lanier_plumbing_options[hours_<?php echo esc_attr($day); ?>_open]"
                value="<?php echo esc_attr($open_time); ?>"
                <?php disabled($is_closed); ?>
            >
            to
            <input
                type="time"
                name="lanier_plumbing_options[hours_<?php echo esc_attr($day); ?>_close]"
                value="<?php echo esc_attr($close_time); ?>"
                <?php disabled($is_closed); ?>
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
    <div class="image-field">
        <div class="image-preview">
            <?php if ($image_url) : ?>
                <img src="<?php echo esc_url($image_url); ?>" alt="">
            <?php endif; ?>
        </div>
        <input
            type="hidden"
            id="<?php echo esc_attr($args['label_for']); ?>"
            name="lanier_plumbing_options[<?php echo esc_attr($args['field_name']); ?>]"
            value="<?php echo esc_attr($image_id); ?>"
        >
        <button type="button" class="button upload-image">
            <?php echo $image_id ? 'Change Image' : 'Select Image'; ?>
        </button>
        <?php if ($image_id) : ?>
            <button type="button" class="button remove-image">Remove Image</button>
        <?php endif; ?>
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
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <?php settings_errors('lanier_plumbing_messages'); ?>
        
        <div class="nav-tab-wrapper">
            <a href="#business-info" class="nav-tab nav-tab-active">Business Info</a>
            <a href="#contact-info" class="nav-tab">Contact Info</a>
            <a href="#business-hours" class="nav-tab">Business Hours</a>
            <a href="#social-media" class="nav-tab">Social Media</a>
        </div>

        <div class="tab-content">
            <div id="business-info" class="tab-pane active">
                <form method="post" action="options.php">
                    <?php
                    settings_fields('lanier_plumbing_options');
                    do_settings_sections('lanier-plumbing-settings');
                    submit_button('Save Settings');
                    ?>
                </form>
            </div>
        </div>
    </div>

    <style>
    .wrap {
        max-width: 1200px;
    }
    .nav-tab-wrapper {
        margin-bottom: 20px;
    }
    .tab-content {
        background: white;
        padding: 20px;
        border: 1px solid #ccd0d4;
        border-radius: 0 4px 4px 4px;
        margin-top: -1px;
    }
    .tab-pane {
        display: none;
    }
    .tab-pane.active {
        display: block;
    }
    .form-table {
        margin-top: 0;
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
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
    }
    .button.remove-image {
        margin-left: 10px;
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
 * Remove default appearance menu items
 */
function lanier_plumbing_remove_appearance_menus() {
    global $submenu, $menu;
    
    // Remove the entire Appearance menu
    remove_menu_page('themes.php');
    
    // If somehow submenu items still exist, remove them individually
    if (isset($submenu['themes.php'])) {
        unset($submenu['themes.php']);
    }
}
add_action('admin_menu', 'lanier_plumbing_remove_appearance_menus', 999);

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
    ?>
    <div class="wrap lanier-plumbing-dashboard">
        <h1>Welcome to Lanier Plumbing</h1>
        <div class="about-text">
            Manage your plumbing website's content, settings, and appearance from this central dashboard.
        </div>

        <div class="dashboard-grid">
            <div class="card">
                <h2><span class="dashicons dashicons-admin-generic"></span> Quick Settings</h2>
                <div class="card-content">
                    <ul class="settings-overview">
                        <li>
                            <strong>Business Name:</strong> 
                            <?php echo esc_html(lanier_plumbing_get_option('business_name', 'Not set')); ?>
                        </li>
                        <li>
                            <strong>Phone:</strong> 
                            <?php echo esc_html(lanier_plumbing_get_option('business_phone', 'Not set')); ?>
                        </li>
                        <li>
                            <strong>Email:</strong> 
                            <?php echo esc_html(lanier_plumbing_get_option('business_email', 'Not set')); ?>
                        </li>
                    </ul>
                    <a href="<?php echo admin_url('admin.php?page=lanier-plumbing-settings'); ?>" class="button button-primary">
                        Manage Settings
                    </a>
                </div>
            </div>

            <div class="card">
                <h2><span class="dashicons dashicons-admin-tools"></span> Services</h2>
                <div class="card-content">
                    <p>Manage your plumbing services and pricing.</p>
                    <div class="button-group">
                        <a href="<?php echo admin_url('post-new.php?post_type=service'); ?>" class="button">Add New Service</a>
                        <a href="<?php echo admin_url('edit.php?post_type=service'); ?>" class="button">View All Services</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <h2><span class="dashicons dashicons-testimonial"></span> Testimonials</h2>
                <div class="card-content">
                    <p>Manage customer testimonials and reviews.</p>
                    <div class="button-group">
                        <a href="<?php echo admin_url('post-new.php?post_type=testimonial'); ?>" class="button">Add New Testimonial</a>
                        <a href="<?php echo admin_url('edit.php?post_type=testimonial'); ?>" class="button">View All Testimonials</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <h2><span class="dashicons dashicons-share"></span> Social Media</h2>
                <div class="card-content">
                    <ul class="social-overview">
                        <?php
                        $social_platforms = array(
                            'facebook' => 'Facebook',
                            'instagram' => 'Instagram',
                            'twitter' => 'Twitter',
                            'linkedin' => 'LinkedIn',
                            'youtube' => 'YouTube',
                            'yelp' => 'Yelp'
                        );
                        foreach ($social_platforms as $key => $label) {
                            $url = lanier_plumbing_get_option('social_' . $key);
                            echo '<li class="' . ($url ? 'active' : 'inactive') . '">';
                            echo '<span class="dashicons dashicons-' . ($url ? 'yes' : 'no') . '"></span> ';
                            echo esc_html($label);
                            echo '</li>';
                        }
                        ?>
                    </ul>
                    <a href="<?php echo admin_url('admin.php?page=lanier-plumbing-settings#social-media'); ?>" class="button">
                        Manage Social Links
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
    .lanier-plumbing-dashboard {
        max-width: 1200px;
    }
    .about-text {
        margin: 1em 0;
        min-height: 60px;
        color: #555d66;
        font-size: 16px;
    }
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    .card {
        background: #fff;
        border: 1px solid #ccd0d4;
        border-radius: 5px;
    }
    .card h2 {
        margin: 0;
        padding: 15px 20px;
        border-bottom: 1px solid #ccd0d4;
        font-size: 16px;
        display: flex;
        align-items: center;
    }
    .card h2 .dashicons {
        margin-right: 8px;
        color: #0073aa;
    }
    .card-content {
        padding: 20px;
    }
    .settings-overview, .social-overview {
        margin: 0 0 20px 0;
        padding: 0;
        list-style: none;
    }
    .settings-overview li, .social-overview li {
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f0f0f0;
    }
    .social-overview li {
        display: flex;
        align-items: center;
    }
    .social-overview li.active .dashicons {
        color: #46b450;
    }
    .social-overview li.inactive .dashicons {
        color: #dc3232;
    }
    .button-group {
        display: flex;
        gap: 10px;
    }
    </style>
    <?php
}

/**
 * Create the theme settings page
 */
function lanier_plumbing_add_settings_page() {
    add_theme_page(
        'Theme Settings',
        'Theme Settings',
        'manage_options',
        'lanier-plumbing-settings',
        'lanier_plumbing_settings_page_html'
    );
}
add_action('admin_menu', 'lanier_plumbing_add_settings_page');

/**
 * Helper function to get theme options
 */
function lanier_plumbing_get_option($key, $default = '') {
    $options = get_option('lanier_plumbing_options');
    return isset($options[$key]) ? $options[$key] : $default;
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

    // Enqueue our custom script
    wp_enqueue_script(
        'lanier-plumbing-admin',
        get_template_directory_uri() . '/js/admin.js',
        array('jquery'),
        '1.0.0',
        true
    );
}
add_action('admin_enqueue_scripts', 'lanier_plumbing_admin_scripts'); 