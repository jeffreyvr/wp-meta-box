<?php

namespace Jeffreyvr\WPMetaBox\Options;

use Jeffreyvr\WPMetaBox\PostMetaBox;
use Jeffreyvr\WPMetaBox\TaxonomyMetaBox;

use function Jeffreyvr\WPMetaBox\view as view;

abstract class OptionAbstract
{
    public $meta_box;

    public $args = [];

    public $default_args = [];

    public $input_attributes = [];

    public $view;

    public $custom_name = false;

    public $custom_value = false;

    public function __construct($args, $meta_box)
    {
        $this->args = array_merge($this->default_args, $args);

        $this->meta_box = $meta_box;

        $this->input_attributes = $this->get_arg('input_attributes', [
            'id' => $this->get_id_attribute(),
            'name' => $this->get_name_attribute(),
        ]);
    }

    public function get_value_from_request()
    {
        return $_REQUEST[$this->get_name_attribute()] ?? null;
    }

    public function get_object_id()
    {
        if ($this->meta_box instanceof TaxonomyMetaBox) {
            return $this->get_term_id();
        }

        return $this->get_post_id();
    }

    public function get_term_id()
    {
        return $_REQUEST['tag_ID'] ?? null;
    }

    public function get_post_id()
    {
        global $post;

        return $post->ID ?? false;
    }

    public function save($object_id = null)
    {
        if ($this->meta_box instanceof PostMetaBox) {
            $this->savePost();
        } elseif ($this->meta_box instanceof TaxonomyMetaBox) {
            $this->saveTaxonomy($object_id);
        }
    }

    public function savePost()
    {
        if ($value = $this->get_value_from_request()) {
            update_post_meta($this->get_object_id(), $this->get_name_attribute(), $value);
        } else {
            delete_post_meta($this->get_object_id(), $this->get_name_attribute());
        }
    }

    public function saveTaxonomy($object_id)
    {
        if ($value = $this->get_value_from_request()) {
            update_term_meta($object_id, $this->get_name_attribute(), $value);
        } else {
            delete_term_meta($object_id, $this->get_name_attribute());
        }
    }

    public function render()
    {
        $type = ($this->meta_box instanceof TaxonomyMetaBox && $this->get_arg('_parent') === null) ? 'taxonomy' : 'post';

        return view('options/'.$type.'-base', [
            'slot' => view('options/'.$this->view, ['option' => $this], true),
            'option' => $this,
        ], true);
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

    public function get_description()
    {
        if (is_callable($this->get_arg('description'))) {
            return $this->get_arg('description')($this);
        }

        return $this->get_arg('description');
    }

    public function get_label()
    {
        return \esc_attr($this->get_arg('label'));
    }

    public function get_input_attributes_string($attributes = [])
    {
        if ($class = $this->get_css('input_class')) {
            $attributes['class'] = $class;
        }

        if ($type = $this->get_arg('type')) {
            $attributes['type'] = $type;
        }

        if ($this->get_arg('required')) {
            $attributes['required'] = 'required';
        }

        $attributes = wp_parse_args($this->input_attributes, $attributes);

        return implode(' ', array_map(function ($key, $value) {
            return $key.'="'.esc_attr($value).'"';
        }, array_keys($attributes), $attributes));
    }

    public function get_id_attribute()
    {
        return $this->get_arg('id', sanitize_title($this->get_name_attribute()));
    }

    public function get_css($key = null)
    {
        if ($key) {
            return esc_attr($this->get_arg('css', [])[$key] ?? null);
        }

        return $this->get_arg('css', []);
    }

    public function get_label_class_attribute()
    {
        return $this->get_css('label_class');
    }

    public function get_group_class_attribute()
    {
        return $this->get_css('group_class');
    }

    public function get_input_class_attribute()
    {
        return $this->get_css('input_class');
    }

    public function get_name()
    {
        return $this->get_arg('name');
    }

    public function set_custom_name($name)
    {
        $this->custom_name = $name;

        return $this;
    }

    public function set_custom_value($value)
    {
        $this->custom_value = $value;

        return $this;
    }

    public function get_name_attribute()
    {
        if ($this->custom_name) {
            return $this->custom_name;
        }

        return apply_filters(
            'wmb_name_attribute_'.spl_object_hash($this),
            $this->meta_box->prefix.$this->get_arg('name'),
            $this->get_object_id(),
            $this->get_arg('name')
        );
    }

    public function get_taxonomy_value_attribute()
    {
        return apply_filters(
            'wmb_value_attribute_'.spl_object_hash($this),
            get_term_meta($this->get_object_id(), $this->get_name_attribute(), true),
            $this->get_object_id(),
            $this->get_arg('name')
        );
    }

    public function get_post_value_attribute()
    {
        return apply_filters(
            'wmb_value_attribute_'.spl_object_hash($this),
            get_post_meta($this->get_object_id(), $this->get_name_attribute(), true),
            $this->get_object_id(),
            $this->get_arg('name')
        );
    }

    public function get_value_attribute()
    {
        if (is_callable($this->custom_value)) {
            return call_user_func($this->custom_value, $this->get_object_id(), $this->get_arg('name'));
        }

        if ($this->meta_box instanceof TaxonomyMetaBox) {
            return $this->get_taxonomy_value_attribute();
        }

        return $this->get_post_value_attribute();
    }
}
