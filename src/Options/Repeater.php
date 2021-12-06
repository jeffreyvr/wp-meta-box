<?php

namespace Jeffreyvr\WPMetaBox\Options;

use Jeffreyvr\WPMetaBox\Option;
use Jeffreyvr\WPMetaBox\Options\OptionAbstract;

class Repeater extends OptionAbstract
{
    public $view = 'repeater';
    public $options = [];
    public $groups_set = false;

    public function __construct($section, $args = [])
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);

        parent::__construct($section, $args);
    }

    public function enqueue()
    {
        wp_enqueue_script( 'jquery-ui-sortable');
    }

    public function add_option($type, $args = [])
    {
        $option = new Option($this->meta_box, $type, $args);

        $this->options[] = $option;

        return $this;
    }

    public function save()
    {
        if ($value = $this->get_value_from_request()) {
            update_post_meta($this->get_post_id(), $this->get_name_attribute(), array_values($value));
        } else {
            delete_post_meta($this->get_post_id(), $this->get_name_attribute());
        }
    }

    public function group_options()
    {
        $groups = [];

        if (!empty($this->groups_set)) {
            return $this->groups_set;
        }

        $iterate = count($this->get_value_attribute());
        $count = 0;

        while($count != $iterate) {
            foreach ( $this->options as $option ) {
                $groups[$count][] = new Option($this->meta_box, $option->type, $option->args);
            }
            $count++;
        }

        // foreach (range(0, $iterate) as $option_number) {

        // }

        // foreach ($this->get_value_attribute() as $index => $group_options) {
        //     foreach ($group_options as $key => $value) {
        //         if ($option =$this->get_option_by_name($key)) {
        //             $groups[$index][] = new Option($this->meta_box, $option->type, $option->args);
        //         }
        //     }
        // }

        if (empty($groups)) {
            $groups[] = $this->options;

            $this->groups_set = $groups;

            return $groups;
        }

        $this->groups_set = $groups;

        return $groups;
    }

    public function get_option_by_name($name)
    {
        foreach ($this->options as $option) {
            if ($option->implementation->get_arg('name') === $name) {
                return $option;
            }
        }
        return false;
    }

    public function get_options()
    {
        $groups = $this->group_options();
        $repeater = $this;

        foreach ($groups as $index => $options) {
            foreach ($options as $option) {
                $option->implementation->set_custom_name($this->get_name_attribute() . '['.$index.']' . '[' . $option->implementation->get_arg('name') . ']');

                $option->implementation->set_custom_value(function($post_id) use ($repeater, $index, $option) {
                    return get_post_meta($post_id, $repeater->get_name_attribute(), true)[$index][$option->implementation->get_arg('name')];
                });
            }
        }

        return $groups;
    }

    public function get_option_index($name)
    {
        foreach ($this->group_options() as $index => $options) {
            foreach ($options as $option) {
                if ($option->implementation->get_arg('name') === $name) {
                    return $index;
                }
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
