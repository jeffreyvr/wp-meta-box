<?php

namespace Jeffreyvr\WPMetaBox;

class WPMetaBox
{
    public $styling = true;

    public $loaded_scripts = [];

    private static $instance;

    public $styling_loaded = false;

    public $scripts_loaded = false;

    public ?Enqueuer $enqueuer = null;

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
        if (! self::$instance instanceof WPMetaBox) {
            self::$instance = new WPMetaBox();
        }

        return self::$instance;
    }

    public function __construct()
    {
        $this->enqueuer = Enqueuer::setEnqueueManager(new EnqueueManager);
    }

    public function disable_styling()
    {
        $this->styling = false;

        return $this;
    }

    public function enqueue_scripts()
    {
        Enqueuer::add('wp-meta-box', function () {
            wp_register_script('wp-meta-box', false);
            wp_enqueue_script('wp-meta-box');

            wp_add_inline_script('wp-meta-box', resource_content('js/wp-meta-box.js'));

            wp_register_style('wp-meta-box', false);
            wp_enqueue_style('wp-meta-box');

            wp_add_inline_style('wp-meta-box', resource_content('css/wp-meta-box.css'));
        });
    }
}
