<?php

namespace Jeffreyvr\WPMetaBox;

use Exception;
use Jeffreyvr\WPMetaBox\Options\Text;
use Jeffreyvr\WPMetaBox\Options\Select;
use Jeffreyvr\WPMetaBox\Options\Choices;
use Jeffreyvr\WPMetaBox\Options\Checkbox;
use Jeffreyvr\WPMetaBox\Options\Textarea;
use Jeffreyvr\WPMetaBox\Options\SelectMultiple;

class Option
{
    public $meta_box;
    public $type;
    public $args;
    public $implementation;

    public function __construct($meta_box, $type, $args = [])
    {
        $this->meta_box = $meta_box;
        $this->type = $type;
        $this->args = $args;

        $type_map = apply_filters('wp_meta_box_option_type_map', [
            'text' => Text::class,
            'checkbox' => Checkbox::class,
            'choices' => Choices::class,
            'textarea' => Textarea::class,
            'select' => Select::class,
            'select-multiple' => SelectMultiple::class
        ]);

        $this->implementation = new $type_map[$this->type]($this->args, $this->meta_box);
    }

    public function save()
    {
        return $this->implementation->save();
    }

    public function render()
    {
        echo $this->implementation->render();
    }
}
