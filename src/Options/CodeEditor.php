<?php

namespace Jeffreyvr\WPMetaBox\Options;

use Jeffreyvr\WPMetaBox\Enqueuer;

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
            wp_enqueue_script('wp-theme-plugin-editor');
            wp_enqueue_style('wp-codemirror');

            $this->code_mirror_settings_name = str_replace('-', '_', $this->get_id_attribute());

            wp_localize_script('jquery', $this->code_mirror_settings_name, wp_enqueue_code_editor(['type' => $this->get_arg('editor_type', 'text/html'), 'codemirror' => [
                'autoRefresh' => true,
            ]]));
        });
    }

    public function sanitize($value)
    {
        return $value;
    }
}
