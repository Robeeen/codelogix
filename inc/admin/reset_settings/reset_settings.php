<?php


add_action('admin_init', 'reset_function_header');
function reset_function_header(){
    if(isset($_POST['reset_settings']) && $_POST['reset_settings'] == 1){
       //check_admin_referer('reset_nonce');
      

        $options = [
            'custom_email' => '',
            'custom_phone' => '',
            'custom_whatsapp' => '',
            'custom_bg_color' => '',
            'custom_font_size' => '',
            'custom_font_color' => '',
            'custom_top_bar_height' => '',
            'top_social_color' => '',
            'fb_link' => '',
            'linkedin_link' => '',
            'tube_link' => '',
            'twiter_link' => '',
            'skype_link' => '',
            'toggle_switch' => '0',
            'custom_header_background' => '',
            'header_border_bottom' => '',
            'border_background' => '',
            'button_text' => '',
            'menu_font_size' => '',
            'menu_space' => '',
            'site_logo' => '',
            'custom_logo_size' => '',
            'custom_logo_padding' => '',
            'button_background' => '',
            'button_text_color' => '',
            'button_padding' => '',
            'button_font_size' => '',
            'button_border' => '',
            'button_radius' => '',
            'button_border_color' => '',
            'button_font_family' => '',
            'button_switch' => '0',  
        ];

        if(!empty($options)){
            foreach($options as $key => $value){
                update_option($key, $value);
            }


        }else{
            add_settings_error(
                'export_import',
                'reset_settings',
                'Problem is there!',
                'error'
            );
        }    
        
        $redirect_url = add_query_arg('reset', 'sucess', admin_url('options.php?page=theme_customization&tab=export_import'));
        wp_safe_redirect($redirect_url);
        exit;
}

if (isset($_GET['reset']) && $_GET['reset'] === 'sucess') {
    add_settings_error(
        'general',
        'settings_reset',
        'All settings have been reset to their default values.',
        'updated'
    );
}

// Display settings errors (ensures messages show up)
settings_errors();


}