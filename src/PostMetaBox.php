<?php

namespace Jeffreyvr\WPMetaBox;

use Jeffreyvr\WPMetaBox\MetaBox;

class PostMetaBox extends MetaBox
{
    public $post_types;
    public $context = 'advanced';
    public $priority = 'default';

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

        return $this->set_post_types($post_types);
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
		$instance = WPMetaBox::instance();

        add_action('admin_enqueue_scripts', [$instance, 'enqueue_styling']);
        add_action('admin_enqueue_scripts', [$instance, 'enqueue_script']);

        add_action('add_meta_boxes', [$this, 'register']);
        add_action('save_post', [$this, 'save']);
    }

    public function add_option($type, $args = [])
    {
        $option = new PostOption($this, $type, $args);

        $this->options[] = $option;

        return $option;
    }
}
