class WmbWPEditor {
    constructor() {
        document.addEventListener('DOMContentLoaded', () => this.init());
        document.addEventListener('wmb-repeater-field-created', () => this.init());
        document.addEventListener('wmb-repeater-field-init', this.deleteAllEditors.bind(this));
        document.addEventListener('wmb-repeater-field-deleted', this.handleRepeaterFieldDeletion.bind(this));
    }

    async create(editor) {
        // Before init, we first need to remove the editor if it already exists
        wp.editor.remove(editor.id);

        let config = {
            tinymce: {
                theme: 'modern',
                plugins: 'link lists',
                init_instance_callback: (_editor) => {
                    _editor.on('change', function () {
                        editor.value = _editor.getContent();
                    });
                }
            },
            mediaButtons: true,
            quicktags: true,
        };

        if (editor.getAttribute('wmb-wp-editor')) {
            let customConfig = JSON.parse(editor.getAttribute('wmb-wp-editor'));
            config = Object.assign(config, customConfig);
        }

        return new Promise(resolve => {
            setTimeout(() => {
                wp.editor.initialize(editor.id, config);
                resolve();
            }, 50);
        });
    }

    async init() {
        let editors = document.querySelectorAll('[wmb-wp-editor]');

        for (let editor of editors) {
            await this.create(editor);
        }
    }

    handleRepeaterFieldDeletion(e) {
        wp.editor.remove(e.detail.target.id);
    }

    deleteAllEditors(e) {
        let editors = document.querySelectorAll('[wmb-wp-editor]');

        editors.forEach(editor => wp.editor.remove(editor.id));
    }
}

new WmbWPEditor();
