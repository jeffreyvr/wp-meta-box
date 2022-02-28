<?php if ($option->get_object_id()) { ?>
    <tr class="form-field term-<?php echo esc_attr($option->get_name_attribute()); ?>-wrap">
        <th scope="row">
            <label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>
        </th>
        <td>
            <textarea name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_value_attribute(); ?></textarea>

            <?php if ($description = $option->get_arg('description')) { ?>
                <p class="description"><?php echo $description; ?></p>
            <?php } ?>
        </td>
    </tr>
<?php } else { ?>
    <div class="form-field term-<?php echo esc_attr($option->get_name_attribute()); ?>-wrap">
        <label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>
        <textarea name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_value_attribute(); ?></textarea>

        <?php if ($description = $option->get_arg('description')) { ?>
            <p class="description"><?php echo $description; ?></p>
        <?php } ?>
    </div>
<?php } ?>