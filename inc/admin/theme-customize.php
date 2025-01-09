<?php


// Hook to add a new admin menu for Theme Customisation - 09.01.2025
add_action('admin_menu', 'theme_create_menu');

function theme_create_menu() {
    add_menu_page(
        'Theme Customization Page', // Page title
        'CodeLogix Theme Customize',         // Menu title
        'manage_options',      // Capability
        'theme_customization', // Menu slug
        'theme_settings_page',    // Function to display the page content
        'dashicons-welcome-widgets-menus'
    );
}

function theme_settings_page(){
    echo "hello";
}