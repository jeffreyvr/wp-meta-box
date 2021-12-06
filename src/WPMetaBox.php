<?php

namespace Jeffreyvr\WPMetaBox;

use Jeffreyvr\WPMetaBox\Option;

class WPMetaBox
{
    public $title;
    public $id;
    public $post_types;
    public $prefix = '_';
    public $capability = 'edit_posts';
    public $context = 'advanced';
    public $priority = 'default';
    public $options = [];
    public $styling = true;
    public $loaded_scripts = [];

    public function __construct($title, $post_types = [])
    {
        $this->title = $title;
        $this->id = sanitize_title($this->title);
        $this->set_post_types($post_types);
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
        wp_register_style('wp-meta-box', false);
        wp_enqueue_style('wp-meta-box');

        wp_add_inline_style('wp-meta-box', resource_content('css/wp-meta-box.css'));
    }

    public function enqueue_script()
    {
        wp_register_script('wp-meta-box', false);
        wp_enqueue_script('wp-meta-box');

        wp_add_inline_script('wp-meta-box', resource_content('js/wp-meta-box.js'));
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

    public function set_context($context)
    {
        $this->context = $context;

        return $this;
    }

    public function set_priority($priority)
    {
        $this->priority = $priority;

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

    public function register()
    {
        foreach ($this->get_post_types() as $post_type) {
            add_meta_box(
                $this->id,
                $this->title,
                [$this, 'render'],
                $post_type,
                $this->context,
                $this->priority
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
        $option = new Option($this, $type, $args);

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

        if (! current_user_can($this->capability)) {
            return $post_id;
        }

        foreach ($this->options as $option) {
            $option->save();
        }
    }

    public function render($post)
    {
        foreach ($this->options as $option) {
            do_action('wmb_before_option_render', $option);

            echo $option->render();

            do_action('wmb_after_option_render', $option);
        }

        wp_nonce_field(str_replace('_nonce', '', $this->get_nonce()), $this->get_nonce());
    }

    public function make()
    {
        if ($this->styling) {
            add_action('admin_enqueue_scripts', [$this, 'enqueue_styling']);
        }

        add_action('admin_enqueue_scripts', [$this, 'enqueue_script']);

        add_action('add_meta_boxes', [$this, 'register']);
        add_action('save_post', [$this, 'save']);
    }
}
