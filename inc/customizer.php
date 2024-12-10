<?php
/**
 * Lanier Plumbing Theme Customizer
 *
 * @package Lanier_Plumbing
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function lanier_plumbing_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'lanier_plumbing_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'lanier_plumbing_customize_partial_blogdescription',
			)
		);
	}

	// Add Footer Section
	$wp_customize->add_section('footer_settings', array(
		'title' => __('Footer Settings', 'lanier-plumbing'),
		'priority' => 120,
	));

	// Footer Description
	$wp_customize->add_setting('footer_description', array(
		'default' => 'Your trusted neighborhood plumber serving Cherokee Counties and beyond.',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('footer_description', array(
		'label' => __('Footer Description', 'lanier-plumbing'),
		'section' => 'footer_settings',
		'type' => 'textarea',
	));

	// Business Information
	$wp_customize->add_setting('business_address', array(
		'default' => '1234 Plumber Lane, Cherokee County, GA 12345',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('business_address', array(
		'label' => __('Business Address', 'lanier-plumbing'),
		'section' => 'footer_settings',
		'type' => 'text',
	));

	$wp_customize->add_setting('business_phone', array(
		'default' => '+18005551234',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('business_phone', array(
		'label' => __('Phone Number (for link)', 'lanier-plumbing'),
		'section' => 'footer_settings',
		'type' => 'text',
	));

	$wp_customize->add_setting('business_phone_display', array(
		'default' => '1-800-555-1234',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control('business_phone_display', array(
		'label' => __('Phone Number (display)', 'lanier-plumbing'),
		'section' => 'footer_settings',
		'type' => 'text',
	));

	$wp_customize->add_setting('business_email', array(
		'default' => 'info@lanierplumbing.com',
		'sanitize_callback' => 'sanitize_email',
	));

	$wp_customize->add_control('business_email', array(
		'label' => __('Email Address', 'lanier-plumbing'),
		'section' => 'footer_settings',
		'type' => 'email',
	));

	// Social Media Links
	$wp_customize->add_setting('social_facebook', array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('social_facebook', array(
		'label' => __('Facebook URL', 'lanier-plumbing'),
		'section' => 'footer_settings',
		'type' => 'url',
	));

	$wp_customize->add_setting('social_instagram', array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('social_instagram', array(
		'label' => __('Instagram URL', 'lanier-plumbing'),
		'section' => 'footer_settings',
		'type' => 'url',
	));

	$wp_customize->add_setting('social_twitter', array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('social_twitter', array(
		'label' => __('Twitter URL', 'lanier-plumbing'),
		'section' => 'footer_settings',
		'type' => 'url',
	));
}
add_action( 'customize_register', 'lanier_plumbing_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function lanier_plumbing_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function lanier_plumbing_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function lanier_plumbing_customize_preview_js() {
	wp_enqueue_script( 'lanier-plumbing-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'lanier_plumbing_customize_preview_js' );
