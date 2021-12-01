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
    public $strategy;

    public function __construct($meta_box, $type, $args = [])
    {
        $this->meta_box = $meta_box;
        $this->type = $type;
        $this->args = $args;

        if ($this->type === 'text') {
            $this->strategy = new Text($this->args, $this->meta_box);
        } elseif ($this->type === 'textarea') {
            $this->strategy = new Textarea($this->args, $this->meta_box);
        } elseif ($this->type === 'checkbox') {
            $this->strategy = new Checkbox($this->args, $this->meta_box);
        } elseif ($this->type === 'choices') {
            $this->strategy = new Choices($this->args, $this->meta_box);
        } elseif ($this->type === 'select') {
            $this->strategy = new Select($this->args, $this->meta_box);
        } elseif ($this->type === 'select-multiple') {
            $this->strategy = new SelectMultiple($this->args, $this->meta_box);
        } else {
            throw new Exception('Type does not exist');
        }
    }

    public function save()
    {
        return $this->strategy->save();
    }

    public function render()
    {
        echo $this->strategy->render();
    }
}
