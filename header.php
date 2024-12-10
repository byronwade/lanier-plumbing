<?php
/**
 * The header for our theme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo esc_html(lanier_plumbing_get_option('business_name', 'lanier-plumbing.com')); ?> | <?php bloginfo('description'); ?></title>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="sticky top-0 z-50 bg-white shadow-sm">
	<div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
		<div class="flex items-center justify-between h-16 sm:h-18">
			<div class="flex items-center">
				<?php 
				$logo_id = lanier_plumbing_get_option('site_logo');
				$business_name = lanier_plumbing_get_option('business_name', 'lanier-plumbing.com');
				if ($logo_id) : 
					$logo_url = wp_get_attachment_image_url($logo_id, 'full');
					if ($logo_url) :
				?>
					<a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center space-x-2 group">
						<img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($business_name); ?>" class="w-auto h-8 sm:h-10">
					</a>
					<?php endif; ?>
				<?php endif; ?>
				<a class="flex items-center space-x-2 group ml-2" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr($business_name); ?> - Home">
					<span class="text-base font-bold text-gray-900 transition-colors sm:text-lg group-hover:text-red-600"><?php echo esc_html($business_name); ?></span>
				</a>
			</div>

			<nav class="items-center hidden space-x-4 md:flex lg:space-x-6">
				<?php
				wp_nav_menu(array(
					'theme_location' => 'menu-1',
					'container' => false,
					'menu_class' => 'flex items-center space-x-4 lg:space-x-6',
					'fallback_cb' => false,
					'items_wrap' => '<ul class="%2$s">%3$s</ul>',
					'walker' => new Tailwind_Nav_Walker()
				));
				?>
			</nav>

			<div class="flex items-center space-x-2 md:space-x-4">
				<a href="tel:<?php echo esc_attr(lanier_plumbing_get_option('business_phone', '+18005551234')); ?>" 
				   class="bg-red-600 text-white hover:bg-red-700 text-sm px-3 py-1.5 rounded transition-colors flex items-center group focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" 
				   aria-label="Call us at <?php echo esc_attr(lanier_plumbing_get_option('business_phone', '1-800-555-1234')); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 transition-transform group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
					</svg>
					<span class="font-semibold md:hidden">Call</span>
					<span class="hidden font-semibold md:inline"><?php echo esc_html(lanier_plumbing_get_option('business_phone', '1-800-555-1234')); ?></span>
				</a>
				<button class="inline-flex items-center justify-center h-8 px-3 text-xs font-medium text-gray-700 transition-colors rounded-md menu-toggle whitespace-nowrap focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 hover:bg-gray-100 md:hidden" aria-controls="primary-menu" aria-expanded="false">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<line x1="4" x2="20" y1="12" y2="12"/>
						<line x1="4" x2="20" y1="6" y2="6"/>
						<line x1="4" x2="20" y1="18" y2="18"/>
					</svg>
					<span class="sr-only">Toggle menu</span>
				</button>
			</div>
		</div>
	</div>
	<div class="hidden py-2 text-gray-700 bg-gray-100 border-gray-200 border-y sm:block">
		<div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
			<div class="flex flex-wrap items-center justify-between text-xs gap-y-2 sm:text-sm">
				<div class="flex flex-wrap items-center gap-4">
					<div class="flex items-center">
						<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-red-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<circle cx="12" cy="12" r="10"/>
							<polyline points="12 6 12 12 16 14"/>
						</svg>
						<span><?php echo lanier_plumbing_get_formatted_hours(); ?></span>
					</div>
					<div class="flex items-center">
						<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-red-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/>
							<circle cx="12" cy="10" r="3"/>
						</svg>
						<span><?php echo esc_html(lanier_plumbing_get_option('service_area', 'Serving Cherokee Counties & Beyond')); ?></span>
					</div>
				</div>
				<div class="flex items-center">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-red-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
					</svg>
					<span><?php echo esc_html(lanier_plumbing_get_option('business_tagline', 'Your Trusted Neighborhood Humble Plumber')); ?></span>
				</div>
			</div>
		</div>
	</div>
</header>

<div id="content" class="site-content"><?php // Main content wrapper ?>
