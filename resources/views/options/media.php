<div wmb-media-library="<?php echo esc_attr(wp_json_encode($option->media_library_options())); ?>">
    <input <?php echo $option->get_input_attributes_string(['value' => $option->get_value_attribute()]); ?> type="hidden">

    <div wmb-media-library:preview>
        <?php if ($option->get_value_attribute()) { ?>
            <img src="<?php echo $option->get_preview_url(); ?>" />
            <?php if($option instanceof Jeffreyvr\WPMetaBox\Options\Image === false) { ?>
                <?php echo $option->get_file_name(); ?>
            <?php } ?>
        <?php } ?>
    </div>

    <div style="display: flex; align-items: center; gap: 5px; margin: 5px 0;">
        <button type="button" class="components-button is-secondary is-small" style="display: flex; align-items: center; gap: 2px;" wmb-media-library:unset>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 15px; height: 15px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>

            <?php _e('Remove'); ?>
        </button>

        <button type="button" class="components-button is-secondary is-small" wmb-media-library:open><?php _e('Select'); ?></button>
    </div>
</div>
