<?php

namespace Jeffreyvr\WPMetaBox\Options;

class Date extends OptionAbstract
{
    public $view = 'text';

    public function __construct($args, $meta_box)
    {
        $this->default_args['type'] = 'date';

        parent::__construct($args, $meta_box);
    }
}
