<?php

namespace Jeffreyvr\WPMetaBox\Options;

use Jeffreyvr\WPMetaBox\Enqueuer;

use function Jeffreyvr\WPMetaBox\resource_content;

class CodeEditor extends OptionAbstract
{
    public $view = 'code-editor';

    public $code_mirror_settings_name;

    public function __construct($section, $args = [])
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);

        parent::__construct($section, $args);
    }

    public function enqueue()
    {
        Enqueuer::add('wmb-code-editor', function () {
            wp_enqueue_style('wp-codemirror');
            wp_enqueue_script('wp-theme-plugin-editor');

            wp_add_inline_script('wp-theme-plugin-editor', resource_content('js/wmb-code-editor.js'));
        });
    }

    public function get_editor_config()
    {
        return wp_enqueue_code_editor(['type' => $this->get_arg('editor_type', 'text/html'), 'codemirror' => [
            'autoRefresh' => true,
        ]]);
    }

    public function sanitize($value)
    {
        return $value;
    }
}
