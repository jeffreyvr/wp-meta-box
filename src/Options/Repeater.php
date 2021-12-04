<?php

namespace Jeffreyvr\WPMetaBox\Options;

use Jeffreyvr\WPMetaBox\Option;
use Jeffreyvr\WPMetaBox\Options\OptionAbstract;

class Repeater extends OptionAbstract
{
    public $view = 'repeater';
    public $options = [];

    public function add_option($type, $args = [])
    {
        $option = new Option($this->meta_box, $type, $args);

        add_filter('wmb_name_attribute_'.$option->implementation->get_arg('name'), [$this, 'get_custom_option_name_attribute'], 10, 3);
        add_filter('wmb_value_attribute_'.$option->implementation->get_arg('name'), [$this, 'get_custom_option_value_attribute'], 10, 3);

        $this->options[] = $option;

        return $this;
    }

    public function get_options()
    {
        return $this->options;
    }

    public function get_option_index($name)
    {
        foreach ($this->options as $index => $option) {
            if ($option->implementation->get_arg('name') === $name) {
                return $index;
            }
        }
        return false;
    }

    public function get_custom_option_name_attribute($value, $post_id, $name)
    {
        return $this->get_name_attribute() . '['.$this->get_option_index($name).']' . '[' . $name . ']';
    }

    public function get_custom_option_value_attribute($value, $post_id, $name)
    {
        return get_post_meta($post_id, $this->get_name_attribute(), true)[$this->get_option_index($name)][$name];
    }
}
