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

    <h3><?php esc_html_e( 'Header Section Customization' ); ?></h3>
    <!-----------CREATING NEW TABS ON ADD MENU PAGES------------------>
    <h2 class="nav-tab-wrapper">
        <a href="?page=theme_customization&tab=general"
            class="nav-tab <?php echo (isset($_GET['tab']) && $_GET['tab'] == 'general') ? 'nav-tab-active' : ''; ?>">General</a>
        <a href="?page=theme_customization&tab=advanced"
            class="nav-tab <?php echo (isset($_GET['tab']) && $_GET['tab'] == 'advanced') ? 'nav-tab-active' : ''; ?>">Advanced</a>
        <a href="?page=theme_customization&tab=others"
            class="nav-tab <?php echo (isset($_GET['tab']) && $_GET['tab'] == 'others') ? 'nav-tab-active' : ''; ?>">Others</a>
        <a href="?page=theme_customization&tab=export_import"
            class="nav-tab <?php echo (isset($_GET['tab']) && $_GET['tab'] == 'export_import') ? 'nav-tab-active' : ''; ?>">Export
            Import</a>
    </h2>


    <div class="tab-content">
        <?php
            $tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';

            if ($tab == 'general') {
                echo '<h2>Top Bar Settings</h2>';
                echo '<form method="post" action="options.php">';
                settings_fields('theme_settings_group');
                do_settings_sections('theme_customization');
                submit_button();
                
                echo '</form>';
            } elseif ($tab == 'advanced') {
                echo '<h2>Header Settings</h2>';
                echo '<form method="post" action="options.php">';
                settings_fields('advanced_settings_group');
                do_settings_sections('advanced_settings');
                submit_button();
                echo '</form>';
            } elseif ($tab == 'others') {
                echo '<h2>Logo and Button Settings</h2>';
                echo '<form method="post" action="options.php">';
                settings_fields('other_settings_group');
                do_settings_sections('other_settings');
                submit_button();
                echo '</form>';
            } elseif ($tab =='export_import') {
                echo '<h2>Export and Import Settings</h2>';
                echo '<form method="post" action="options.php">';
                settings_fields('export_settings_group');
                do_settings_sections('export_settings');
                //submit_button();
                echo '</form>'; ?>
                    <!-- Export Button -->
                    <br />
                    <h2>Export all Settings Config:</h2>
                    <form method="post" action="">
                        <?php wp_nonce_field('export_settings', 'export_nonce'); ?>
                        <input type="submit" 
                               name="export_settings" 
                               class="button button-primary" 
                               value="Export to JSON">
                    </form>

                    <!-- Import Button -->
                    <br />
                    <h2>Import Settings:</h2>
                    <form method="post" enctype="multipart/form-data" action="">
                        <?php wp_nonce_field('import_settings', 'import_nonce'); ?>
                        <input  type="file" 
                                name="settings_file" 
                                accept=".json" 
                                required><br /><br />
                        <input  type="submit" 
                                name="import_settings" 
                                class="button button-primary" 
                                value="Import from JSON">
                    </form>

                    <!----------Reset Button--------------->
                    <br />
                    <h2>Reset All Settings:</h2>
                    <form method="post" action="options.php">
                    <?php wp_nonce_field('reset_settings', 'reset_nonce'); ?>
                        <button type="submit" 
                                name="reset_settings"
                                value="1" 
                                class="button button-secondary"
                                onclick="return confirm('Are you sure you want to reset all settings to their default values?');"
                                >
                            Reset Settings
                        </button>
                    </form>
        <?php
                    }
                    ?>
    </div>
</div>
<?php
}



// Register settings
add_action('admin_init', 'theme_register_settings');

function theme_register_settings() {

    //For General Page
    register_setting('theme_settings_group', 'custom_email');
    register_setting('theme_settings_group', 'custom_phone');
    register_setting('theme_settings_group', 'custom_whatsapp');
    register_setting('theme_settings_group', 'custom_bg_color'); 
    register_setting('theme_settings_group', 'custom_font_color'); 
    register_setting('theme_settings_group', 'custom_font_size');
    register_setting('theme_settings_group', 'custom_top_bar_height');
    register_setting('theme_settings_group', 'top_social_color');
    register_setting('theme_settings_group', 'fb_link');
    register_setting('theme_settings_group', 'linkedin_link');
    register_setting('theme_settings_group', 'tube_link');
    register_setting('theme_settings_group', 'twiter_link');
    register_setting('theme_settings_group', 'skype_link');
    register_setting('theme_settings_group', 'toggle_switch');
    
   
    add_settings_section(
        'theme_main_section', 
        '', 
        null, 
        'theme_customization'
    );

    //For Advanced Page 
    register_setting('advanced_settings_group', 'custom_header_background');
    register_setting('advanced_settings_group', 'header_border_bottom');
    register_setting('advanced_settings_group', 'border_background');
    register_setting('advanced_settings_group', 'button_text');
    register_setting('advanced_settings_group', 'menu_font_size');
    register_setting('advanced_settings_group', 'menu_space');
    register_setting('advanced_settings_group', 'menu_fonts');
    

    add_settings_section(
        'advanced_section',
        '',
        null,
        'advanced_settings'
    );

    //For Logo and Button Settings Page
    register_setting('other_settings_group', 'site_logo');
    register_setting('other_settings_group', 'custom_logo_size');
    register_setting('other_settings_group', 'custom_logo_padding');
    register_setting('other_settings_group', 'button_background');
    register_setting('other_settings_group', 'button_text_color');
    register_setting('other_settings_group', 'button_padding');
    register_setting('other_settings_group', 'button_font_size');
    register_setting('other_settings_group', 'button_border');
    register_setting('other_settings_group', 'button_radius');
    register_setting('other_settings_group', 'button_border_color');
    register_setting('other_settings_group', 'button_font_family');
    register_setting('other_settings_group', 'button_switch');


    add_settings_section(
        'other_section',
        '',
        null,
        'other_settings'
    );

    //For Import and Export page
    register_setting('export_settings_group', 'export_settings');


    add_settings_section(
        'other_section',
        '',
        null,
        'other_settings'
    );



/********************************** ALL FIELDS GENERAL SETTINGS *******************************************/
    //For Top bar Switch ON-OFF
    add_settings_field(
        'toggle_switch', 
        'Tob Bar On/Off:', 
        'toggle_switch_callback', 
        'theme_customization', 
        'theme_main_section',
        [
			'label_for' => 'toggle_switch'
		]
    );
    //For Email Fields
    add_settings_field(
        'custom_email', 
        'Email Address:', 
        'theme_field_callback', 
        'theme_customization', 
        'theme_main_section'
    );
    //For Phone
    add_settings_field(
        'custom_phone',
        'Phone Number:',
        'theme_field_callback1',
        'theme_customization', 
        'theme_main_section'
    );
    //For WhatsApp
    add_settings_field(
        'custom_whatsapp',
        'Whats App:',
        'theme_field_callback2',
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
    //For Top Social Icons Color
    add_settings_field(
        'top_social_color',
        'Top Nav Social Icon Color',
        'top_social_color_callback',
        'theme_customization',
        'theme_main_section'
    );
    //Facebook Link
    add_settings_field(
        'fb_link',
        'Facebook Link',
        'fb_link_callback',
        'theme_customization',
        'theme_main_section'
    );
    //Linkedin Link
    add_settings_field(
        'linkedin_link',
        'LinkedIn Link',
        'linkedin_link_callback',
        'theme_customization',
        'theme_main_section'
    );
    //Youtube Link
    add_settings_field(
        'tube_link',
        'YouTube Link',
        'tube_link_callback',
        'theme_customization',
        'theme_main_section'
    );
    //Twitter Link
    add_settings_field(
        'twiter_link',
        'Twitter Link',
        'twiter_link_callback',
        'theme_customization',
        'theme_main_section'
    );
    //Skype Link
    add_settings_field(
        'skype_link',
        'Skype Link',
        'skype_link_callback',
        'theme_customization',
        'theme_main_section'
    );


    /************Fields for Adanced Section**************/    


    //For Header Background Color
    add_settings_field(
        'custom_header_background', 
        'Header Background Color:', 
        'theme_header_background_color_callback', 
        'advanced_settings', 
        'advanced_section'
    );
    //For Header Border Bottom
    add_settings_field(
        'header_border_bottom', 
        'Header Border Bottom Width:', 
        'theme_header_border_bottom_callback', 
        'advanced_settings', 
        'advanced_section'
    );

     //For Header Border Bottom Color
     add_settings_field(
        'border_background', 
        'Border Bottom Color:', 
        'theme_border_background_callback', 
        'advanced_settings', 
        'advanced_section'
    );
    
    //For Header Button Text - dynamic
      add_settings_field(
        'button_text', 
        'Button Text:', 
        'button_text_callback', 
        'advanced_settings', 
        'advanced_section'
    );

    //For Header Menu Font Size 
      add_settings_field(
        'menu_font_size', 
        'Nav Menu Font Size (px)', 
        'menu_font_size_callback', 
        'advanced_settings', 
        'advanced_section'
    );

    //For Header Menu Item Space
    add_settings_field(
        'menu_space', 
        'Menu Item Space (px)', 
        'menu_space_callback', 
        'advanced_settings', 
        'advanced_section'
    );

    //For Header Menu Item Space
    add_settings_field(
        'menu_fonts', 
        'Menu Font Family', 
        'menu_font_family_callback', 
        'advanced_settings', 
        'advanced_section'
    );


    /*********OTHER SETTINGS***********/
    
    //For 
    add_settings_field(
        'site_logo', 
        'Site Logo:', 
        'site_logo_callback', 
        'other_settings', 
        'other_section'
    );
    
    //For Logo Size Width Fields
    add_settings_field(
        'custom_logo_size', 
        'Logo Width (px):', 
        'theme_logo_callback', 
        'other_settings', 
        'other_section'
    );      

    //For Logo Padding 
    add_settings_field(
        'custom_logo_padding', 
        'Logo Padding (px):', 
        'theme_logo_padding_callback', 
        'other_settings', 
        'other_section'
    );    

     //For Top bar Switch ON-OFF
     add_settings_field(
        'button_switch', 
        'Button Hide-Display:', 
        'button_switch_callback', 
        'other_settings', 
        'other_section',
        [
			'label_for' => 'button_switch'
		]
    );
     //For Button Background 
     add_settings_field(
        'button_background', 
        'Button Background:', 
        'button_background_callback', 
        'other_settings', 
        'other_section'
    ); 
    
     //For Button Text Color 
     add_settings_field(
        'button_text_color', 
        'Button Text Color:', 
        'button_text_color_callback', 
        'other_settings', 
        'other_section'
    ); 
    
    //For Button Padding
    add_settings_field(
        'button_padding', 
        'Button Padding', 
        'button_padding_callback', 
        'other_settings', 
        'other_section'
    );

    //For Button Font Size
    add_settings_field(
        'button_font_size', 
        'Button Font', 
        'button_font_size_callback', 
        'other_settings', 
        'other_section'
    );

    //For Button Border
    add_settings_field(
        'button_border', 
        'Button Border', 
        'button_border_callback', 
        'other_settings', 
        'other_section'
    );
    //For Button Border Radius
    add_settings_field(
        'button_radius', 
        'Button Border Radius', 
        'button_radius_callback', 
        'other_settings', 
        'other_section'
    );

    //For Button Border Color
    add_settings_field(
        'button_border_color', 
        'Button Border Color', 
        'button_border_color_callback', 
        'other_settings', 
        'other_section'
    );

    //For Button Font Family
    add_settings_field(
        'button_font_family', 
        'Button Font Family', 
        'button_font_family_callback', 
        'other_settings', 
        'other_section'
    );
    
}

/***************TOP NAV BAR CALLBACK FUNCTIONS ****************/
//For TOP nav On Off switch
function toggle_switch_callback(){
    $value = get_option('toggle_switch');
    ?>
<label class="switch">
    <input type="checkbox" name="toggle_switch" value="1" <?php if($value == '1'){
            echo ' checked';
        };?> />

    <span class="slider"></span>
</label>
<?php
}
//For theme_field Email
function theme_field_callback(){
    $value = get_option('custom_email', '');
    ?>
<div class='jumbotron'>
    <input type="text" name="custom_email" value="<?php echo esc_attr($value); ?>" class="form-control"
        placeholder="Email" />
</div>
<?php
}
//For theme_fields Phone
function theme_field_callback1(){
    $value = get_option('custom_phone', '');
    ?>
<div class='jumbotron'>
    <input type="text" name="custom_phone" value="<?php echo esc_attr($value); ?>" class="form-control"
        placeholder="Phone" />
</div>
<?php
}
//For theme_fields WhatsApp
function theme_field_callback2(){
    $value = get_option('custom_whatsapp', '');
    ?>
<div class='jumbotron'>
    <input type="text" name="custom_whatsapp" value="<?php echo esc_attr($value); ?>" class="form-control"
        placeholder="Whats App" />
</div>
<?php
}
//Function for Color Picker to change background of Header Top.
function custom_bg_color_callback() {
    $color = get_option('custom_bg_color', '#ffffff'); // Default to white
    ?>
<input type="text" id="custom_bg_color" name="custom_bg_color" value="<?php echo esc_attr($color);?>"
    class="custom-color-field" />
<!-----This 'custom-color-field' class generate Color Picker-->
<?php
}
//Function for Color Picker to change Font-Color of Header Top.
function custom_font_color_callback(){
    $color = get_option('custom_font_color', '#ffffff'); // Default to white
    ?>
<input type="text" id="custom_font_color" name="custom_font_color" value="<?php echo esc_attr($color);?>"
    class="custom-color-field" />
<!-----This 'custom-color-field' class generate Color Picker-->
<?php
}
//Function for Color Picker to change Font-Size of Header Top.
function custom_font_size_callback(){
    $font_size = get_option('custom_font_size', ''); 
    ?>
<input type="number" id="custom_font_size" name="custom_font_size" value="<?php echo esc_attr($font_size);?>" />
<?php
}
//Function for Top Nav Bar Size - height control
function custom_top_nav_callback(){
    $size = get_option('custom_top_bar_height', '');
    ?>
<input type="number" id="custom_top_bar_height" name="custom_top_bar_height" value="<?php echo esc_attr($size);?>" />
<?php
}
//Top Nav Social Icons Color settings:
function top_social_color_callback(){
    $color = get_option('top_social_color', '#ffffff');
    ?>
<input type="text" id="top_social_color" name="top_social_color" value="<?php echo esc_attr($color);?>"
    class="custom-color-field" />
<?php
}
//Facebook Link
function fb_link_callback(){
    $fb = get_option('fb_link');
    ?>
<input type="text" name="fb_link" value="<?php echo esc_attr($fb);?>" />
<?php
}
//YOutube Link
function tube_link_callback(){
    $fb = get_option('tube_link');
    ?>
<input type="text" name="tube_link" value="<?php echo esc_attr($fb);?>" />
<?php
}
//Linkedin Link
function linkedin_link_callback(){
    $fb = get_option('linkedin_link');
    ?>
<input type="text" name="linkedin_link" value="<?php echo esc_attr($fb);?>" />
<?php
}
//Twitter Link
function twiter_link_callback(){
    $fb = get_option('twiter_link');
    ?>
<input type="text" name="twiter_link" value="<?php echo esc_attr($fb);?>" />
<?php
}

//Skype Link
function skype_link_callback(){
    $fb = get_option('skype_link');
    ?>
<input type="text" name="skype_link" value="<?php echo esc_attr($fb);?>" />
<?php
}

//**************MAIN HEADER SECTION**********//
//Header BackGround Color
function theme_header_background_color_callback(){
    $value = get_option('custom_header_background', '');
    ?>

<input type="text" id="custom_header_background" name="custom_header_background" value="<?php echo esc_attr($value);?>"
    class="custom-color-field" />

<?php
}
//Header Border Bottom
function theme_header_border_bottom_callback(){
    $value = get_option('header_border_bottom', '');
    ?>

<input type="number" name="header_border_bottom" value="<?php echo esc_attr($value);?>" class="form-control"
    placeholder="Border Bottom" />

<?php
}

//header Border Bottom Color
function theme_border_background_callback(){
    $value = get_option('border_background', '#ffffff');
    ?>

<input type="text" id="border_background" name="border_background" value="<?php echo esc_attr($value);?>"
    class="custom-color-field" />

<?php
}

//header Border Bottom Color
function button_text_callback(){
    $value = get_option('button_text', '');
    ?>

<input type="text" name="button_text" value="<?php echo esc_attr($value);?>" class="form-control"
    placeholder="Button Text" />
<?php
}

//header NAV Menu Font Size
function menu_font_size_callback(){
    $value = get_option('menu_font_size', '');
    ?>

<input type="number" name="menu_font_size" value="<?php echo esc_attr($value);?>" class="form-control"
    placeholder="Font Size" />
<?php
}

//header NAV Menu Item Space
function menu_space_callback(){
    $value = get_option('menu_space', '');
    ?>
<input type="number" name="menu_space" value="<?php echo esc_attr($value);?>" class="form-control"
    placeholder="Space Right" />
<?php
}

//**************LOGO AND BUTTON SECTION CALLBACK **********//
//header Logo Uploading
function site_logo_callback(){
    $site_logo = get_option('site_logo');
    ?>
<div>
    <input type="text" id="site_logo" name="site_logo" value="<?php echo esc_url($site_logo); ?>" class="regular-text">
    <button class="button site-logo-upload">Upload Logo</button>
    <?php if ($site_logo) : ?>
    <br><img src="<?php echo esc_attr($site_logo); ?>" style="max-width: 150px; margin-top: 10px;">
    <?php endif; ?>
</div>
<?php
}

//Header Logo Size - Width Control
function theme_logo_callback(){
    $value = get_option('custom_logo_size', '100');
    ?>

<input type="number" name="custom_logo_size" value="<?php echo esc_attr($value); ?>" class="form-control"
    placeholder="Logo Size" />

<?php
}
//Header Logo Padding 
function theme_logo_padding_callback(){
    $value = get_option('custom_logo_padding', '');
    ?>
<input type="number" name="custom_logo_padding" value="<?php echo esc_attr($value); ?>" class="form-control"
    placeholder="Logo Size" />

<?php
}

//Header Button Background Color
function button_background_callback(){
    $value = get_option('button_background', '#ffffff');
    ?>

<input type="text" id="button_background" name="button_background" value="<?php echo esc_attr($value);?>"
    class="custom-color-field" />

<?php
}


//Header Button Background Color
function button_text_color_callback(){
    $value = get_option('button_text_color', '#ffffff');
    ?>

<input type="text" id="button_text_color" name="button_text_color" value="<?php echo esc_attr($value);?>"
    class="custom-color-field" />

<?php
}

//Button Padding 
function button_padding_callback(){
    $value = get_option('button_padding', '');
    ?>
<input type="number" name="button_padding" value="<?php echo esc_attr($value); ?>" class="form-control"
    placeholder="Button Padding" />

<?php
}

//Button Padding 
function button_font_size_callback(){
    $value = get_option('button_font_size', '');
    ?>
<input type="number" name="button_font_size" value="<?php echo esc_attr($value); ?>" class="form-control"
    placeholder="Button Font Size" />

<?php
}


//Button Border 
function button_border_callback(){
    $value = get_option('button_border', '');
    ?>
<input type="number" name="button_border" value="<?php echo esc_attr($value); ?>" class="form-control"
    placeholder="Button Border" />

<?php
}

//Button Border Radius
function button_radius_callback(){
    $value = get_option('button_radius', '');
    ?>
<input type="number" name="button_radius" value="<?php echo esc_attr($value); ?>" class="form-control"
    placeholder="Button Radius" />

<?php
}

//Button Border 
function button_border_color_callback(){
    $value = get_option('button_border_color', '#ffffff');?>
    <input type="text" 
            id="button_border_color" 
            name="button_border_color" 
            value="<?php echo esc_attr($value); ?>"
            class="custom-color-field" 
            />
<?php
}
//List of All Fonts family Array
function codelogix_font_families(){
    return [
        'Arial, sans-serif',
        'Verdana, sans-serif',
        'Helvetica, sans-serif',
        'Times New Roman, serif',
        'Georgia, serif',
        'Courier New, monospace',
        'Comic Sans MS, cursive',
        'Trebuchet MS, sans-serif',
        'Impact, sans-serif',
        'Lucida Console, monospace',
        'Tahoma, sans-serif',
        'Poppins, sans-serif',
        'Open Sans, sans-serif',
        'Noto Sans, sans-serif',
        'Playfair Display, sans-serif',
    ];

    do_action('codelogix_font_family');
}



//Button Border 
function button_font_family_callback(){
    $selected_font = get_option('button_font_family', 'Arial');
    $fonts = codelogix_font_families();

    echo '<select name="button_font_family">';
    foreach($fonts as $font){
        $selected = ($selected_font == $font) ? 'selected' : '';
        echo '<option value="' . esc_attr($font) . '" ' . $selected . '>' . esc_html($font) . '</option>';
        }
    echo '</select>';
}

//Load fonts from Google font api
function load_selected_google_font() {
    $font = get_option('button_font_family');
    if ($font) {
        $font_slug = str_replace(' ', '+', $font);
        echo '<link href="https://fonts.googleapis.com/css2?family=' . esc_attr($font_slug) . ':wght@400;700&display=swap" rel="stylesheet">';
    }
}
add_action('wp_head', 'load_selected_google_font');

function menu_font_family_callback(){
    $selected_font = get_option('menu_fonts', 'Arial');
    $fonts = codelogix_font_families();

    echo '<select name="menu_fonts">';
    foreach($fonts as $font){
        $selected = ($selected_font == $font) ? 'selected' : '';
        echo '<option value="' . esc_attr($font) . '" ' . $selected . '>' . esc_html($font) . '</option>';
    }
        echo '</select>';

}

//For Button Display switch
function button_switch_callback(){
    $value = get_option('button_switch');
    ?>
<label class="switch">
    <input type="checkbox" name="button_switch" value="1" <?php if($value == '1'){
            echo ' checked';
        };?> />

    <span class="slider"></span>
</label>
<?php
}

/************************************* ALL DYNAMIC STYLE - CSS***************************/
//Function to create CSS for Nav Bar 
add_action('wp_head', 'display_top_bar_height');
function display_top_bar_height(){
    $toggle_switch  = get_option('toggle_switch'); // Top Bar ON OFF Switch
    $height         = get_option('custom_top_bar_height'); // Get user-defined Color
    $font_size      = get_option('custom_font_size');//Get the user-defind font-size
    $font_color     = get_option('custom_font_color'); //Get the font color
    $top_backgrd    = get_option('custom_bg_color'); // Get the background color
    $social_color   = get_option('top_social_color'); // Get user-defined Color
    $logo_width     = get_option('custom_logo_size', 100); // Get user-defined width
    $logo_padding   = get_option('custom_logo_padding'); //Get user-defined padding
    $header_backgrd = get_option('custom_header_background'); //Get user-defined background
    $header_border  = get_option('header_border_bottom'); //Get user-defined border bottom
    $border_backgr  = get_option('border_background'); //Get user-defined color
    $nav_font_size  = get_option('menu_font_size'); //Get Main Menu Font size
    $nav_space      = get_option('menu_space'); //Get  
    $button_background  = get_option('button_background'); //Get 
    $button_text_color  = get_option('button_text_color'); //Get 
    $button_padding     = get_option('button_padding'); //Get 
    $button_font_size   = get_option('button_font_size'); //Get 
    $button_border       = get_option('button_border'); //Get 
    $button_radius      = get_option('button_radius'); //Get 
    $button_border_color = get_option('button_border_color'); //Get 
    $button_font_family = get_option('button_font_family'); //Get 
    $button_switch = get_option('button_switch'); //Get 
    $menu_font_family = get_option('menu_fonts'); //Get 

   
    ?>
<style>
.top_section {
    padding: <?php echo esc_attr($height);?>px 0px;
    font-size: <?php echo esc_attr($font_size);?>px;
    color: <?php echo esc_attr($font_color);?>;
    background: <?php echo esc_attr($top_backgrd);?>;
    display: <?php if($toggle_switch !=="1") {
        echo 'none';
    }

    ?>
}

.top_social {
    color: <?php echo esc_attr($social_color);?>;
}

.top_social a:link,
a:hover,
a:active {
    color: <?php echo esc_attr($social_color); ?>;
}

.top_social a:visited {
    color: <?php echo esc_attr($social_color); ?> !important;
}

.custom-logo img {
    max-width: <?php echo esc_attr($logo_width);?>px;
    height: auto;
    padding-top: <?php echo esc_attr($logo_padding);?>px;
    padding-bottom: <?php echo esc_attr($logo_padding);?>px;
}

#masthead {
    background: <?php echo esc_attr($header_backgrd);?>;
    border-bottom: <?php echo esc_attr($header_border);?>px solid <?php echo esc_attr($border_backgr);
    ?>;
}

.main-navigation a,
.menu-primary-menu-container ul li a {
    font-size: <?php echo esc_attr($nav_font_size);?>px;
    padding-right: <?php echo esc_attr($nav_space);?>px;
    font-family: <?php echo esc_attr($menu_font_family); ?>;
}

.the_header li a:link,
a:visited,
a:active {
    color: #000000 !important;
}

.the_header li a:hover {
    color: #000000;
}

.site-button button {
    background: <?php echo esc_attr($button_background);?>;
    color: <?php echo esc_attr($button_text_color);?>;
    padding: <?php echo esc_attr($button_padding);?>px;
    font-size: <?php echo esc_attr($button_font_size);?>px;
    border: <?php echo esc_attr($button_border);?>px solid <?php echo esc_attr($button_border_color);?>;
    border-radius: <?php echo esc_attr($button_radius);?>px;
    font-family: <?php echo esc_attr($button_font_family);?>;

    display: <?php if($button_switch !=="1") {
        echo 'none';
    }

    ?> !important;
}

.site-navigation {
    width: <?php if($button_switch !=="1") {
        echo '70%';
    }

    ?>;
}

.site-button {
    width: <?php if($button_switch !=="1") {
        echo '0%';
    }

    ?>;
}
</style>
<?php
}

/***************EXPORT - IMPORT - RESET Function ******************/

//Export to a File
require_once('export_settings/export_settings.php');

//Import Settings from a File
require_once('import_settings/import_settings.php');

//Reset Settings File
require_once('reset_settings/reset_settings.php');
