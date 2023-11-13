<select <?php echo $option->get_input_attributes_string(); ?>>
    <?php if($option->get_value_attribute()): ?>
        <option value="<?php echo $option->get_value_attribute(); ?>" selected><?php echo $option->get_value_label(); ?></option>
    <?php endif ?>
</select>
