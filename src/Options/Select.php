<?php

namespace Jeffreyvr\WPMetaBox\Options;

class Select extends OptionAbstract
{
    public $view = 'select';

    public function __construct($section, $args = [])
    {
        parent::__construct($section, $args);

        if ($this->is_multiple()) {
            $this->input_attributes['multiple'] = 'multiple';
        }
    }

    public function is_multiple()
    {
        return $this->get_arg('multiple', false);
    }

    public function get_options()
    {
        $options = $this->get_arg('options', []);

        if(is_callable($options)) {
            return $options();
        }

        return $options;
    }

    public function get_name_attribute()
    {
        $name = parent::get_name_attribute();

        if ($this->is_multiple()) {
            return "{$name}[]";
        }

        return $name;
    }

    public function get_value_from_request()
    {
        return $_REQUEST[parent::get_name_attribute()] ?? [];
    }

    public function get_value_attribute()
    {
        if (! $this->is_multiple()) {
            return parent::get_value_attribute();
        }

        $value = parent::get_value_attribute();

        if (empty($value)) {
            return [];
        }

        return (array) $value;
    }
}
