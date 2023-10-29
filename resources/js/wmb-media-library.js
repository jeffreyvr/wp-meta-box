var wmbMediaLibrary = function (library) {
    let config = {
        frame: 'select',
        title: 'Select media',
        multiple: false,
        button: {
            text: 'Select'
        }
    };

    if (library.getAttribute('wmb-media-library')) {
        let customConfig = JSON.parse(library.getAttribute('wmb-media-library'));

        config = Object.assign(config, customConfig);
    }

    let preview = library.querySelector('[wmb-media-library\\:preview]');
    let input = library.querySelector('input');
    let unsetButton = library.querySelector('[wmb-media-library\\:unset]');

    let mediaLibrary = wp.media(config);

    if (input.value === '') {
        unsetButton.style.display = 'none';
    }

    library.querySelector('[wmb-media-library\\:open]').addEventListener('click', function () {
        mediaLibrary.open();
    });

    unsetButton.addEventListener('click', function () {
        input.value = '';
        preview.style.display = 'none';
        unsetButton.style.display = 'none';
    });

    mediaLibrary.on('select', function () {
        var file = mediaLibrary.state().get('selection').first().toJSON();

        if (file.type === 'image') {
            preview.innerHTML = '<img src="' + file.sizes.thumbnail.url + '">';
        } else {
            preview.innerHTML = '<img src="' + file.icon + '">' + file.filename;
        }

        preview.style.display = 'block';
        unsetButton.style.display = 'flex';
        input.value = file.id;
    });
};

document.addEventListener('DOMContentLoaded', function () {
    var libraries = document.querySelectorAll('[wmb-media-library]');

    libraries.forEach(function (library) {
        wmbMediaLibrary(library);
    });
});

document.addEventListener('wmb-repeater-field-created', function (e) {
    e.detail.target.querySelectorAll('[wmb-media-library]').forEach(function (library) {
        wmbMediaLibrary(library);
    });
});
