<?php

namespace Jeffreyvr\WPMetaBox;

class Option
{
    public function __construct($type, $args = [])
    {
        $this->type = $type;
        $this->args = $args;
    }

    public function save()
    {
        // TODO: implement save logic.
    }

    public function render()
    {
        echo 'Here a ' . $this->type . ' is rendered<br>';
        // TODO: implement render logic.
    }
}