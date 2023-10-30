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
}
