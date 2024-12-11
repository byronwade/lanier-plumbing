<?php
/**
 * Template Name: About Page
 * 
 * @package Lanier_Plumbing
 */

get_header();

// Get custom field values
$hero_title = get_post_meta(get_the_ID(), 'hero_title', true) ?: 'Reliable Plumbing Solutions for Lanier and Beyond';
$hero_description = get_post_meta(get_the_ID(), 'hero_description', true) ?: 'Lanier Plumbing provides expert plumbing services for residential and commercial properties. With our skilled team and state-of-the-art equipment, we ensure your plumbing needs are met efficiently and effectively.';
$mission_text = get_post_meta(get_the_ID(), 'mission_text', true) ?: 'At Lanier Plumbing, we\'re committed to providing top-notch plumbing services with integrity and professionalism. Our goal is to ensure every customer experiences the peace of mind that comes with reliable, high-quality plumbing solutions.';
$team_image = get_post_meta(get_the_ID(), 'team_image', true) ?: 'https://placehold.co/800x600';
$why_choose_title = get_post_meta(get_the_ID(), 'why_choose_title', true) ?: 'Why Choose Lanier Plumbing?';
$why_choose_description = get_post_meta(get_the_ID(), 'why_choose_description', true) ?: 'We pride ourselves on our expertise, reliability, and customer-first approach. Here\'s what sets us apart in the plumbing industry.';
?>

<section class="pt-12 pb-32">
    <div class="container flex flex-col mx-auto max-w-7xl gap-28">
        <!-- Hero Section -->
        <div class="flex flex-col gap-7">
            <h1 class="text-4xl font-semibold lg:text-7xl"><?php echo esc_html($hero_title); ?></h1>
            <p class="max-w-xl text-lg"><?php echo esc_html($hero_description); ?></p>
        </div>

        <!-- Mission Section -->
        <div class="grid gap-6 md:grid-cols-2">
            <img 
                alt="Lanier Plumbing team at work" 
                loading="lazy" 
                width="576" 
                height="144" 
                decoding="async" 
                data-nimg="1" 
                class="object-cover w-full h-96 rounded-2xl" 
                src="<?php echo esc_url($team_image); ?>" 
                style="color: transparent;"
            >
            <div class="flex flex-col justify-between gap-10 p-10 rounded-2xl bg-muted">
                <p class="text-sm text-muted-foreground">OUR MISSION</p>
                <p class="text-lg font-medium"><?php echo esc_html($mission_text); ?></p>
            </div>
        </div>

        <!-- Why Choose Us Section -->
        <div class="flex flex-col gap-6 md:gap-20">
            <div class="max-w-xl">
                <h2 class="mb-2.5 text-3xl font-semibold md:text-5xl"><?php echo esc_html($why_choose_title); ?></h2>
                <p class="text-muted-foreground"><?php echo esc_html($why_choose_description); ?></p>
            </div>

            <div class="grid gap-10 md:grid-cols-3">
                <!-- Expert Craftsmanship -->
                <div class="flex flex-col">
                    <div class="flex items-center justify-center mb-5 size-12 rounded-2xl bg-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wrench size-5">
                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                        </svg>
                    </div>
                    <h3 class="mt-2 mb-3 text-lg font-semibold">Expert Craftsmanship</h3>
                    <p class="text-muted-foreground">Our team of licensed plumbers brings years of experience and a commitment to quality workmanship to every job, ensuring lasting solutions for your plumbing needs.</p>
                </div>

                <!-- 24/7 Emergency Service -->
                <div class="flex flex-col">
                    <div class="flex items-center justify-center mb-5 size-12 rounded-2xl bg-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock size-5">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <h3 class="mt-2 mb-3 text-lg font-semibold">24/7 Emergency Service</h3>
                    <p class="text-muted-foreground">Plumbing emergencies don't wait for business hours. That's why we offer round-the-clock emergency services to address your urgent plumbing issues promptly.</p>
                </div>

                <!-- Guaranteed Satisfaction -->
                <div class="flex flex-col">
                    <div class="flex items-center justify-center mb-5 size-12 rounded-2xl bg-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check size-5">
                            <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path>
                            <path d="m9 12 2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="mt-2 mb-3 text-lg font-semibold">Guaranteed Satisfaction</h3>
                    <p class="text-muted-foreground">We stand behind our work with a satisfaction guarantee. If you're not completely satisfied with our service, we'll make it right - that's our promise to you.</p>
                </div>
            </div>
        </div>

        <!-- Services Overview -->
        <div class="grid gap-10 md:grid-cols-2">
            <div>
                <p class="mb-10 text-sm font-medium text-muted-foreground">OUR SERVICES</p>
                <h2 class="mb-2.5 text-3xl font-semibold md:text-5xl">Comprehensive Plumbing Solutions</h2>
            </div>
            <div>
                <img 
                    alt="Lanier Plumbing service showcase" 
                    loading="lazy" 
                    width="576" 
                    height="144" 
                    decoding="async" 
                    data-nimg="1" 
                    class="object-cover w-full mb-6 h-36 rounded-xl" 
                    src="https://placehold.co/800x200" 
                    style="color: transparent;"
                >
                <p class="text-muted-foreground">From routine maintenance to complex installations, Lanier Plumbing offers a full range of services to meet all your plumbing needs. Our expertise covers residential and commercial properties, ensuring top-quality solutions for every client.</p>
            </div>
        </div>
    </div>
</section>

<?php
get_footer(); 