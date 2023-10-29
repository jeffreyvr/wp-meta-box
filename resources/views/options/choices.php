
<div>
    <?php foreach ($option->get_arg('options', []) as $key => $label) { ?>
        <div>
            <label>
                <input <?php echo $option->get_input_attributes_string(); ?> type="radio" value="<?php echo $key; ?>" <?php checked($key, $option->get_value_attribute()); ?>>
                <?php echo $label; ?>
            </label>
        </div>
    <?php } ?>
</div>
