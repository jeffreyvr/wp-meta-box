<?php

namespace Jeffreyvr\WPMetaBox\Options;

use Jeffreyvr\WPMetaBox\Enqueuer;

use function Jeffreyvr\WPMetaBox\resource_content as resource_content;

class Color extends OptionAbstract
{
    public $view = 'text';

    public function __construct($section, $args = [])
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);

        parent::__construct($section, $args);

        $this->args['css']['input_class'] = 'wmb-color-picker';
        $this->args['type'] = 'text';
    }

    public function enqueue()
    {
        Enqueuer::add('wmb-color-picker', function () {
            wp_enqueue_style('wp-color-picker');
            wp_enqueue_script('wp-color-picker');
            wp_register_script('wmb-color-picker', false);
            wp_enqueue_script('wmb-color-picker');
            wp_add_inline_script('wmb-color-picker', resource_content('js/wmb-color-picker.js'));
        });
    }
}
