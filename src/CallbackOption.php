<?php

namespace Jeffreyvr\WPMetaBox;

class CallbackOption
{
    public \Closure $callback;

    public function __construct($callback)
    {
        $this->callback = $callback;
    }

    public function save()
    {
        //
    }

    public function render()
    {
        $callback = $this->callback;

        return $callback();
    }
}
