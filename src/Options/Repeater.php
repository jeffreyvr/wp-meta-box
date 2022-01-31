<?php

namespace Jeffreyvr\WPMetaBox\Options;

use Jeffreyvr\WPMetaBox\Option;
use Jeffreyvr\WPMetaBox\Options\OptionAbstract;
use Jeffreyvr\WPMetaBox\PostMetaBox;
use Jeffreyvr\WPMetaBox\TaxonomyMetaBox;
use Jeffreyvr\WPMetaBox\TaxonomyOption;

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
        $value = array_filter($this->get_value_from_request(), function($group) {
            return array_filter($group);
        });

        if ($value) {
            update_post_meta($this->get_object_id(), $this->get_name_attribute(), array_values($value));
        } else {
            delete_post_meta($this->get_object_id(), $this->get_name_attribute());
        }
    }

    public function group_options()
    {
        $groups = [];

        if (!empty($this->groups_set)) {
            return $this->groups_set;
        }

        $value = $this->get_value_attribute();

        $iterate = !empty($value) ? count($value) : 1;
        $count = 0;

        while($count != $iterate) {
            foreach ( $this->options as $option ) {
                if($this->meta_box instanceof TaxonomyMetaBox) {
                    $groups[$count][] = new TaxonomyOption($this->meta_box, $option->type, $option->args);
                } else {
                    $groups[$count][] = new PostMetaBox($this->meta_box, $option->type, $option->args);
                }
            }
            $count++;
        }

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

                $option->implementation->set_custom_value(function($object_id) use ($repeater, $index, $option) {
                    if($option instanceof TaxonomyOption) {
                        $repeater_value = get_term_meta($object_id, $repeater->get_name_attribute(), true);
                    } else {
                        $repeater_value = get_post_meta($object_id, $repeater->get_name_attribute(), true);
                    }

                    return $repeater_value[$index][$option->implementation->get_arg('name')] ?? null;
                });
            }
        }

        return $groups;
    }
}
