
<select <?php echo $option->get_input_attributes_string(); ?> multiple>
    <?php foreach ($option->args['options'] as $key => $label) { ?>
        <option value="<?php echo $key; ?>" <?php echo in_array($key, $option->get_value_attribute()) ? 'selected' : null; ?>><?php echo $label; ?></option>
    <?php } ?>
</select>
