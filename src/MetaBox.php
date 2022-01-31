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

    public function __construct($title)
    {
        $this->title = $title;
        $this->id = sanitize_title($this->title);
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
