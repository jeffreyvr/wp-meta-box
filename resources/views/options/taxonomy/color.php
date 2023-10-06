<?php if ($option->get_object_id()) { ?>
	<tr class="form-field term-<?php echo esc_attr($option->get_name_attribute()); ?>-wrap">
		<th scope="row">
			<label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>
		</th>
		<td>
			<input name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>" type="text" style="" value="<?php echo $option->get_value_attribute(); ?>" class="wmb-color-picker">

			<?php if ($description = $option->get_description()) { ?>
				<p class="wmb-input-description"><?php echo $description; ?></p>
			<?php } ?>
		</td>
	</tr>
<?php } else { ?>
	<div class="form-field term-<?php echo esc_attr($option->get_name_attribute()); ?>-wrap">
		<label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>

		<div>
			<input name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>" type="text" style="" value="<?php echo $option->get_value_attribute(); ?>" class="wmb-color-picker">

			<?php if ($description = $option->get_description()) { ?>
				<p class="wmb-input-description"><?php echo $description; ?></p>
			<?php } ?>
		</div>
	</div>
<?php } ?>
