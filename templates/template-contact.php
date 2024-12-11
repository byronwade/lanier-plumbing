<?php
/**
 * Template Name: Contact Page
 * 
 * @package Lanier_Plumbing
 */

get_header();

// Get business info
$phone = get_option('lanier_plumbing_options')['business_phone'] ?? '(770) 555-0123';
?>

<main id="primary" class="site-main">
    <div class="container max-w-5xl px-4 pt-12 pb-32 mx-auto">
        <div class="space-y-16">
            <header class="space-y-8 text-center">
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl md:text-6xl">Contact us</h1>
                <div class="space-y-4">
                    <p class="text-3xl font-semibold text-red-600 sm:text-4xl md:text-5xl">
                        <?php echo esc_html($phone); ?>
                    </p>
                    <p class="text-xl text-gray-500">Call or text us anytime</p>
                    <p class="text-gray-500">Mon - Fri 8:00 AM - 6:00 PM EST</p>
                </div>
                <div class="flex flex-col justify-center space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                    <a href="tel:<?php echo esc_attr($phone); ?>" class="inline-flex items-center justify-center h-14 px-8 text-lg font-medium text-white transition-colors rounded-md bg-red-600 hover:bg-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 mr-2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                        Call Now
                    </a>
                    <a href="sms:<?php echo esc_attr($phone); ?>" class="inline-flex items-center justify-center h-14 px-8 text-lg font-medium text-red-600 transition-colors border border-red-600 rounded-md hover:bg-red-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 mr-2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                        Text Us
                    </a>
                </div>
            </header>

            <div class="space-y-8">
                <h2 class="text-2xl font-semibold text-center sm:text-3xl">Or fill out our contact form</h2>
                <form class="space-y-6" method="post">
                    <div class="space-y-2">
                        <label class="font-medium text-base" for="service">How Can We Help?</label>
                        <select id="service" name="service" class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-1 focus:ring-ring disabled:cursor-not-allowed disabled:opacity-50">
                            <option value="">Select a service</option>
                            <option value="emergency">Emergency Plumbing</option>
                            <option value="repair">Repair Service</option>
                            <option value="installation">New Installation</option>
                            <option value="maintenance">Maintenance</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-2">
                            <label class="font-medium text-base" for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName" class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50" placeholder="Enter your first name">
                        </div>
                        <div class="space-y-2">
                            <label class="font-medium text-base" for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50" placeholder="Enter your last name">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-2">
                            <label class="font-medium text-base" for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50" placeholder="Enter your email">
                        </div>
                        <div class="space-y-2">
                            <label class="font-medium text-base" for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50" placeholder="Enter your phone number">
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label class="font-medium text-base" for="address">Street Address</label>
                            <input type="text" id="address" name="address[line1]" class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50" placeholder="Street address or P.O. Box">
                        </div>
                        <div class="space-y-2">
                            <label class="font-medium text-base" for="address2">Apt, Suite, Unit (Optional)</label>
                            <input type="text" id="address2" name="address[line2]" class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50" placeholder="Apartment, suite, unit, etc.">
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                            <div class="space-y-2">
                                <label class="font-medium text-base" for="city">City</label>
                                <input type="text" id="city" name="address[city]" class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50" placeholder="City">
                            </div>
                            <div class="space-y-2">
                                <label class="font-medium text-base" for="state">State</label>
                                <input type="text" id="state" name="address[state]" class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50" placeholder="State">
                            </div>
                            <div class="space-y-2">
                                <label class="font-medium text-base" for="zip">ZIP Code</label>
                                <input type="text" id="zip" name="address[postalCode]" class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50" placeholder="ZIP Code">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="font-medium text-base" for="message">Message</label>
                        <textarea id="message" name="message" rows="4" class="w-full min-h-[120px] p-3 rounded-md border border-input bg-background text-sm" placeholder="Enter your message here..."></textarea>
                    </div>

                    <div class="flex justify-center">
                        <button type="submit" class="inline-flex items-center justify-center h-14 px-8 text-lg font-medium text-white transition-colors rounded-md bg-red-600 hover:bg-red-700">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
get_footer(); 