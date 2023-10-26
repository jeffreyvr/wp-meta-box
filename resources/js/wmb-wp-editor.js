
var wmbWPEditor = function (editor) {
    let config = {
        tinymce: {
            theme: 'modern',
            plugins: 'link lists',
        },
        mediaButtons: true,
        quicktags: true,
    };

    if (editor.getAttribute('wmb-wp-editor')) {
        let customConfig = JSON.parse(editor.getAttribute('wmb-wp-editor'));

        config = Object.assign(config, customConfig);
    }

    wp.editor.initialize(editor.id, config);
};

document.addEventListener('DOMContentLoaded', function () {
    let editors = document.querySelectorAll('[wmb-wp-editor]');

    editors.forEach(function (editor) {
        setTimeout(() => {
            wmbWPEditor(editor);
        }, 10);
    });
});

document.addEventListener('wmb-repeater-field-init', function (e) {
    let editors = e.detail.container.querySelectorAll('[wmb-wp-editor]');

    editors.forEach(function (editor) {
        wp.editor.remove(editor.id);
    });
});

document.addEventListener('wmb-repeater-field-created', function (e) {
    let editors = e.detail.container.querySelectorAll('[wmb-wp-editor]');

    editors.forEach(function (editor) {
        setTimeout(() => {
            wmbWPEditor(editor);
        }, 10);
    });
});
