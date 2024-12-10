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
	// Enqueue Tailwind CSS first
	wp_enqueue_style('lanier-plumbing-tailwind', get_template_directory_uri() . '/css/tailwind.css', array(), _S_VERSION);
	
	// Then enqueue theme styles that may override Tailwind
	wp_enqueue_style('lanier-plumbing-style', get_stylesheet_uri(), array('lanier-plumbing-tailwind'), _S_VERSION);
	wp_style_add_data('lanier-plumbing-style', 'rtl', 'replace');

	wp_enqueue_script('lanier-plumbing-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('lanier-plumbing-mobile-menu', get_template_directory_uri() . '/js/mobile-menu.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	// Enqueue Lucide icons from CDN with specific version
	wp_enqueue_script(
		'lucide',
		'https://unpkg.com/lucide@latest/dist/umd/lucide.min.js',
		array(),
		'0.468.0',
		true
	);
	
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

