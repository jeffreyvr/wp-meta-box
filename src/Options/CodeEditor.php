<?php

namespace Jeffreyvr\WPMetaBox\Options;

use Jeffreyvr\WPMetaBox\Options\OptionAbstract;

class CodeEditor extends OptionAbstract
{
    public $view = 'code-editor';

    public function __construct($section, $args = [])
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);

        parent::__construct($section, $args);
    }

    public function enqueue()
    {
        wp_enqueue_script('wp-theme-plugin-editor');
        wp_enqueue_style('wp-codemirror');

        $name = str_replace('-', '_', $this->get_id_attribute());

        wp_localize_script('jquery', $name, wp_enqueue_code_editor(['type' => $this->get_arg('editor_type', 'text/html'), 'codemirror' => [
            'autoRefresh' => true
        ]]));

        wp_add_inline_script('wp-theme-plugin-editor', 'jQuery(function($){
            wp.codeEditor.initialize($("#'.$this->get_id_attribute().'"), '.$settings_name.');

            wp.data.subscribe(function () {
                $("#'.$this->get_id_attribute().'").next(".CodeMirror").get(0).CodeMirror.save();
            });
        });');
    }

    public function sanitize($value)
    {
        return $value;
    }
}
