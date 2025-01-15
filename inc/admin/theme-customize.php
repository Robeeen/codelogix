<?php

// Hook to add a new admin menu for Theme Customisation Top Nav Bar- 09.01.2025
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
        <h3><?php esc_html_e( 'Settings for Top Navbar' ); ?></h3>
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
    register_setting('theme_settings_group', 'theme_fields1');
    register_setting('theme_settings_group', 'theme_fields2');
    register_setting('theme_settings_group', 'custom_bg_color'); 
    register_setting('theme_settings_group', 'custom_font_color'); 
    register_setting('theme_settings_group', 'custom_font_size');
    register_setting('theme_settings_group', 'custom_top_bar_height');
    register_setting('theme_settings_group', 'top_social_color');
    
    add_settings_section(
        'theme_main_section', 
        '', 
        null, 
        'theme_customization'
    );
    //For theme_field Email
    add_settings_field(
        'theme_fields', 
        'Email Address:', 
        'theme_field_callback', 
        'theme_customization', 
        'theme_main_section'
    );
    //For theme_fields Phone
    add_settings_field(
        'theme_fields1',
        'Phone Number:',
        'theme_field_callback1',
        'theme_customization', 
        'theme_main_section'
    );
    //For theme_fields WhatsApp
    add_settings_field(
        'theme_fields2',
        'Whats App:',
        'theme_field_callback2',
        'theme_customization', 
        'theme_main_section'
    );
    //For Custom BG color 
    add_settings_field(
        'custom_bg_color',
        'Background Color',
        'custom_bg_color_callback',
        'theme_customization',
        'theme_main_section'
    );
    //For Custom Font color 
    add_settings_field(
        'custom_font_color',
        'Font Color',
        'custom_font_color_callback',
        'theme_customization',
        'theme_main_section'
    );
    //For Custom Font Size 
    add_settings_field(
        'custom_font_size',
        'Font Size',
        'custom_font_size_callback',
        'theme_customization',
        'theme_main_section'
    );
    //For Top Nav Height
    add_settings_field(
        'custom_top_bar_height',
        'Top Nav Height',
        'custom_top_nav_callback',
        'theme_customization',
        'theme_main_section'
    );
    //For Top Social Icons Color
    add_settings_field(
        'top_social_color',
        'Top Nav Social Icon Color',
        'top_social_color_callback',
        'theme_customization',
        'theme_main_section'
    );
}
//For theme_field Email
function theme_field_callback(){
    $value = get_option('theme_fields', '');
    ?>
     <div class='jumbotron'>        
        <input type="text" 
        name="theme_fields" 
        value="<?php echo esc_attr($value); ?>" 
        class="form-control" 
        placeholder="Email" />
    </div>
<?php
}
//For theme_fields Phone
function theme_field_callback1(){
    $value = get_option('theme_fields1', '');
    ?>
     <div class='jumbotron'>        
        <input type="text" 
        name="theme_fields1" 
        value="<?php echo esc_attr($value); ?>" 
        class="form-control" 
        placeholder="Phone" />
    </div>
<?php
}
//For theme_fields WhatsApp
function theme_field_callback2(){
    $value = get_option('theme_fields2', '');
    ?>
     <div class='jumbotron'>        
        <input type="text"
         name="theme_fields2"
         value="<?php echo esc_attr($value); ?>"
         class="form-control"
         placeholder="Whats App" />
    </div>
<?php
}

//Function for Color Picker to change background of Header Top.
function custom_bg_color_callback() {
    $color = get_option('custom_bg_color', '#ffffff'); // Default to white
    ?>
    <input type="text" 
    id="custom_bg_color" 
    name="custom_bg_color" 
    value="<?php echo esc_attr($color);?>"
    class="custom-color-field" /><!-----This 'custom-color-field' class generate Color Picker-->
<?php
}

//Function for Color Picker to change Font-Color of Header Top.
function custom_font_color_callback(){
    $color = get_option('custom_font_color', '#ffffff'); // Default to white
    ?>
    <input type="text" 
    id="custom_font_color" 
    name="custom_font_color" 
    value="<?php echo esc_attr($color);?>"
    class="custom-color-field" /><!-----This 'custom-color-field' class generate Color Picker-->
<?php

}

/*****************************************************************************/

//Function for Color Picker to change Font-Size of Header Top.
function custom_font_size_callback(){
    $font_size = get_option('custom_font_size', ''); 
    ?>
    <input type="number" 
    id="custom_font_size" 
    name="custom_font_size" 
    value="<?php echo esc_attr($font_size);?>" /> 
<?php
}

/*****************************************************************************/
//Function for Top Nav Bar Size - height control
function custom_top_nav_callback(){
    $size = get_option('custom_top_bar_height', '');
    ?>
    <input type="number" 
    id="custom_top_bar_height" 
    name="custom_top_bar_height" 
    value="<?php echo esc_attr($size);?>" />   
<?php
}

//Function to create CSS for Nav Bar height control
add_action('wp_head', 'display_top_bar_height');
function display_top_bar_height(){
    $social_color = get_option('custom_top_bar_height'); // Get user-defined Color
    $font_size = get_option('custom_font_size');//Get the user-defind font-size
    $font_color = get_option('custom_font_color'); //Get the font color
    $background = get_option('custom_bg_color'); // Get the background color

    ?>
   <style>
       .top_section {
           padding: <?php echo esc_attr($social_color); ?>px 0px;    
           font-size: <?php echo esc_attr($font_size); ?>px;
           color:<?php echo esc_attr($font_color);?>;
           background:<?php echo esc_attr($background);?>; 
       }
   </style>
   <?php
}

/*****************************************************************************/
//Top Nav Social Icons Color settings:
function top_social_color_callback(){
    $color = get_option('top_social_color', '#ffffff');
    ?>
    <input type="text" 
    id="top_social_color" 
    name="top_social_color" 
    value="<?php echo esc_attr($color);?>"
    class="custom-color-field" />   
<?php
}
//Function to create CSS for Social Color Settings
add_action('wp_head', 'display_top_social_color');
function display_top_social_color(){
    $social_color = get_option('top_social_color'); // Get user-defined Color
    ?>
   <style>
       .top_social {
           color: <?php echo esc_attr($social_color); ?>;           
       }
   </style>
   <?php
}



