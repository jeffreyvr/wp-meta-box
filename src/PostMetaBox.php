<?php

namespace Jeffreyvr\WPMetaBox;

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

    public function show_for_page_template($template)
    {
        $this->add_condition(function () use ($template) {
            global $post;

            $page_template = get_post_meta($post->ID, '_wp_page_template', true);

            if ($page_template != $template) {
                return false;
            }

            return true;
        });

        return $this;
    }

    public function register()
    {
        if (! $this->should_register()) {
            return;
        }

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

        do_action('wmb_after_post_meta_box_save', $post_id, $this);
    }

    public function render($post)
    {
        Enqueuer::enqueue();

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

        add_action('admin_enqueue_scripts', [$instance, 'enqueue_scripts']);

        add_action('add_meta_boxes', [$this, 'register']);
        add_action('save_post', [$this, 'save']);
    }

    public function add_option($type, $args = [])
    {
        $option = new PostOption($this, $type, $args);

        $this->options[] = $option;

        return $option;
    }

    public function add_callback($callback)
    {
        $callbackOption = new CallbackOption($callback);

        $this->options[] = $callbackOption;

        return $callbackOption;
    }

    public function add_note($html)
    {
        return $this->add_html("<div class=\"wmb-note\">{$html}</div>");
    }

    public function add_html($html)
    {
        $htmlOption = new HtmlOption($html);

        $this->options[] = $htmlOption;

        return $htmlOption;
    }
}
