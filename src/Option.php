<?php

namespace Jeffreyvr\WPMetaBox;

use Exception;
use Jeffreyvr\WPMetaBox\Options\Date;
use Jeffreyvr\WPMetaBox\Options\Text;
use Jeffreyvr\WPMetaBox\Options\Color;
use Jeffreyvr\WPMetaBox\Options\Image;
use Jeffreyvr\WPMetaBox\Options\Number;
use Jeffreyvr\WPMetaBox\Options\Select;
use Jeffreyvr\WPMetaBox\Options\Choices;
use Jeffreyvr\WPMetaBox\Options\Checkbox;
use Jeffreyvr\WPMetaBox\Options\Repeater;
use Jeffreyvr\WPMetaBox\Options\Textarea;
use Jeffreyvr\WPMetaBox\Options\WPEditor;
use Jeffreyvr\WPMetaBox\Options\CodeEditor;
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
            'date' => Date::class,
            'number' => Number::class,
            'checkbox' => Checkbox::class,
            'choices' => Choices::class,
            'textarea' => Textarea::class,
            'select' => Select::class,
            'select-multiple' => SelectMultiple::class,
            'wp-editor' => WPEditor::class,
            'code-editor' => CodeEditor::class,
            'repeater' => Repeater::class,
            'image' => Image::class,
            'color' => Color::class
        ]);

        if (empty($type_map[$this->type])) {
            throw new Exception("The {$type} option does not exist");
        }

        $this->implementation = new $type_map[$this->type]($this->args, $this->meta_box);
    }

    public function save($object_id = null)
    {
        return $this->implementation->save($object_id);
    }

    public function render()
    {
        echo $this->implementation->render();
    }

    public function add_repeater_option($name, $args)
    {
        if ($this->implementation instanceof Repeater) {
            $this->implementation->add_option($name, $args);
        }

        return $this;
    }
}
