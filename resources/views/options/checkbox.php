<input type="checkbox" <?php echo $option->get_input_attributes_string(['value' => $option->get_value_attribute()]); ?>
     <?php echo $option->is_checked() ? 'checked' : null; ?>>
