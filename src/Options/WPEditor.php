<?php

namespace Jeffreyvr\WPMetaBox\Options;

class WPEditor extends OptionAbstract
{
    public $view = 'wp-editor';

    public function sanitize($value)
    {
        return $value;
    }
}
