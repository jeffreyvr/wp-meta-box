<div class="wmb-input">
    <label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>

    <div class="wmb-image-selector-container">
        <input name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>" type="hidden" value="<?php echo $option->get_value_attribute(); ?>" class="">

        <div class="wmb-image-selector-preview">
            <?php if ($option->get_value_attribute()) { ?>
                <?php echo $option->get_image_preview_url(); ?>
            <?php } ?>
        </div>

        <a href="#" onclick="return jQuery(this).wmb_image_selector();" class="button wmb-image-selector-trigger"><?php _e('Select Image'); ?></a>

        <?php if ($description = $option->get_arg('description')) { ?>
            <p class="wmb-input-description"><?php echo $description; ?></p>
        <?php } ?>
    </div>
</div>
