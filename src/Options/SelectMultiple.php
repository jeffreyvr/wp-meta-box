<?php

namespace Jeffreyvr\WPMetaBox\Options;

use Jeffreyvr\WPMetaBox\Options\OptionAbstract;

class SelectMultiple extends OptionAbstract
{
    public $view = 'select-multiple';

    public function get_name_attribute()
    {
        $name = parent::get_name_attribute();

        return "{$name}[]";
    }

    public function get_value_from_request()
    {
        return $_REQUEST[parent::get_name_attribute()] ?? [];
    }
}
