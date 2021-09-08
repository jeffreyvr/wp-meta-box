*THIS PACKAGE IS STILL UNDER DEVELOPMENT, DO NOT USE YET.*

# WP Meta Box

This package aims to make it easier to create meta boxes for WordPress plugins.

## Installation

```bash
composer require jeffreyvanrossum/wp-meta-box
```

## Usage

### Basic example

```php
use Jeffreyvr\WPMetaBox\WPMetaBox;

$meta_box = new WPMetaBox(__('My meta box name'));

$meta_box->add_option('text', [
    'name' => 'name_of_option',
    'label' => __('Label of option', 'textdomain')
]);

$meta_box->make();
```

## Contributors
* [Jeffrey van Rossum](https://github.com/jeffreyvr)
* [All contributors](https://github.com/jeffreyvr/wp-meta-box/graphs/contributors)

## License
MIT. Please see the [License File](/LICENSE) for more information.