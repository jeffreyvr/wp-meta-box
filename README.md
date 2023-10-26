# WP Meta Box

This package aims to make it easier to create meta boxes for WordPress plugins.

> ⚠️ Untill the first stable release, the API is subject to change. Use at your own risk.

## Installation

```bash
composer require jeffreyvanrossum/wp-meta-box
```

## Usage

### Basic example

```php
use Jeffreyvr\WPMetaBox\WPMetaBox;

$meta_box = WPMetaBox::post('Post settings')
    ->set_post_type('post');

$meta_box->add_option('text', [
    'name' => 'name_of_option',
    'label' => __('Label of option', 'textdomain'),
    'description' => __('Some additional description', 'textdomain')
]);

$meta_box->make();

// Or for taxonomies:
$meta_box = WPMetaBox::taxonomy('Taxonomy settings')
    ->set_taxonomies(['category']);
```

### Available types

#### Text

```php
$meta_box->add_option('text', [
    'name' => 'name_of_option',
    'label' => __('Label of option', 'textdomain')
]);
```

#### Date

```php
$meta_box->add_option('date', [
    'name' => 'name_of_option',
    'label' => __('Label of option', 'textdomain')
]);
```

#### Number

```php
$meta_box->add_option('number', [
    'name' => 'name_of_option',
    'label' => __('Label of option', 'textdomain')
]);
```

#### Textarea

```php
$meta_box->add_option('textarea', [
    'name' => 'name_of_option',
    'label' => __('Label of option', 'textdomain')
]);
```

#### Checkbox

```php
$meta_box->add_option('checkbox', [
    'name' => 'name_of_option',
    'label' => __('Label of option', 'textdomain')
]);
```

#### Choices (radio buttons)

```php
$meta_box->add_option('checkbox', [
    'name' => 'name_of_option',
    'label' => __('Label of option', 'textdomain'),
    'options' => [
        1 => 'option 1',
        2 => 'option 2'
    ]
]);
```

#### Color

```php
$meta_box->add_option('color', [
    'name' => 'name_of_option',
    'label' => __('Label of option', 'textdomain')
]);
```

#### Select

```php
$meta_box->add_option('select', [
    'name' => 'name_of_option',
    'label' => __('Label of option', 'textdomain'),
    'options' => [
        1 => 'option 1',
        2 => 'option 2'
    ]
]);
```

#### Select multiple

```php
$meta_box->add_option('select-multiple', [
    'name' => 'name_of_option',
    'label' => __('Label of option', 'textdomain'),
    'options' => [
        1 => 'option 1',
        2 => 'option 2'
    ]
]);
```

#### Media

```php
$meta_box->add_option('media', [
    'name' => 'name_of_option',
    'label' => __('Label of option', 'textdomain')
]);
```

#### Image

```php
$meta_box->add_option('image', [
    'name' => 'name_of_option',
    'label' => __('Label of option', 'textdomain')
]);
```

#### Code editor

```php
$meta_box->add_option('code-editor', [
    'name' => 'name_of_option',
    'label' => __('Label of option', 'textdomain')
]);
```

#### WP Editor

```php
$meta_box->add_option('wp-editor', [
    'name' => 'name_of_option',
    'label' => __('Label of option', 'textdomain')
]);
```

You can provide a `config` array to customize the editor. For more information on this config check out the [wp.editor documentation](https://codex.wordpress.org/Javascript_Reference/wp.editor).

#### Repeater

Example of a gallery using the repeater option:

```php
$meta_box->add_option('repeater', [
    'name' => 'gallery',
    'label' => __('Gallery', 'textdomain'),
])->add_repeater_option('image', [
    'name' => 'image',
    'label' => __('Image', 'textdomain'),
]);
```

## Contributors
* [Jeffrey van Rossum](https://github.com/jeffreyvr)
* [All contributors](https://github.com/jeffreyvr/wp-meta-box/graphs/contributors)

## License
MIT. Please see the [License File](/LICENSE) for more information.
