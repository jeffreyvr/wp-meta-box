<?php

namespace Jeffreyvr\WPMetaBox;

use Jeffreyvr\WPMetaBox\Option;
use Jeffreyvr\WPMetaBox\PostMetaBox;
use Jeffreyvr\WPMetaBox\TaxonomyMetaBox;

class WPMetaBox
{
    public $styling = true;
    public $loaded_scripts = [];
    private static $instance;
    public $styling_loaded = false;
    public $scripts_loaded = false;

    public static function taxonomy($title)
    {
        return new TaxonomyMetaBox($title);
    }

    public static function post($title)
    {
        return new PostMetaBox($title);
    }

    public static function instance()
    {
        if (!self::$instance instanceof WPMetaBox) {
            self::$instance = new WPMetaBox();
        }

        return self::$instance;
    }

    public function disable_styling()
    {
        $this->styling = false;

        return $this;
    }

    public function script_is_loaded($script)
    {
        $this->loaded_scripts[] = $script;

        return $this;
    }

    public function is_script_loaded($script)
    {
        return in_array($script, $this->loaded_scripts);
    }

    public function enqueue_styling()
    {
        if ($this->styling_loaded) {
            return;
        }

        wp_register_style('wp-meta-box', false);
        wp_enqueue_style('wp-meta-box');

        wp_add_inline_style('wp-meta-box', resource_content('css/wp-meta-box.css'));

        $this->styling_loaded = true;
    }

    public function enqueue_script()
    {
        if ($this->scripts_loaded) {
            return;
        }

        wp_register_script('wp-meta-box', false);
        wp_enqueue_script('wp-meta-box');

        wp_add_inline_script('wp-meta-box', resource_content('js/wp-meta-box.js'));

        $this->scripts_loaded = true;
    }
}
