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
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Theme Customization Page' ); ?></h1>
        <form method="post" action="options.php">
            <?php
                settings_fields('theme_settings_group');
                do_settings_sections('theme_customization');                
                submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings
add_action('admin_init', 'theme_register_settings');

function theme_register_settings() {
    register_setting('theme_settings_group', 'theme_fields');
    
    add_settings_section(
        'theme_main_section', 
        '', 
        null, 
        'theme_customization'
    );

    add_settings_field(
        'theme_field_list', 
        'Header Text', 
        'theme_field_list_callback', 
        'theme_customization', 
        'theme_main_section'
    );
}

function theme_field_list_callback(){
    $value = get_option('theme_fields', []);
    ?>
     <div class='jumbotron'>
        
        <input type="text" name="theme_fields" value="<?php echo $value; ?>" class="form-control" placeholder="Header Text" >

    </div>
<?php
}