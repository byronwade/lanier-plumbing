<?php
/**
 * Template Name: Home Page
 * 
 * @package Lanier_Plumbing
 */

get_header();
?>

<main id="primary" class="site-main min-h-screen bg-white">
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-white">
        <div class="mx-auto max-w-7xl">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:w-full lg:max-w-2xl lg:pb-28 xl:pb-32">
                <svg class="absolute inset-y-0 right-0 hidden w-48 h-full text-white transform translate-x-1/2 lg:block" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="50,0 100,0 50,100 0,100"></polygon>
                </svg>
                <main class="px-4 mx-auto mt-10 max-w-7xl sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline"><?php echo esc_html(get_theme_mod('hero_title_1', 'Expert Plumbing Services')); ?></span>
                            <span class="block text-red-800 xl:inline"><?php echo esc_html(get_theme_mod('hero_title_2', 'You Can Trust')); ?></span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            <?php echo esc_html(get_theme_mod('hero_description', 'From leaky faucets to complete bathroom renovations, our team of skilled plumbers is ready to tackle any job, big or small.')); ?>
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="<?php echo esc_url(get_theme_mod('cta_primary_link', '/contact')); ?>" class="inline-flex items-center justify-center h-10 px-8 text-sm font-medium transition-colors bg-red-600 rounded-md shadow whitespace-nowrap focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground hover:bg-red-800">
                                    <?php echo esc_html(get_theme_mod('cta_primary_text', 'Get a Free Quote')); ?>
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="<?php echo esc_url(get_theme_mod('cta_secondary_link', '/services')); ?>" class="inline-flex items-center justify-center h-10 px-8 text-sm font-medium transition-colors border rounded-md shadow-sm whitespace-nowrap focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border-input bg-background hover:bg-accent hover:text-accent-foreground">
                                    <?php echo esc_html(get_theme_mod('cta_secondary_text', 'Our Services')); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="absolute inset-y-0 top-0 right-0 w-full h-full lg:w-1/2">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('full', array('class' => 'object-cover w-full h-full')); ?>
            <?php else : ?>
                <img alt="Plumber working on pipes" class="object-cover w-full h-full" src="<?php echo esc_url(get_theme_file_uri('assets/images/placeholder.jpg')); ?>" />
            <?php endif; ?>
        </div>
    </section>

    <!-- Fact Banner -->
    <div class="relative px-3 py-2 overflow-hidden text-white shadow-lg bg-gradient-to-r from-red-600 to-red-700 sm:py-3 sm:px-4">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1IiBoZWlnaHQ9IjUiPgo8cmVjdCB3aWR0aD0iNSIgaGVpZ2h0PSI1IiBmaWxsPSIjZmZmIiBmaWxsLW9wYWNpdHk9IjAuMSIvPgo8L3N2Zz4=')] opacity-20"></div>
        <div class="container relative mx-auto">
            <div class="flex items-center justify-center min-h-[4rem] sm:min-h-[4.5rem]">
                <p class="px-2 text-xs font-medium text-center sm:text-sm md:text-base lg:text-lg animate-fade-in-out sm:px-4" aria-live="polite" aria-atomic="true">
                    <?php echo esc_html(get_theme_mod('fact_banner_text', 'Ancient Egyptians used copper pipes for their irrigation systems as early as 2500 BC.')); ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Services Sections -->
    <?php
    $services = array(
        array(
            'icon' => 'house',
            'title' => 'Residential Plumbing Excellence',
            'description' => 'From quick fixes to complete home remodels, our expert team ensures your residential plumbing runs flawlessly.',
            'features' => array('Leak Detection & Repair', 'Fixture Installation & Upgrades', 'Drain Cleaning & Maintenance'),
            'image' => 'residential-plumbing.jpg',
            'link' => '/services#residential'
        ),
        array(
            'icon' => 'hard-hat',
            'title' => 'Residential New Construction',
            'description' => 'Build your dream home with confidence. Our expert plumbing solutions for new construction ensure efficient, long-lasting systems.',
            'features' => array('Custom Plumbing Design', 'Energy-Efficient Systems', 'Code Compliance & Permits'),
            'image' => 'new-construction.jpg',
            'link' => '/services#new-construction'
        ),
        array(
            'icon' => 'building2',
            'title' => 'Commercial Plumbing Solutions',
            'description' => 'Keep your business running smoothly with our comprehensive commercial plumbing services.',
            'features' => array('Code Compliance & Inspections', 'Water Conservation Solutions', 'Preventive Maintenance Plans'),
            'image' => 'commercial-plumbing.jpg',
            'link' => '/services#commercial'
        )
    );

    foreach ($services as $index => $service) :
    ?>
        <section class="flex items-center bg-gradient-to-br <?php echo $index % 2 == 0 ? 'from-red-50 to-pink-50' : 'from-red-50 to-orange-50'; ?>">
            <div class="container px-4 py-12 mx-auto max-w-7xl md:py-24">
                <div class="grid items-center gap-8 lg:grid-cols-2 lg:gap-16">
                    <div class="order-2 <?php echo $index % 2 == 0 ? 'lg:order-1' : 'lg:order-2'; ?>">
                        <div class="inline-flex items-center justify-center p-3 mb-6 bg-red-100 rounded-full">
                            <i data-lucide="<?php echo esc_attr($service['icon']); ?>" class="w-8 h-8 text-red-600"></i>
                        </div>
                        <h2 class="mb-4 text-3xl font-bold text-gray-800 md:text-4xl lg:mb-6"><?php echo esc_html($service['title']); ?></h2>
                        <p class="mb-6 text-lg leading-relaxed text-gray-600 md:text-xl lg:mb-8"><?php echo esc_html($service['description']); ?></p>
                        <ul class="mb-6 space-y-3 lg:mb-8">
                            <?php foreach ($service['features'] as $feature) : ?>
                                <li class="flex items-center gap-3">
                                    <i data-lucide="arrow-right" class="flex-shrink-0 w-5 h-5 text-red-600"></i>
                                    <span class="text-base md:text-lg"><?php echo esc_html($feature); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="flex flex-col gap-4 sm:flex-row sm:gap-6">
                            <a href="tel:<?php echo esc_attr(get_theme_mod('business_phone', '5551234567')); ?>">
                                <button class="inline-flex items-center justify-center h-10 px-8 text-sm font-medium transition-colors bg-red-600 rounded-md shadow whitespace-nowrap focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground hover:bg-red-800">
                                    <i data-lucide="phone" class="w-4 h-4 mr-2"></i>
                                    <span class="min-w-[7rem]"><?php echo esc_html(get_theme_mod('business_phone_display', '(555) 123-4567')); ?></span>
                                </button>
                            </a>
                            <a href="<?php echo esc_url($service['link']); ?>">
                                <button class="inline-flex items-center justify-center h-10 px-8 text-sm font-medium transition-colors border rounded-md shadow-sm whitespace-nowrap focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border-input bg-background hover:bg-accent hover:text-accent-foreground">
                                    View <?php echo esc_html(str_replace('Plumbing ', '', $service['title'])); ?> Services
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="order-1 <?php echo $index % 2 == 0 ? 'lg:order-2' : 'lg:order-1'; ?>">
                        <div class="relative h-[300px] md:h-[400px] lg:h-[600px] rounded-3xl overflow-hidden shadow-2xl">
                            <img alt="<?php echo esc_attr($service['title']); ?>" class="object-cover w-full h-full" src="<?php echo esc_url(get_theme_file_uri('assets/images/' . $service['image'])); ?>" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endforeach; ?>

    <!-- Portfolio Section -->
    <section class="relative py-16 overflow-hidden text-gray-100 bg-gray-900 md:pt-20 md:pb-32">
        <canvas class="absolute inset-0 z-0 opacity-40" aria-hidden="true"></canvas>
        <div class="container relative z-10 px-4 mx-auto">
            <div class="flex items-center justify-center mb-4">
                <i data-lucide="wrench" class="mr-2 text-red-500"></i>
                <span class="font-semibold tracking-wider text-red-500 uppercase">Our Work</span>
            </div>
            <h2 class="mb-4 text-3xl font-bold text-center text-white md:text-4xl lg:text-5xl">
                We Offer Cost Efficient<br>Plumbing Services
            </h2>
            <p class="max-w-2xl mx-auto mb-8 text-xl text-center text-gray-300 md:mb-12">
                Professional solutions for all your plumbing needs, saving you time and money
            </p>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                <?php
                $portfolio_items = array(
                    'Pipe repair',
                    'Drain cleaning',
                    'Water heater installation',
                    'Fixture installation',
                    'Leak detection'
                );

                foreach ($portfolio_items as $item) :
                ?>
                    <div class="relative overflow-hidden rounded-lg aspect-square group">
                        <img alt="<?php echo esc_attr($item); ?>" class="transition-transform duration-300 group-hover:scale-110" src="<?php echo esc_url(get_theme_file_uri('assets/images/placeholder.jpg')); ?>" />
                        <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100">
                            <span class="px-2 text-lg font-semibold text-center text-white"><?php echo esc_html($item); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <div class="w-full py-12 bg-white md:py-24">
        <div class="container px-4 md:px-6 mx-auto max-w-[800px]">
            <div class="flex flex-col items-center justify-center space-y-4 text-center">
                <div class="inline-block px-3 py-1 text-sm text-white bg-black rounded-full">FAQ</div>
                <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl">Common Questions & Answers</h2>
                <p class="text-gray-500 md:text-lg max-w-[700px]">Find out all the essential details about our plumbing services.</p>
            </div>
            <div class="mt-12 space-y-8">
                <?php
                $faqs = array(
                    array(
                        'question' => 'What plumbing services do you offer?',
                        'answer' => 'We offer a comprehensive range of plumbing services including repairs, installations, maintenance, and emergency services for both residential and commercial properties.'
                    ),
                    array(
                        'question' => 'Do you offer emergency plumbing services?',
                        'answer' => 'Yes, we provide 24/7 emergency plumbing services for urgent issues that require immediate attention.'
                    ),
                    array(
                        'question' => 'Are your plumbers licensed and insured?',
                        'answer' => 'Yes, all our plumbers are fully licensed, insured, and undergo regular training to stay updated with the latest plumbing technologies and techniques.'
                    ),
                    array(
                        'question' => 'What areas do you serve?',
                        'answer' => 'We serve the entire metropolitan area and surrounding suburbs. Contact us to confirm if we service your location.'
                    )
                );

                foreach ($faqs as $index => $faq) :
                ?>
                    <div class="flex space-x-4">
                        <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 font-semibold text-gray-500 bg-gray-100 rounded-md">
                            <?php echo esc_html($index + 1); ?>
                        </div>
                        <div class="flex-grow space-y-2">
                            <h3 class="text-lg font-semibold"><?php echo esc_html($faq['question']); ?></h3>
                            <p class="text-gray-500"><?php echo esc_html($faq['answer']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <section class="relative py-12 overflow-hidden bg-red-100 border-red-200 shadow-sm border-y">
        <div class="absolute inset-0 z-0 opacity-50" style="background-image: url('<?php echo esc_url(get_theme_file_uri('assets/images/pattern.svg')); ?>');"></div>
        <div class="relative z-10 flex flex-col items-center justify-between w-full px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 md:flex-row">
            <div class="w-full mb-6 text-center md:text-left md:w-auto">
                <h2 class="mb-2 text-2xl font-bold text-red-800"><?php echo esc_html(get_bloginfo('name')); ?></h2>
                <p class="mb-4 text-lg text-red-700">Expert solutions for all your plumbing needs</p>
                <div class="flex flex-col items-center space-y-2 md:flex-row md:items-start md:space-y-0 md:space-x-4">
                    <div class="flex items-center">
                        <i data-lucide="clock" class="w-5 h-5 mr-2 text-red-600"></i>
                        <span class="text-sm text-red-700">24/7 Service</span>
                    </div>
                    <div class="flex items-center">
                        <i data-lucide="shield" class="w-5 h-5 mr-2 text-red-600"></i>
                        <span class="text-sm text-red-700">Licensed & Insured</span>
                    </div>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <a href="tel:<?php echo esc_attr(get_theme_mod('business_phone', '5551234567')); ?>">
                    <button class="inline-flex items-center justify-center px-8 py-6 text-lg font-medium text-white transition-transform bg-red-600 rounded-md shadow-lg whitespace-nowrap focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 h-9 hover:bg-red-700 hover:scale-105">
                        <i data-lucide="phone" class="w-6 h-6 mr-2"></i>
                        <?php echo esc_html(get_theme_mod('business_phone_display', '(555) 123-4567')); ?>
                    </button>
                </a>
                <a class="mt-2 text-sm text-red-600 underline hover:text-red-800" href="<?php echo esc_url(home_url('/contact')); ?>">
                    Contact Us
                </a>
            </div>
        </div>
    </section>
</main>

<script>
    // Initialize Lucide icons
    lucide.createIcons();
</script>

<?php get_footer(); ?> 