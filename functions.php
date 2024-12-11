<?php
/**
 * Lanier Plumbing functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Lanier_Plumbing
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lanier_plumbing_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Lanier Plumbing, use a find and replace
		* to change 'lanier-plumbing' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'lanier-plumbing', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'lanier-plumbing' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'lanier-plumbing' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'lanier_plumbing_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	add_theme_support('editor-styles');
	add_editor_style(array(
		'css/tailwind.css',
		'css/block-editor.css',
		'css/blocks.css'
	));
}
add_action( 'after_setup_theme', 'lanier_plumbing_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lanier_plumbing_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lanier_plumbing_content_width', 640 );
}
add_action( 'after_setup_theme', 'lanier_plumbing_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lanier_plumbing_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'lanier-plumbing' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'lanier-plumbing' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'lanier_plumbing_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function lanier_plumbing_scripts() {
	// Enqueue compiled Tailwind CSS
	wp_enqueue_style('lanier-plumbing-styles', get_template_directory_uri() . '/css/style.css', array(), _S_VERSION);
	
	// Then enqueue theme styles that may override Tailwind
	wp_enqueue_style('lanier-plumbing-theme', get_stylesheet_uri(), array('lanier-plumbing-styles'), _S_VERSION);
	wp_style_add_data('lanier-plumbing-theme', 'rtl', 'replace');

	wp_enqueue_script('lanier-plumbing-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('lanier-plumbing-mobile-menu', get_template_directory_uri() . '/js/mobile-menu.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	// Enqueue Lucide icons
	wp_enqueue_script(
		'lucide-icons',
		'https://unpkg.com/lucide@latest',
		array(),
		null,
		true
	);

	// Add inline script to initialize Lucide icons
	wp_add_inline_script('lucide-icons', 'lucide.createIcons();');

	// Enqueue our icons initialization script
	wp_enqueue_script(
		'lanier-icons',
		get_template_directory_uri() . '/js/icons.js',
		array('lucide'),
		_S_VERSION,
		true
	);
}
add_action('wp_enqueue_scripts', 'lanier_plumbing_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Include the custom nav walker
 */
require get_template_directory() . '/inc/class-tailwind-nav-walker.php';

/**
 * Include theme settings
 */
require get_template_directory() . '/inc/theme-settings.php';

/**
 * Enqueue Inter font
 */
function lanier_plumbing_enqueue_fonts() {
    wp_enqueue_style(
        'inter-font',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );

    // Add Inter font to body
    $custom_css = "
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;
        }
    ";
    wp_add_inline_style('inter-font', $custom_css);
}
add_action('wp_enqueue_scripts', 'lanier_plumbing_enqueue_fonts');

/**
 * Get business info
 */
function lanier_plumbing_get_business_info($key = '', $default = '') {
    $options = get_option('lanier_plumbing_options');
    return isset($options[$key]) ? $options[$key] : $default;
}

/**
 * Include custom post types
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Remove default block styles and patterns
 */
function remove_default_block_styles() {
    // Keep these commented out for now until we're sure our styles work
    // wp_dequeue_style('wp-block-library');
    // wp_dequeue_style('wp-block-library-theme');
    // wp_dequeue_style('wp-block-editor');
    // wp_dequeue_style('wp-block-style');
}
add_action('wp_enqueue_scripts', 'remove_default_block_styles');

function remove_default_editor_styles() {
    // Keep these commented out for now until we're sure our styles work
    // wp_dequeue_style('wp-block-editor');
    // wp_dequeue_style('wp-block-library');
    // wp_dequeue_style('wp-block-library-theme');
    // wp_dequeue_style('wp-block-style');
}
add_action('enqueue_block_editor_assets', 'remove_default_editor_styles');

// Disable core block patterns
remove_theme_support('core-block-patterns');

// Remove default global styles
remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');

/**
 * Hide block editor interface for About template
 */
function lanier_plumbing_hide_editor_interface() {
    $post_id = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : '');
    if (!$post_id) return;

    $template_file = get_post_meta($post_id, '_wp_page_template', true);

    // Hide editor interface if page uses About template
    if ($template_file == 'templates/template-about.php') {
        add_action('admin_head', function() {
            echo '<style>
                /* Hide block editor interface but keep it functional */
                .block-editor-block-list__layout,
                .edit-post-visual-editor__post-title-wrapper,
                .block-editor-default-block-appender,
                .block-editor-block-list__empty-block-inserter {
                    display: none !important;
                }
                
                /* Style the meta box */
                .lanier-meta-box {
                    padding: 20px;
                    background: white;
                    border: 1px solid #ccd0d4;
                    box-shadow: 0 1px 1px rgba(0,0,0,.04);
                    margin-top: 20px;
                }
                .lanier-meta-box .meta-section {
                    margin-bottom: 30px;
                    padding-bottom: 20px;
                    border-bottom: 1px solid #eee;
                }
                .lanier-meta-box .meta-section:last-child {
                    border-bottom: none;
                    margin-bottom: 0;
                    padding-bottom: 0;
                }
                .lanier-meta-box .meta-section h3 {
                    margin: 0 0 15px 0;
                    padding: 0;
                    font-size: 14px;
                    color: #1d2327;
                }
                .lanier-meta-box label {
                    font-weight: 600;
                    margin-bottom: 5px;
                    display: block;
                    color: #1d2327;
                }
                .lanier-meta-box input[type="text"],
                .lanier-meta-box textarea {
                    width: 100%;
                    margin-bottom: 15px;
                    padding: 8px;
                    border: 1px solid #8c8f94;
                    border-radius: 4px;
                }
                .lanier-meta-box input[type="text"]:focus,
                .lanier-meta-box textarea:focus {
                    border-color: #2271b1;
                    box-shadow: 0 0 0 1px #2271b1;
                    outline: 2px solid transparent;
                }
                #about_page_fields {
                    margin-top: 20px;
                }
                #about_page_fields .postbox-header {
                    background: #2271b1;
                    border-bottom: 0;
                }
                #about_page_fields .hndle {
                    color: white;
                }
                #about_page_fields {
                    border: none;
                    box-shadow: none;
                }
                #about_page_fields .inside {
                    padding: 0;
                    margin: 0;
                }
                .upload-preview {
                    max-width: 200px;
                    margin: 10px 0;
                    border-radius: 4px;
                    border: 1px solid #ddd;
                }
                #upload_team_image_button {
                    margin-top: 10px;
                }
                
                /* Move meta box to top of editor */
                .edit-post-layout__metaboxes {
                    margin-top: 0 !important;
                }
                .edit-post-meta-boxes-area {
                    margin-top: 0 !important;
                }
            </style>';
        });
    }
}
add_action('admin_init', 'lanier_plumbing_hide_editor_interface');

/**
 * Add custom fields for About Us page
 */
function lanier_plumbing_add_about_meta_box() {
    // Get the current post ID
    $post_id = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : '');
    
    // For new pages, check if the page template is being set
    $template = isset($_GET['page_template']) ? $_GET['page_template'] : '';
    
    // For existing pages, get the current template
    if ($post_id) {
        $template = get_post_meta($post_id, '_wp_page_template', true);
    }
    
    // Only add meta box if this is the About template
    if ($template === 'templates/template-about.php') {
        add_meta_box(
            'about_page_fields',
            'About Page Content',
            'lanier_plumbing_about_meta_box_html',
            'page',
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'lanier_plumbing_add_about_meta_box');

/**
 * Add custom message at the top of the About page template
 */
function lanier_plumbing_add_template_notice() {
    $screen = get_current_screen();
    if ($screen->id === 'page' && isset($_GET['post'])) {
        $template_file = get_post_meta($_GET['post'], '_wp_page_template', true);
        if ($template_file === 'templates/template-about.php') {
            echo '<div class="notice notice-info">
                <p><strong>About Page Template:</strong> Use the fields below to customize your About page content. These fields will automatically update the page layout.</p>
            </div>';
        }
    }
}
add_action('admin_notices', 'lanier_plumbing_add_template_notice');

function lanier_plumbing_about_meta_box_html($post) {
    $values = get_post_meta($post->ID);
    $hero_title = isset($values['hero_title']) ? esc_attr($values['hero_title'][0]) : '';
    $hero_description = isset($values['hero_description']) ? esc_attr($values['hero_description'][0]) : '';
    $mission_text = isset($values['mission_text']) ? esc_attr($values['mission_text'][0]) : '';
    $team_image = isset($values['team_image']) ? esc_attr($values['team_image'][0]) : '';
    $why_choose_title = isset($values['why_choose_title']) ? esc_attr($values['why_choose_title'][0]) : '';
    $why_choose_description = isset($values['why_choose_description']) ? esc_attr($values['why_choose_description'][0]) : '';
    $services_title = isset($values['services_title']) ? esc_attr($values['services_title'][0]) : '';
    $services_description = isset($values['services_description']) ? esc_attr($values['services_description'][0]) : '';
    $services_image = isset($values['services_image']) ? esc_attr($values['services_image'][0]) : '';
    
    wp_nonce_field('lanier_plumbing_about_meta_box', 'lanier_plumbing_about_meta_box_nonce');
    ?>
    <div class="lanier-meta-box">
        <!-- Hero Section -->
        <div class="meta-section">
            <h3>Hero Section</h3>
            <div class="field-group">
                <label for="hero_title">Title</label>
                <input type="text" id="hero_title" name="hero_title" value="<?php echo $hero_title; ?>" class="widefat">
            </div>
            <div class="field-group">
                <label for="hero_description">Description</label>
                <textarea id="hero_description" name="hero_description" class="widefat" rows="3"><?php echo $hero_description; ?></textarea>
            </div>
        </div>

        <!-- Mission Section -->
        <div class="meta-section">
            <h3>Mission Section</h3>
            <div class="field-group">
                <label for="mission_text">Mission Statement</label>
                <textarea id="mission_text" name="mission_text" class="widefat" rows="3"><?php echo $mission_text; ?></textarea>
            </div>
            <div class="field-group">
                <label for="team_image">Team Image</label>
                <div class="image-upload-wrap">
                    <input type="text" id="team_image" name="team_image" value="<?php echo $team_image; ?>" class="widefat">
                    <?php if ($team_image): ?>
                        <img src="<?php echo esc_url($team_image); ?>" class="upload-preview">
                    <?php endif; ?>
                    <button type="button" class="button button-primary upload-image-button" data-target="team_image">Upload Image</button>
                </div>
            </div>
        </div>

        <!-- Why Choose Us Section -->
        <div class="meta-section">
            <h3>Why Choose Us Section</h3>
            <div class="field-group">
                <label for="why_choose_title">Section Title</label>
                <input type="text" id="why_choose_title" name="why_choose_title" value="<?php echo $why_choose_title; ?>" class="widefat">
            </div>
            <div class="field-group">
                <label for="why_choose_description">Section Description</label>
                <textarea id="why_choose_description" name="why_choose_description" class="widefat" rows="3"><?php echo $why_choose_description; ?></textarea>
            </div>
        </div>

        <!-- Services Section -->
        <div class="meta-section">
            <h3>Services Section</h3>
            <div class="field-group">
                <label for="services_title">Section Title</label>
                <input type="text" id="services_title" name="services_title" value="<?php echo $services_title; ?>" class="widefat">
            </div>
            <div class="field-group">
                <label for="services_description">Section Description</label>
                <textarea id="services_description" name="services_description" class="widefat" rows="3"><?php echo $services_description; ?></textarea>
            </div>
            <div class="field-group">
                <label for="services_image">Services Image</label>
                <div class="image-upload-wrap">
                    <input type="text" id="services_image" name="services_image" value="<?php echo $services_image; ?>" class="widefat">
                    <?php if ($services_image): ?>
                        <img src="<?php echo esc_url($services_image); ?>" class="upload-preview">
                    <?php endif; ?>
                    <button type="button" class="button button-primary upload-image-button" data-target="services_image">Upload Image</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .lanier-meta-box {
            padding: 20px;
            background: white;
            border: 1px solid #ccd0d4;
            box-shadow: 0 1px 1px rgba(0,0,0,.04);
        }
        .meta-section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .meta-section:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }
        .meta-section h3 {
            margin: 0 0 20px;
            padding: 0;
            font-size: 16px;
            font-weight: 600;
        }
        .field-group {
            margin-bottom: 20px;
        }
        .field-group:last-child {
            margin-bottom: 0;
        }
        .field-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .image-upload-wrap {
            margin-top: 10px;
        }
        .upload-preview {
            max-width: 200px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .upload-image-button {
            margin-top: 10px !important;
        }
    </style>

    <script>
    jQuery(document).ready(function($) {
        $('.upload-image-button').click(function() {
            var button = $(this);
            var targetInput = $('#' + button.data('target'));
            
            var custom_uploader = wp.media({
                title: 'Select Image',
                button: {
                    text: 'Use this image'
                },
                multiple: false
            }).on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                targetInput.val(attachment.url);
                
                // Update preview
                var previewWrap = button.closest('.image-upload-wrap');
                if (previewWrap.find('.upload-preview').length) {
                    previewWrap.find('.upload-preview').attr('src', attachment.url);
                } else {
                    targetInput.after('<img src="' + attachment.url + '" class="upload-preview">');
                }
            }).open();
        });
    });
    </script>
    <?php
}

function lanier_plumbing_save_about_meta_box($post_id) {
    if (!isset($_POST['lanier_plumbing_about_meta_box_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['lanier_plumbing_about_meta_box_nonce'], 'lanier_plumbing_about_meta_box')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = [
        'hero_title',
        'hero_description',
        'mission_text',
        'team_image',
        'why_choose_title',
        'why_choose_description',
        'services_title',
        'services_description',
        'services_image'
    ];

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'lanier_plumbing_save_about_meta_box');

