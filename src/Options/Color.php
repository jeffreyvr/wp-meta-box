<?php

namespace Jeffreyvr\WPMetaBox\Options;

use Jeffreyvr\WPMetaBox\Options\OptionAbstract;

class Color extends OptionAbstract
{
	public $view = 'color';

	public function __construct($section, $args = [])
	{
		add_action('admin_enqueue_scripts', [$this, 'enqueue']);

		parent::__construct($section, $args);
	}

	public function enqueue()
	{
		wp_enqueue_style( 'wp-color-picker' );
	}
}
