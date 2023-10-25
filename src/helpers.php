<?php

namespace Jeffreyvr\WPMetaBox;

use Jeffreyvr\WPMetaBox\WPMetaBox;

if (! function_exists('view')) {
    function view($file, $variables = [], $buffer = false)
    {
        extract($variables);

        $full_path = apply_filters('wp_meta_box_view_file_path', __DIR__ . "/../resources/views/{$file}.php");

        if (! file_exists($full_path)) {
            return;
        }

        ob_start();

        include $full_path;

        $output = ob_get_clean();

        $result = apply_filters('wp_meta_box_render_view', $output, $file, $variables);

        if($buffer) {
            return $result;
        }

        echo $result;
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
