jQuery(document).ready(function($) {
    function openMediaUploader(buttonClass, inputField) {
        var mediaUploader;
        $(buttonClass).click(function(e) {
            e.preventDefault();
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            mediaUploader = wp.media.frames.file_frame = wp.media({
                title: 'Select Image',
                button: {
                    text: 'Use this Image'
                },
                multiple: false
            });

            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $(inputField).val(attachment.url);
            });

            mediaUploader.open();
        });
    }

    openMediaUploader('.site-logo-upload', '#site_logo');
    openMediaUploader('.site-icon-upload', '#site_icon');
});
