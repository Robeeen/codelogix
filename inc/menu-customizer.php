<?php


/* -----------------Customize the Menu Font Size ---------------------------------*/

function custom_menu_font_size_customizer($wp_customize) {
    // Add a section for menu settings
    $wp_customize->add_section('custom_menu_section', array(
        'title'       => __('Menu Font Settings', 'your-theme-textdomain'),
        'priority'    => 30,
        'description' => __('Adjust the menu font size dynamically.'),
    ));

    // Add setting for menu font size
    $wp_customize->add_setting('menu_font_size', array(
        'default'           => 16, // Default font size in pixels
        'sanitize_callback' => 'absint', // Ensure it's an integer
        'transport'         => 'postMessage', // Allows live preview
    ));

    // Add control (input field) for menu font size
    $wp_customize->add_control('menu_font_size_control', array(
        'label'    => __('Menu Font Size (px)', 'codelogix'),
        'section'  => 'custom_menu_section',
        'settings' => 'menu_font_size',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 10,  // Minimum font size
            'max'  => 30,  // Maximum font size
            'step' => 1,   // Step value
        ),
    ));

/*----------Customisze the Menu Items Space -------------------------------------------- */


    // Add setting for menu items space
    $wp_customize->add_setting('menu_space', array(
        'default'           => 3, // Default font size in pixels
        'sanitize_callback' => 'absint', // Ensure it's an integer
        'transport'         => 'postMessage', // Allows live preview
    ));

    // Add control (input field) for menu items space
    $wp_customize->add_control('menu_space_control', array(
        'label'    => __('Menu Item Space', 'codelogix'),
        'section'  => 'custom_menu_section',
        'settings' => 'menu_space',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 3,  // Minimum font size
            'max'  => 100,  // Maximum font size
            'step' => 1,   // Step value
        ),
    ));
}
add_action('customize_register', 'custom_menu_font_size_customizer');

function custom_menu_dynamic_css() {
    $menu_font_size = get_theme_mod('menu_font_size', 16); // Get selected font size
    $menu_font_padding = get_theme_mod('menu_space', 16); // Put some space on Menu Items
    ?>
    <style>
        .main-navigation a, 
        .menu-primary-menu-container ul li a {
            font-size: <?php echo esc_attr($menu_font_size); ?>px;
            padding-right: <?php echo esc_attr($menu_font_padding); ?>px;
           
        }
        .the_header li a:link, a:visited, a:active {
            color: #000000 !important;
        }   
        .the_header li a:hover{
            color: #000000;
        }
    </style>
    <?php
}
add_action('wp_head', 'custom_menu_dynamic_css');

