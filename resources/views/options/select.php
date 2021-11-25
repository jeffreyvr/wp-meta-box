<div class="wmb-input">
    <label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>

    <select name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>">
        <?php foreach ($option->get_options() as $key => $label) { ?>
            <option value="<?php echo $key; ?>" <?php selected($option->get_value_attribute(), $key); ?>><?php echo $label; ?></option>
        <?php } ?>
    </select>
</div>