<?php

namespace Jeffreyvr\WPMetaBox\Options;

use Jeffreyvr\WPMetaBox\WPMetaBox;
use function Jeffreyvr\WPMetaBox\view as view;

abstract class OptionAbstract
{
    public $meta_box;
    public $args = [];
    public $view;

    public function __construct($args = [], $meta_box)
    {
        $this->args = $args;
        $this->meta_box = $meta_box;
    }

    public function get_value_from_request()
    {
        return $_REQUEST[$this->get_name_attribute()] ?? null;
    }

    public function get_post_id()
    {
        global $post;

        return $post->ID ?? false;
    }

    public function save()
    {
        update_post_meta($this->get_post_id(), $this->get_name_attribute(), $this->get_value_from_request());
    }

    public function render()
    {
        return view('options/' . $this->view, ['option' => $this]);
    }

    public function sanitize($value)
    {
        return sanitize_text_field($value);
    }

    public function validate($value)
    {
        return true;
    }

    public function get_arg($key, $fallback = null)
    {
        return $this->args[$key] ?? $fallback;
    }

    public function get_label()
    {
        return \esc_attr($this->get_arg('label'));
    }

    public function get_id_attribute()
    {
        return $this->get_arg('id', sanitize_title($this->get_name_attribute()));
    }

    public function get_name()
    {
        return $this->get_arg('name');
    }

    public function get_name_attribute()
    {
        return $this->meta_box->prefix . $this->get_arg('name');
    }

    public function get_value_attribute()
    {
        return get_post_meta($this->get_post_id(), $this->get_name_attribute(), true);
    }
}
