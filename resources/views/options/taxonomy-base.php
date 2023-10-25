
<tr class="form-field term-<?php echo esc_attr($option->get_name_attribute()); ?>-wrap <?php echo $option->get_group_class_attribute(); ?>">
    <th scope="row">
        <label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>
    </th>
    <td>
        <?php echo $slot; ?>

        <?php if ($description = $option->get_description()) { ?>
            <p class="description"><?php echo $description; ?></p>
        <?php } ?>
    </td>
</tr>
