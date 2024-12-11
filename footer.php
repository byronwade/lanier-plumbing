<?php
/**
 * The template for displaying the footer
 *
 * @package Lanier_Plumbing
 */
?>

	<footer class="py-8 text-gray-700 bg-gray-100">
		<div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
			<div class="grid grid-cols-1 gap-8 md:grid-cols-3">
				<div>
					<h3 class="mb-4 text-lg font-semibold"><?php echo esc_html(lanier_plumbing_get_option('business_name', 'Lanier Plumbing')); ?></h3>
					<p class="text-sm"><?php echo esc_html(lanier_plumbing_get_option('business_tagline', 'Your trusted neighborhood plumber serving Cherokee Counties and beyond.')); ?></p>
				</div>
				
				<div>
					<h3 class="mb-4 text-lg font-semibold">Quick Links</h3>
					<?php
					wp_nav_menu(array(
						'theme_location' => 'footer-menu',
						'menu_class' => 'space-y-2',
						'container' => false,
						'items_wrap' => '<ul class="%2$s">%3$s</ul>',
						'walker' => new Tailwind_Nav_Walker(),
						'fallback_cb' => function() {
							echo '<ul class="space-y-2">';
							echo '<li><a class="text-sm transition-colors hover:text-red-600" href="/">Home</a></li>';
							echo '<li><a class="text-sm transition-colors hover:text-red-600" href="/lanier-plumbing-services">Services</a></li>';
							echo '<li><a class="text-sm transition-colors hover:text-red-600" href="/expert-plumbing-tips">Expert Tips</a></li>';
							echo '<li><a class="text-sm transition-colors hover:text-red-600" href="/about-lanier-plumbing">About Us</a></li>';
							echo '</ul>';
						}
					));
					?>
				</div>

				<div>
					<h3 class="mb-4 text-lg font-semibold">Contact Us</h3>
					<p class="mb-2 text-sm"><?php echo esc_html(lanier_plumbing_get_option('business_address', '1234 Plumber Lane, Cherokee County, GA 12345')); ?></p>
					<p class="mb-2 text-sm">
						 Phone: 
						<a href="tel:<?php echo esc_attr(lanier_plumbing_get_option('business_phone', '+18005551234')); ?>" class="transition-colors hover:text-red-600">
							<?php echo esc_html(lanier_plumbing_get_option('business_phone', '1-800-555-1234')); ?>
						</a>
					</p>
					<p class="mb-4 text-sm">
						 Email: 
						<a href="mailto:<?php echo esc_attr(lanier_plumbing_get_option('business_email', 'info@lanierplumbing.com')); ?>" class="transition-colors hover:text-red-600">
							<?php echo esc_html(lanier_plumbing_get_option('business_email', 'info@lanierplumbing.com')); ?>
						</a>
					</p>
					<div class="flex space-x-4">
						<?php if (lanier_plumbing_get_option('social_facebook')) : ?>
							<a href="<?php echo esc_url(lanier_plumbing_get_option('social_facebook')); ?>" class="text-gray-500 transition-colors hover:text-red-600">
								<i data-lucide="facebook" class="w-5 h-5"></i>
								<span class="sr-only">Facebook</span>
							</a>
						<?php endif; ?>

						<?php if (lanier_plumbing_get_option('social_instagram')) : ?>
							<a href="<?php echo esc_url(lanier_plumbing_get_option('social_instagram')); ?>" class="text-gray-500 transition-colors hover:text-red-600">
								<i data-lucide="instagram" class="w-5 h-5"></i>
								<span class="sr-only">Instagram</span>
							</a>
						<?php endif; ?>

						<?php if (lanier_plumbing_get_option('social_twitter')) : ?>
							<a href="<?php echo esc_url(lanier_plumbing_get_option('social_twitter')); ?>" class="text-gray-500 transition-colors hover:text-red-600">
								<i data-lucide="twitter" class="w-5 h-5"></i>
								<span class="sr-only">Twitter</span>
							</a>
						<?php endif; ?>

						<?php if (lanier_plumbing_get_option('social_linkedin')) : ?>
							<a href="<?php echo esc_url(lanier_plumbing_get_option('social_linkedin')); ?>" class="text-gray-500 transition-colors hover:text-red-600">
								<i data-lucide="linkedin" class="w-5 h-5"></i>
								<span class="sr-only">LinkedIn</span>
							</a>
						<?php endif; ?>

						<?php if (lanier_plumbing_get_option('social_youtube')) : ?>
							<a href="<?php echo esc_url(lanier_plumbing_get_option('social_youtube')); ?>" class="text-gray-500 transition-colors hover:text-red-600">
								<i data-lucide="youtube" class="w-5 h-5"></i>
								<span class="sr-only">YouTube</span>
							</a>
						<?php endif; ?>

						<?php if (lanier_plumbing_get_option('social_yelp')) : ?>
							<a href="<?php echo esc_url(lanier_plumbing_get_option('social_yelp')); ?>" class="text-gray-500 transition-colors hover:text-red-600">
								<i data-lucide="star" class="w-5 h-5"></i>
								<span class="sr-only">Yelp</span>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<div class="pt-8 mt-8 text-sm text-center border-t border-gray-200">
				<p>&copy; <?php echo date('Y'); ?> <?php echo esc_html(lanier_plumbing_get_option('business_name', 'Lanier Plumbing')); ?>. All rights reserved.</p>
				<?php if (WP_DEBUG) : ?>
					<!-- Debug icon to test Lucide initialization -->
					<div class="mt-2 text-gray-500">
						<?php echo wp_kses_post('<i data-lucide="check" class="w-5 h-5 inline-block"></i>'); ?>
						<span class="ml-2">Icon Test</span>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
