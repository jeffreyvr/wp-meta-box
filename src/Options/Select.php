<?php

namespace Jeffreyvr\WPMetaBox\Options;

use Jeffreyvr\WPMetaBox\Options\OptionAbstract;

class Select extends OptionAbstract
{
    public $view = 'select';

    public function get_options()
    {
        return $this->get_arg('options', []);
    }
}
