<?php

namespace Jeffreyvr\WPMetaBox;

use Jeffreyvr\WPMetaBox\Option;

class WPMetaBox
{
    public $title;
    public $id;
    public $post_types;
    public $capability;
    public $options = [];

    public function __construct($title, $post_types = [])
    {
        $this->title = $title;
        $this->id = sanitize_title($this->title);

        $this->set_post_types($post_types);
    }

    public function set_capability($capability)
    {
        $this->capability = $capability;

        return $this;
    }

    public function set_post_type($post_type)
    {
        $post_types = $this->post_types;
        $post_types[] = $post_type;

        $this->set_post_types($post_types);
    }

    public function set_post_types($post_type)
    {
        $this->post_types = (array) $post_type;

        return $this;
    }

    public function get_post_types()
    {
        return $this->post_types;
    }

    public function make()
    {
        add_action('add_meta_boxes', [$this, 'register']);
        add_action('save_post', [$this, 'save']);
    }

    public function register()
    {
        foreach ($this->get_post_types() as $post_type) {
            add_meta_box(
                $this->id,
                $this->title,
                [$this, 'render'],
                $screen
            );
        }
    }

    public function user_has_capability()
    {
        return current_user_can($this->capability);
    }

    public function get_nonce()
    {
        return sanitize_title(str_replace('-', '_', $this->id)) . '_nonce';
    }

    public function add_option($type, $args = [])
    {
        $option = new Option($type, $args);

        $this->options[] = $option;

        return $option;
    }

    public function save($post_id)
    {
        if (! isset($_POST[$this->get_nonce()])) {
            return $post_id;
        }

        if (! wp_verify_nonce($_POST[$this->get_nonce()], str_replace('_nonce', '', $this->get_nonce()))) {
            return $post_id;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        // TODO: implement capability check.
        // TODO: implement saving.
        foreach ($this->options as $option) {
            $option->save();
        }
    }

    public function render()
    {
        foreach ($this->options as $option) {
            echo $option->render();
        }

        wp_nonce_field(str_replace('_nonce', '', $this->get_nonce()), $this->get_nonce());
    }
}
