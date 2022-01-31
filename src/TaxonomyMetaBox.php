<?php

namespace Jeffreyvr\WPMetaBox;

use Jeffreyvr\WPMetaBox\MetaBox;

class TaxonomyMetaBox extends MetaBox
{
    public $taxonomies = [];

    public function set_taxonomy($taxonomy)
    {
        $taxonomy = $this->taxonomies;
        $taxonomies[] = $taxonomy;

        $this->set_taxonomies($taxonomies);
    }

    public function set_taxonomies($taxonomy)
    {
        $this->taxonomies = (array) $taxonomy;

        return $this;
    }

    public function get_taxonomies()
    {
        return $this->taxonomies;
    }

    public function register()
    {
        foreach ($this->get_taxonomies() as $taxonomy) {
            add_action("{$taxonomy}_edit_form_fields", [$this, 'render'], 10, 2);
            add_action("{$taxonomy}_add_form_fields", [$this, 'render']);
            add_action("created_{$taxonomy}", [$this, 'save']);
            add_action("edited_{$taxonomy}", [$this, 'save']);
        }
    }

    public function save($term_id)
    {
        if (! current_user_can($this->capability)) {
            return $term_id;
        }

        foreach ($this->options as $option) {
            $option->save();
        }
    }

    public function render($term, $taxonomy = null)
    {
        if (! current_user_can($this->capability)) {
            return $term_id;
        }

        foreach ($this->options as $option) {
            do_action('wmb_before_option_render', $option);

            echo $option->render();

            do_action('wmb_after_option_render', $option);
        }
    }

    public function make()
    {
	    $instance = WPMetaBox::instance();

	    if ($this->styling) {
		    add_action('admin_enqueue_scripts', [$instance, 'enqueue_styling']);
	    }

	    add_action('admin_enqueue_scripts', [$instance, 'enqueue_script']);

        $this->register();
    }

    public function add_option($type, $args = [])
    {
        $option = new TaxonomyOption($this, $type, $args);

        $this->options[] = $option;

        return $option;
    }
}
