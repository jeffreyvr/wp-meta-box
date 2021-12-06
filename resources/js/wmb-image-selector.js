jQuery(function ($) {
    $.fn.wmb_image_selector = function (options) {
        let settings = $.extend({
            wrapper: jQuery(this).parent('.wmb-image-selector-container')
        }, options);

        settings = $.extend({
            preview: settings.wrapper.find('.wmb-image-selector-preview'),
            input: settings.wrapper.find('input')
        }, settings);

        let wrapper = settings.wrapper;
        let preview = settings.preview;
        let input = settings.input;

        let media_library = wp.media({
            frame: 'select',
            title: 'Select image',
            multiple: false,
            button: {
                text: 'Select image'
            }
        });

        media_library.open();

        media_library.on('select', function () {
            var image = media_library.state().get('selection').first().toJSON();

            if (preview.is('img')) {
                preview.attr('src', image.sizes.thumbnail.url);
            } else {
                preview.html('<img src="' + image.sizes.thumbnail.url + '">');
                preview.show();
            }

            input.val(image.id);
        });
    }
});