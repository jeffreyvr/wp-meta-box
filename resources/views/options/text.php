<div class="wmb-input">
    <label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>
    <input name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>" type="text" style="" value="<?php echo $option->get_value_attribute(); ?>" class="">
</div>