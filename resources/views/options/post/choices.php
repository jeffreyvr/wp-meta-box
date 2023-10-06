<div class="wmb-input">
    <label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>

    <div>
        <div>
            <?php foreach ($option->get_arg('options', []) as $key => $label) { ?>
                <div>
                    <label>
                        <input name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>" type="radio" value="<?php echo $key; ?>" <?php checked($key, $option->get_value_attribute()); ?>>
                        <?php echo $label; ?>
                    </label>
                </div>
            <?php } ?>
        </div>

        <?php if ($description = $option->get_description()) { ?>
            <p class="wmb-input-description"><?php echo $description; ?></p>
        <?php } ?>
    </div>
</div>
