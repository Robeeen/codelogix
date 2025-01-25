<?php


//GET All option to Export
add_action('admin_init', 'handle_settings_export');
function handle_settings_export() {
    if (isset($_POST['export_settings']) && check_admin_referer('export_settings', 'export_nonce')) {
        $options = [
            'custom_email' => get_option('custom_email'),
            'custom_phone' => get_option('custom_phone'),
            'custom_whatsapp' => get_option('custom_whatsapp'),
            'custom_bg_color' => get_option('custom_bg_color'),
            'custom_font_size' => get_option('custom_font_size'),
            'custom_font_color' => get_option('custom_font_color'),
            'custom_top_bar_height' => get_option('custom_top_bar_height'),
            'top_social_color' => get_option('top_social_color'),
            'fb_link' => get_option('fb_link'),
            'linkedin_link' => get_option('linkedin_link'),
            'tube_link' => get_option('tube_link'),
            'twiter_link' => get_option('twiter_link'),
            'skype_link' => get_option('skype_link'),
            'toggle_switch' => get_option('toggle_switch'),
            'custom_header_background' => get_option('custom_header_background'),
            'header_border_bottom' => get_option('header_border_bottom'),
            'border_background' => get_option('border_background'),
            'button_text' => get_option('button_text'),
            'menu_font_size' => get_option('menu_font_size'),
            'menu_space' => get_option('menu_space'),
            'site_logo' => get_option('site_logo'),
            'custom_logo_size' => get_option('custom_logo_size'),
            'custom_logo_padding' => get_option('custom_logo_padding'),
            'button_background' => get_option('button_background'),
            'button_text_color' => get_option('button_text_color'),
            'button_padding' => get_option('button_padding'),
            'button_font_size' => get_option('button_font_size'),
            'button_border' => get_option('button_border'),
            'button_radius' => get_option('button_radius'),
            'button_border_color' => get_option('button_border_color'),
            'button_font_family' => get_option('button_font_family'),
            'button_switch' => get_option('button_switch'),          
            'menu_fonts' => get_option('menu_fonts'),          
        ];

        header('Content-Disposition: attachment; filename="settings-export.json"');
        header('Content-Type: application/json');
        echo json_encode($options, JSON_PRETTY_PRINT);
        exit;
    }
}
