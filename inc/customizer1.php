<?php
/**
 * codelogix Theme Customizer
 *
 * @package codelogix
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function codelogix_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'codelogix_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'codelogix_customize_partial_blogdescription',
			)
		);
	}


			
		// $wp_customize->add_section('codelogix_section', [
		// 	'title'     =>  __( 'Header Background', 'codelogix' ),
		// 	'priority'  =>  10,
		// 	'panel'     =>  'colors'
		// 	]);

		// /* Paragraph text */
		// $wp_customize->add_setting( 'header_background', array(
		// 	'default'           => '#444444',
		// 	'sanitize_callback' => 'sanitize_hex_color'
		// ) );
		// $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background', array(
		// 	'label'    => esc_html__( 'Header Background Colour', 'twentytwelve-child' ),
		// 	'section'  => 'colors',
		// 	'settings' => 'header_background',
		// 	'priority' => 10
		// ) ) );

	

	$wp_customize->add_section( 'custom_css', array(
		'title' => __( 'Custom CSS' ),
		'description' => __( 'Add custom CSS here' ),
		'panel' => '', // Not typically needed.
		'priority' => 160,
		'capability' => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
	  ) );


	  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'audio_control', array(
		'label' => _( 'Featured Home Page Recording' ),
		'section' => 'media',
		'mime_type' => 'audio',
	  ) ) );
}


/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function codelogix_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function codelogix_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function codelogix_customize_preview_js() {
	wp_enqueue_script( 'codelogix-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'codelogix_customize_preview_js' );


	
