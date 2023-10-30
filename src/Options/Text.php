<?php

namespace Jeffreyvr\WPMetaBox\Options;

class Text extends OptionAbstract
{
    public $view = 'text';

    public function __construct($args, $meta_box)
    {
        $this->default_args['type'] = 'text';

        parent::__construct($args, $meta_box);
    }
}
