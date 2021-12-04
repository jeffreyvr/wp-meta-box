<?php

namespace Jeffreyvr\WPMetaBox;

use Exception;
use Jeffreyvr\WPMetaBox\Options\Text;
use Jeffreyvr\WPMetaBox\Options\Select;
use Jeffreyvr\WPMetaBox\Options\Choices;
use Jeffreyvr\WPMetaBox\Options\Checkbox;
use Jeffreyvr\WPMetaBox\Options\CodeEditor;
use Jeffreyvr\WPMetaBox\Options\Repeater;
use Jeffreyvr\WPMetaBox\Options\Textarea;
use Jeffreyvr\WPMetaBox\Options\WPEditor;
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
            'select-multiple' => SelectMultiple::class,
            'wp-editor' => WPEditor::class,
            'code-editor' => CodeEditor::class,
            'repeater' => Repeater::class
        ]);

        if (empty($type_map[$this->type])) {
            throw new Exception("The {$type} option does not exist");
        }

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
