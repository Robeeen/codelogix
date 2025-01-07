<?php


//Adding Logo Size change Width option - 01.07.2025

add_action( 'customize_register', 'codelogix_customize_register' );

function codelogix_customize_register($wp_customize){
   $wp_customize->add_section('custom_logo_section', array(
       'title'       => __('Custom Logo Settings', 'your-theme-textdomain'),
       'priority'    => 30,
       'description' => __('Adjust the logo width dynamically.'),
   ));

   // Add setting for logo width
   $wp_customize->add_setting('custom_logo_width', array(
       'default'           => 200, // Default width
       'sanitize_callback' => 'absint', // Ensure it's an integer
       'transport'         => 'refresh',
   ));

   // Add control (input field) for logo width
   $wp_customize->add_control('custom_logo_width_control', array(
       'label'    => __('Logo Width (px)', 'your-theme-textdomain'),
       'section'  => 'custom_logo_section',
       'settings' => 'custom_logo_width',
       'type'     => 'number',
       'input_attrs' => array(
           'min'  => 50,  // Minimum width
           'max'  => 500, // Maximum width
           'step' => 10,  // Step value
       ),
   ));
}

function custom_logo_dynamic_css() {
   $logo_width = get_theme_mod('custom_logo_width', 200); // Get user-defined width
   ?>
   <style>
       .custom-logo {
           max-width: <?php echo esc_attr($logo_width); ?>px;
           height: auto;
       }
   </style>
   <?php
}
add_action('wp_head', 'custom_logo_dynamic_css');