<?php

namespace Jeffreyvr\WPMetaBox\Options;

use Jeffreyvr\WPMetaBox\Enqueuer;

use function Jeffreyvr\WPMetaBox\resource_content;

class Select2 extends Select
{
    public $view = 'select2';

    public function __construct($section, $args = [])
    {
        parent::__construct($section, $args);

        $this->input_attributes['wmb-select2'] = $this->get_config();

        if ($this->is_multiple()) {
            $this->input_attributes['multiple'] = 'multiple';
        }

        if ($this->is_using_ajax()) {
            $action = "wmb_select2_".$this->generate_hash();

            $this->input_attributes['wmb-select2:action'] = $action;

            add_action('wp_ajax_' . $action, [$this, 'handle_action']);
        }

        add_action('admin_enqueue_scripts', [$this, 'enqueue']);
    }

    public function is_using_ajax()
    {
        return !empty($this->args['ajax']);
    }

    public function is_multiple()
    {
        return $this->get_arg('config')['multiple'] ?? false;
    }

    public function get_name_attribute()
    {
        $name = parent::get_name_attribute();

        if ($this->is_multiple()) {
            return "{$name}[]";
        }

        return $name;
    }

    public function get_value_from_request()
    {
        return $_REQUEST[parent::get_name_attribute()] ?? [];
    }

    public function get_value_attribute()
    {
        if (! $this->is_multiple()) {
            return parent::get_value_attribute();
        }

        $value = parent::get_value_attribute();

        if (empty($value)) {
            return [];
        }

        return (array) $value;
    }

    public function get_config()
    {
        $default = [
            'placeholder' => __('Select an option'),
            'allowClear' => true,
            'minimumInputLength' => 2,
            'width' => '100%',
            '_is_using_ajax' => $this->is_using_ajax()
        ];

        return array_merge($default, $this->get_arg('config', []));
    }

    public function get_value_label()
    {
        if (isset($this->args['ajax']['value']) && is_callable($this->args['ajax']['value'])) {
            return call_user_func($this->args['ajax']['value'], $this->get_value_attribute(), $this);
        }

        return null;
    }

    public function handle_action()
    {
        if (! current_user_can($this->meta_box->capability)) {
            return;
        }

        if (isset($this->args['ajax']['action']) && is_callable($this->args['ajax']['action'])) {
            return call_user_func($this->args['ajax']['action'], $this);
        }

        return null;
    }

    public function enqueue()
    {
        Enqueuer::add('wmb-select2', function () {
            $select2_assets = apply_filters('wmb_select2_assets', [
                'js' => 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js',
                'css' => 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css'
            ]);

            wp_enqueue_style('wmb-select2', $select2_assets['css']);
            wp_enqueue_script('wmb-select2', $select2_assets['js'], ['jquery']);

            wp_add_inline_script('wmb-select2', resource_content('js/wmb-select2.js'));
        });
    }
}
