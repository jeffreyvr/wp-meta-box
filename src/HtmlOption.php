<?php

namespace Jeffreyvr\WPMetaBox;

class HtmlOption
{
    public string $html;

    public function __construct($html)
    {
        $this->html = $html;
    }

    public function save()
    {
        //
    }

    public function render()
    {
        return $this->html;
    }
}
