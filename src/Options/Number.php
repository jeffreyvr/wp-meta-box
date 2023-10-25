<?php

namespace Jeffreyvr\WPMetaBox\Options;

class Number extends OptionAbstract
{
    public $view = 'text';

    public function __construct($args, $meta_box)
    {
        parent::__construct($args, $meta_box);

        $this->args['type'] = 'number';
    }
}
