<?php

namespace Jeffreyvr\WPMetaBox;

class HtmlOption
{
    public string $html;

    public function __construct($html)
    {
        $this->html = $html;
    }

    public function render()
    {
        return $this->html;
    }
}
