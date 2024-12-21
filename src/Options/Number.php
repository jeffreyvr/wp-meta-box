<?php

namespace Jeffreyvr\WPMetaBox\Options;

class Number extends OptionAbstract
{
    public $view = 'text';

    public function __construct($args, $meta_box)
    {
        $this->default_args['type'] = 'number';

        parent::__construct($args, $meta_box);
    }

    public function get_input_attributes_string($attributes = [])
    {
        if ($this->get_arg('min') !== null) {
            $attributes['min'] = $this->get_arg('min');
        }

        if ($this->get_arg('max') !== null) {
            $attributes['max'] = $this->get_arg('max');
        }

        return parent::get_input_attributes_string($attributes);
    }
}
