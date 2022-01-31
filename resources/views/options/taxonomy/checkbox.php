<?php if ($option->get_object_id()) { ?>
    <tr class="form-field term-<?php echo esc_attr($option->get_name_attribute()); ?>-wrap">
        <th scope="row">
            <label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>
        </th>
        <td>
            <input name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>" type="checkbox" value="<?php echo $option->get_value_attribute(); ?>" <?php echo $option->is_checked() ? 'checked' : null; ?>>

            <?php if ($description = $option->get_arg('description')) { ?>
                <p class="description"><?php echo $description; ?></p>
            <?php } ?>
        </td>
    </tr>
<?php } else { ?>
    <div class="form-field term-<?php echo esc_attr($option->get_name_attribute()); ?>-wrap">
        <label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>
        <input name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>" type="checkbox" value="<?php echo $option->get_value_attribute(); ?>" <?php echo $option->is_checked() ? 'checked' : null; ?>>

        <?php if ($description = $option->get_arg('description')) { ?>
            <p class="description"><?php echo $description; ?></p>
        <?php } ?>
    </div>
<?php } ?>