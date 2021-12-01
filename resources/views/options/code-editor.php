<div class="wmb-input">
    <label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>

    <div>
        <div class="wmb-code-editor">
            <textarea name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>" class="wp-settings-code-editor"><?php echo wp_unslash($option->get_value_attribute()); ?></textarea>
        </div>

        <?php if ($description = $option->get_arg('description')) { ?>
            <p class="wmb-input-description"><?php echo $description; ?></p>
        <?php } ?>
    </div>
</div>