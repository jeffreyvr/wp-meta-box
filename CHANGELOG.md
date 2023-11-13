# Changelog

All notable changes to `wp-meta-box` will be documented in this file

## Unreleased

## 0.3.0

- for taxonomy meta box, allow to set contexts (`create` and `edit`) to control when the options should be shown.
- allow repeater add button text to be overwritten through `repeater_add_button_text` argument.

## 0.2.1

- fix not being able to change the input type (Text)
- allow all input attributes to be set through `input_attributes`

## 0.2.0

- major refactor to allow for one view file per option, instead of two using a table and div base wrapper (potential breaking change)
- number, date and color now use the text view
- fixing repeatable fields work with taxonomies
- wp-editor and code-editor now work in repeatable fields
- wp-editor fields are now initliased through javascript, specificy editor / tinymce configuration needs to be passed differently (see README)

## 0.1.0

- first alpha release
