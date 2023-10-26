<?php

namespace Jeffreyvr\WPMetaBox\Options;

use Jeffreyvr\WPMetaBox\Enqueuer;

use function Jeffreyvr\WPMetaBox\resource_content as resource_content;

class Media extends OptionAbstract
{
    public $view = 'media';

    public function __construct($section, $args = [])
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);

        parent::__construct($section, $args);
    }

    public function enqueue()
    {
        Enqueuer::add('wmb-media-library', function () {
            wp_enqueue_media();

            wp_register_script('wmb-media-library', false);
            wp_enqueue_script('wmb-media-library');
            wp_add_inline_script('wmb-media-library', resource_content('js/wmb-media-library.js'));
        });
    }

    public function media_library_options()
    {
        return [];
    }

    public function sanitize($value)
    {
        return $value;
    }

    public function get_file_name()
    {
        $url = wp_get_attachment_url($this->get_value_attribute());

        if (! $url) {
            return null;
        }

        return basename(parse_url($url, PHP_URL_PATH));
    }

    public function get_preview_url()
    {
        $value = $this->get_value_attribute();

        if (empty($value)) {
            return '';
        }

        $attachment = wp_get_attachment_metadata($value);
        $fallback = '/wp-includes/images/media/document.png';

        if (! $attachment) {
            return $fallback;
        }

        if (isset($attachment['image_meta'])) {
            return wp_get_attachment_image_src($value, 'thumbnail')[0];
        }

        if (strpos($attachment['mime_type'], 'video') !== false) {
            return '/wp-includes/images/media/video.png';
        }

        if (strpos($attachment['mime_type'], 'audio') !== false) {
            return '/wp-includes/images/media/audio.png';
        }

        return $fallback;
    }
}
