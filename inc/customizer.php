<?php


//Adding Logo Size change Width option - 01.07.2025

add_action( 'customize_register', 'codelogix_customize_register' );

function codelogix_customize_register($wp_customize){
   $wp_customize->add_section('custom_logo_section', array(
       'title'       => __('Custom Logo Settings', 'codelogix'),
       'priority'    => 30,
       'description' => __('Adjust the logo width dynamically.'),
   ));

   // Add setting for logo width
   $wp_customize->add_setting('custom_logo_width', array(
       'default'           => 200, // Default width
       'sanitize_callback' => 'absint', // Ensure it's an integer
       'transport'         => 'refresh',
   ));

    // Add setting for Padding top-bottom
    $wp_customize->add_setting('custom_logo_padding', array(
        'default'           => 5, // Default width
        'sanitize_callback' => 'absint', // Ensure it's an integer
        'transport'         => 'refresh',
    ));

   // Add control (input field) for logo width
   $wp_customize->add_control('custom_logo_width_control', array(
       'label'    => __('Logo Width (px)', 'codelogix'),
       'section'  => 'custom_logo_section',
       'settings' => 'custom_logo_width',
       'type'     => 'number',
       'input_attrs' => array(
           'min'  => 50,  // Minimum width
           'max'  => 500, // Maximum width
           'step' => 10,  // Step value
       ),
   ));

   // Add control (input field) for Paddding of Logo
   $wp_customize->add_control('custom_logo_padding_control', array(
    'label'    => __('Logo Padding (px)', 'codelogix'),
    'section'  => 'custom_logo_section',
    'settings' => 'custom_logo_padding',
    'type'     => 'number',
    'input_attrs' => array(
        'min'  => 5,  // Minimum width
        'max'  => 100, // Maximum width
        'step' => 1,  // Step value
    ),
));


}


//Apply the Custom Width + Padding to the Logo via CSS
function custom_logo_dynamic_css() {
   $logo_width = get_theme_mod('custom_logo_width', 200); // Get user-defined width
   $logo_padding = get_theme_mod('custom_logo_padding', 200); //Get user-defined padding
   ?>
   <style>
       .custom-logo {
           max-width: <?php echo esc_attr($logo_width); ?>px;
           height: auto;
           padding-top: <?php echo esc_attr($logo_padding); ?>px;
           padding-bottom: <?php echo esc_attr($logo_padding); ?>px;
       }
   </style>
   <?php
}
add_action('wp_head', 'custom_logo_dynamic_css');


//Custom Header Background COLOR 

add_action( 'customize_register', 'codelogix_customize_header_color' );

function codelogix_customize_header_color($wp_customize){

    $wp_customize->add_section('codelogix_section', [
        'title'     =>  __( 'Header Background', 'codelogix' ),
        'priority'  =>  30,
        'description' => __('Change Header Bckground.'),
        ]);

    /* Paragraph text */
    $wp_customize->add_setting( 'header_background', array(
        'default'           => '#444444',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background', array(
        'label'    => esc_html__( 'Header Background Color', 'codelogix' ),
        'section'  => 'codelogix_section',
        'settings' => 'header_background',
        'priority' => 10
    ) ) );

}

//Apply the Custom Header Background COLOR via CSS
function custom_header_color_css() {
    $background_color = get_theme_mod('header_background', 200); // Get user-defined width
    ?>
    <style>
        #masthead {
            background: <?php echo esc_attr($background_color);?>;            
        }
    </style>
    <?php
 }
 add_action('wp_head', 'custom_header_color_css');


 