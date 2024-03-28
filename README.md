<p align="center"><a href="https://vanrossum.dev" target="_blank"><img src="https://raw.githubusercontent.com/jeffreyvr/vanrossum.dev-art/main/logo.svg" width="320" alt="vanrossum.dev Logo"></a></p>

<p align="center">
<a href="https://packagist.org/packages/jeffreyvanrossum/wp-meta-box"><img src="https://img.shields.io/packagist/dt/jeffreyvanrossum/wp-meta-box" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/jeffreyvanrossum/wp-meta-box"><img src="https://img.shields.io/packagist/v/jeffreyvanrossum/wp-meta-box" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/jeffreyvanrossum/wp-meta-box"><img src="https://img.shields.io/packagist/l/jeffreyvanrossum/wp-meta-box" alt="License"></a>
</p>

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

- [Text](#text)
- [Date](#date)
- [Number](#number)
- [Textarea](#textarea)
- [Checkbox](#checkbox)
- [Choices (Radio Buttons)](#choices-radio-buttons)
- [Color](#color)
- [Select](#select)
- [Select2](#select2)
- [Media](#media)
- [Image](#image)
- [Code Editor](#code-editor)
- [WP Editor](#wp-editor)
- [Repeater](#repeater)

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

You can allow multiple values too.

```php
$meta_box->add_option('select', [
    'name' => 'name_of_option',
    'label' => __('Label of option', 'textdomain'),
    'multiple' => true,
    'options' => [
        1 => 'option 1',
        2 => 'option 2'
    ]
]);
```

### Select2

Select2 gives you a customizable select box with support for searching.

You can use `select2` the same way you use the regular `select`.

```php
$meta_box->add_option('select2', [
    'name' => 'name_of_option',
    'label' => __('Label of option', 'textdomain'),
    'options' => [
        1 => 'option 1',
        2 => 'option 2'
    ]
]);
```

If you would like to search the options through ajax, you can do this by defining two callbacks (or function names). One for fetching and filtering the options and one for getting the value callback.

The below example is using select2 to select a page.

```php
$meta_box->add_option('select2', [
    'name' => 'name_of_option',
    'label' => __('Label of option', 'textdomain'),
    'ajax' => [
        'value' => function($pageId) {
            return get_the_title($pageId) ?? null;
        },
        'action' => function() {
            $results = array_reduce(get_posts(['post_type' => 'page', 's' => $_GET['q']]), function($item, $page) {
                $item[$page->ID] = $page->post_title;

                return $item;
            }, []);

            echo json_encode($results);

            die();
        }
    ]
]);
```

You may allow multiple values by settings the `multiple` value in `config` to true. If you want to use the ajax functionality here, be sure to define value callback here as well.

```php
$meta_box->add_option('select2', [
    'name' => 'name_of_option',
    'label' => __('Label of option', 'textdomain'),
    'multiple' => true,
    'ajax' => [
        'value' => function($ids) {
            foreach($ids as $id) {
                $titles[$id] = get_the_title($id) ?? $id;
            }
            return $titles ?? [];
        },
        'action' => function() {
            $results = array_reduce(get_posts(['post_type' => 'page', 's' => $_GET['q']]), function($item, $page) {
                $item[$page->ID] = $page->post_title;

                return $item;
            }, []);

            echo json_encode($results);

            die();
        }
    ]
]);
```

You can pass anything you'd like to the select2 configuration using `config`, the exception being the ajax part of the configuration.

A list of options can be found [here](https://select2.org/configuration/options-api).

The Select2 that comes with the package is loaded from the Cloudflare CDN. You can overwrite this using the `wmb_select2_assets` filter hook.

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

- [Jeffrey van Rossum](https://github.com/jeffreyvr)
- [All contributors](https://github.com/jeffreyvr/wp-meta-box/graphs/contributors)

## License

MIT. Please see the [License File](/LICENSE) for more information.
