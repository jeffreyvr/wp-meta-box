
<select <?php echo $option->get_input_attributes_string(); ?>>
    <?php foreach ($option->get_options() as $key => $label) { ?>
        <option value="<?php echo $key; ?>" <?php selected($option->get_value_attribute(), $key); ?>><?php echo $label; ?></option>
    <?php } ?>
</select>
