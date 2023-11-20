
<select <?php echo $option->get_input_attributes_string(); ?>>

    <?php if( !empty($option->get_value_label())) : ?>

        <?php if($option->is_multiple()) : ?>
            <?php foreach ($option->get_value_label() as $value => $label) { ?>
                <option value="<?php echo $value; ?>" selected="selected"><?php echo $label; ?></option>
            <?php } ?>
        <?php else: ?>
            <option value="<?php echo $option->get_value_attribute(); ?>" selected="selected"><?php echo $option->get_value_label(); ?></option>
        <?php endif; ?>

    <?php else: ?>

        <?php if($option->is_multiple()) : ?>
            <?php foreach ($option->get_options() as $key => $label) { ?>
                <option value="<?php echo $key; ?>" <?php echo in_array($key, $option->get_value_attribute()) ? 'selected' : ''; ?>><?php echo $label; ?></option>
            <?php } ?>
        <?php else: ?>
            <?php foreach ($option->get_options() as $key => $label) { ?>
                <option value="<?php echo $key; ?>" <?php selected($option->get_value_attribute(), $key); ?>><?php echo $label; ?></option>
            <?php } ?>
        <?php endif; ?>

    <?php endif; ?>

</select>
