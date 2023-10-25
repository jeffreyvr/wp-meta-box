<?php

namespace Jeffreyvr\WPMetaBox\Options;

use Jeffreyvr\WPMetaBox\Options\OptionAbstract;

class Text extends OptionAbstract
{
    public $view = 'text';

    public function __construct($args, $meta_box)
    {
        parent::__construct($args, $meta_box);

        $this->args['type'] = 'text';
    }
}
