<?php

namespace Jeffreyvr\WPMetaBox\Options;

class Image extends Media
{
    public function media_library_options()
    {
        return [
            'title' => 'Select image',
            'button' => [
                'text' => 'Select image',
            ],
            'library' => [
                'type' => 'image',
            ],
        ];
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
