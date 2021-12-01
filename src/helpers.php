<?php

namespace Jeffreyvr\WPMetaBox;

use Jeffreyvr\WPMetaBox\WPMetaBox;

if (! function_exists('view')) {
    function view($file, $variables = [])
    {
        foreach ($variables as $name => $value) {
            ${$name} = $value;
        }

        $full_path = apply_filters('wp_meta_box_view_file_path', __DIR__ . "/../resources/views/{$file}.php");

        if (! file_exists($full_path)) {
            return;
        }

        ob_start();

        include $full_path;

        echo apply_filters('wp_meta_box_render_view', ob_get_clean(), $file, $variables);
    }
}

if (! function_exists('resource_content')) {
    function resource_content($file)
    {
        $full_path = __DIR__ . "/../resources/{$file}";

        if (! file_exists($full_path)) {
            return;
        }

        return file_get_contents( $full_path );
    }
}