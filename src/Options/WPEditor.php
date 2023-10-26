<?php

namespace Jeffreyvr\WPMetaBox\Options;

use Jeffreyvr\WPMetaBox\Enqueuer;

use function Jeffreyvr\WPMetaBox\resource_content;

class WPEditor extends OptionAbstract
{
    public $view = 'wp-editor';

    public function __construct($args, $meta_box)
    {
        parent::__construct($args, $meta_box);

        add_action('admin_enqueue_scripts', [$this, 'enqueue']);
    }

    public function enqueue()
    {
        Enqueuer::add('wmb-wp-editor', function () {
            wp_enqueue_editor();
            wp_enqueue_script('wp-theme-plugin-editor');

            wp_add_inline_script('wp-theme-plugin-editor', resource_content('js/wmb-wp-editor.js'));
        });
    }

    public function get_id_attribute()
    {
        return parent::get_id_attribute() . '-' . esc_attr(wp_generate_password(6, false, false));
    }

    public function get_input_attributes_string($attributes = [])
    {
        $attributes = wp_parse_args([
            'id' => $this->get_id_attribute(),
            'name' => $this->get_name_attribute(),
        ], $attributes);

        if ($class = $this->get_css('input_class')) {
            $attributes['class'] = $class;
        }

        if ($class = $this->get_css('input_class')) {
            $attributes['class'] = $class;
        }

        $attributes['wmb-wp-editor'] = wp_json_encode($this->get_arg('config', []));

        return implode(' ', array_map(function ($key, $value) {
            return $key.'="'.esc_attr($value).'"';
        }, array_keys($attributes), $attributes));
    }

    public function sanitize($value)
    {
        return $value;
    }
}
