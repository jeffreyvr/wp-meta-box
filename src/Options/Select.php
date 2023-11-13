<?php

namespace Jeffreyvr\WPMetaBox\Options;

class Select extends OptionAbstract
{
    public $view = 'select';

    public function get_options()
    {
        $options = $this->get_arg('options', []);

        if(is_callable($options)) {
            return $options();
        }

        return $options;
    }
}
