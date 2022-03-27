<?php

namespace Jeffreyvr\WPMetaBox;

use Jeffreyvr\WPMetaBox\Option;
use Jeffreyvr\WPMetaBox\PostMetaBox;
use Jeffreyvr\WPMetaBox\TaxonomyMetaBox;

class MetaBox
{
    public $title;
    public $id;
    public $prefix = '_';
    public $capability = 'edit_posts';
    public $options = [];
    public $conditions = [];

    public function __construct($title)
    {
        $this->title = $title;
        $this->id = sanitize_title($this->title);
    }

    public function register()
    {
        if ($this->conditions) {
            foreach ($this->conditions as $condition) {
                if (! $condition()) {
                    return;
                }
            }
        }
    }

    public function set_conditions($conditions)
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function add_condition($condition)
    {
        $conditions = $this->conditions;

        $conditions[] = $condition;

        $this->conditions = $conditions;

        return $this;
    }

    public function set_prefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function set_capability($capability)
    {
        $this->capability = $capability;

        return $this;
    }

    public function user_has_capability()
    {
        return current_user_can($this->capability);
    }

    public function get_nonce()
    {
        return sanitize_title(str_replace('-', '_', $this->id)) . '_nonce';
    }
}
