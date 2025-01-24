<?php

//FUnction to Import from a File
add_action('admin_init', 'handle_settings_import');

function handle_settings_import(){
    if(isset($_POST['import_settings']) && check_admin_referer('import_settings', 'import_nonce')){
        //If File is not empty
        if(!empty($_FILES['settings_file']['tmp_name'])){
            $file_type = wp_check_filetype($_FILES['settings_file']['name']);
            //We have added mime Type json after this code block
            if ($file_type['ext'] !== 'json') {
                add_settings_error(
                    'export_import', 
                    'file_type_error', 
                    'Invalid file type. Please upload a JSON file.', 
                    'error');
                return;
            }

            //Get the json file content
            $file_content = file_get_contents($_FILES['settings_file']['tmp_name']);
            if(!$file_content){
                add_settings_error(
                    'export_import',
                    'file_read_error',
                    'Unable to read the file',
                    'error',
                );
            }
            //If content is ok then decode settings config to json
            $settings = json_decode($file_content, true);
            
        }

        if(json_last_error() === JSON_ERROR_NONE){
            foreach($settings as $key => $value){
                update_option($key, $value);
            }
            add_settings_error(
                'general', 
                'settings_imported', 
                'Settings imported successfully!', 
                'updated'
            );
        }else{
            add_settings_error(
                'export_import',
                'json_decode_error', 
                'Invalid JSON file. Error: ' . json_last_error_msg(), 
                'error');
        }
    }
    // else {
    //     add_settings_error(
    //         'export_import', 
    //         'file_upload_error', 
    //         'No file uploaded.', 
    //         'error');
    // }
}

// Add JSON MIME type 
add_filter('upload_mimes', 'allow_json_uploads');
function allow_json_uploads($mime_types) {
    $mime_types['json'] = 'application/json'; 
    return $mime_types;
}

//To display notice on the top
add_action('admin_notices', 'my_admin_notices');
function my_admin_notices() {
    settings_errors('export_import');
}