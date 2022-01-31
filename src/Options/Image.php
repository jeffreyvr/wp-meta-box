<?php

namespace Jeffreyvr\WPMetaBox\Options;

use Jeffreyvr\WPMetaBox\Options\OptionAbstract;

use Jeffreyvr\WPMetaBox\WPMetaBox;
use function Jeffreyvr\WPMetaBox\resource_content as resource_content;

class Image extends OptionAbstract
{
    public $view = 'image';

    public function __construct($section, $args = [])
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);

        parent::__construct($section, $args);
    }

    public function enqueue()
    {
        if (WPMetaBox::instance()->is_script_loaded('wbm-image-selector')) {
            return;
        }

        wp_register_script('wbm-image-selector', false);
        wp_enqueue_script('wbm-image-selector');
        wp_add_inline_script('wbm-image-selector', resource_content('js/wmb-image-selector.js'));

	    WPMetaBox::instance()->script_is_loaded('wbm-image-selector');
    }

    public function sanitize($value)
    {
        return $value;
    }

    public function get_image_preview_url()
    {
        return wp_get_attachment_image($this->get_value_attribute(), 'thumbnail');
    }

    public function get_image()
    {
        $id = $this->get_value_attribute();

        $urls = [];

        $sizes = get_intermediate_image_sizes();
        $sizes[] = 'full';

        foreach ($sizes as $size) {
            $image = wp_get_attachment_image_src($id, $size);
            $urls[] = $image[0];
        }

        return $urls;
    }
}
