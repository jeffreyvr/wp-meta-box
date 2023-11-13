<?php

namespace Jeffreyvr\WPMetaBox\Options;

use Jeffreyvr\WPMetaBox\Enqueuer;

use function Jeffreyvr\WPMetaBox\resource_content;

class SelectFilter extends Select
{
    public $view = 'select-filter';

    public function __construct($section, $args = [])
    {
        $action = "wmb_select_filter_".$this->generate_hash();

        $this->default_args['input_attributes'] = [
            'wmb-select-filter',
            // 'wmb-select-filter:config' => [],
            'wmb-select-filter:action' => $action,
        ];

        parent::__construct($section, $args);

        add_action('wp_ajax_' . $action, $this->get_arg('ajax_callback'));

        add_action('admin_enqueue_scripts', [$this, 'enqueue']);
    }

    public function get_value_label()
    {
        return is_callable($this->args['value_callback']) ? $this->args['value_callback']($this) : null;
    }

    public function enqueue()
    {
        Enqueuer::add('wmb-select-filter', function () {
            wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css');
            wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js', ['jquery']);

            wp_add_inline_script('wmb-select2', resource_content('js/wmb-select2.js'));
        });
    }
}
