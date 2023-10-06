<div class="wmb-input">
    <label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>

    <div wmb-media-library="<?php echo esc_attr(wp_json_encode($option->media_library_options())); ?>">
        <input name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>" type="hidden" value="<?php echo $option->get_value_attribute(); ?>" class="">

        <div wmb-media-library:preview>
            <?php if ($option->get_value_attribute()) { ?>
                <div>
                    <img src="<?php echo $option->get_preview_url(); ?>" />
                    <?php if($option instanceof Jeffreyvr\WPMetaBox\Options\Image === false) { ?>
                        <?php echo $option->get_file_name(); ?>
                    <?php } ?>
                </div>
            <?php } ?>

            <button type="button" class="components-button is-secondary is-small" style="margin: 5px 0;" wmb-media-library:unset>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 15px; height: 15px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>

                <?php _e('Remove'); ?>
            </button>
        </div>

        <button type="button" class="components-button is-secondary is-small" wmb-media-library:open><?php _e('Select'); ?></button>

        <?php if ($description = $option->get_description()) { ?>
            <p class="wmb-input-description"><?php echo $description; ?></p>
        <?php } ?>
    </div>
</div>
