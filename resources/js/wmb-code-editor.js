var wmbCodeEditor = function (editor) {
    let config = {};

    if (editor.getAttribute('wmb-code-editor')) {
        let customConfig = JSON.parse(editor.getAttribute('wmb-code-editor'));

        config = Object.assign(config, customConfig);
    }

    wp.codeEditor.initialize(editor.id, config);

    setInterval(() => {
        wp.data.subscribe(function () {
            let _editor = jQuery(editor);
            _editor.next(".CodeMirror").get(0).CodeMirror.save();
        });
    }, 10);

}

document.addEventListener('DOMContentLoaded', function () {
    let editors = document.querySelectorAll('[wmb-code-editor]');

    for (let editor of editors) {
        wmbCodeEditor(editor);
    }
});

document.addEventListener('wmb-repeater-field-created', function (e) {
    let editors = e.detail.target.querySelectorAll('[wmb-code-editor]');

    let existingEditors = e.detail.target.querySelectorAll('.CodeMirror');

    for (let existingEditor of existingEditors) {
        existingEditor.remove();
    }

    for (let editor of editors) {
        wmbCodeEditor(editor);
    }
});

// jQuery(function($){
//     wp.codeEditor.initialize($("#<?php echo $option->get_id_attribute(); ?>"), <?php echo $option->code_mirror_settings_name; ?>);

// wp.data.subscribe(function () {
//     let editor = $("#<?php echo $option->get_id_attribute(); ?>");

//     if (editor.length === 0) {
//         return;
//     }

//     editor.next(".CodeMirror").get(0).CodeMirror.save();
// });
// });
