<?php if ($option->get_object_id()) { ?>
	<tr class="form-field term-<?php echo esc_attr($option->get_name_attribute()); ?>-wrap">
		<th scope="row">
			<label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>
		</th>
		<td>
			<div>
				<select id="<?php echo $option->get_id_attribute(); ?>" name="<?php echo esc_attr($option->get_name_attribute()); ?>" multiple>
					<?php foreach ($option->args['options'] as $key => $label) { ?>
						<option value="<?php echo $key; ?>" <?php echo in_array($key, $option->get_value_attribute()) ? 'selected' : null; ?>><?php echo $label; ?></option>
					<?php } ?>
				</select>

				<?php if ($description = $option->get_arg('description')) { ?>
					<p class="wmb-input-description"><?php echo $description; ?></p>
				<?php } ?>
			</div>
		</td>
	</tr>
<?php } else { ?>
	<div class="form-field term-<?php echo esc_attr($option->get_name_attribute()); ?>-wrap">
		<label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>

		<div>
			<select id="<?php echo $option->get_id_attribute(); ?>" name="<?php echo esc_attr($option->get_name_attribute()); ?>" multiple>
				<?php foreach ($option->args['options'] as $key => $label) { ?>
					<option value="<?php echo $key; ?>" <?php echo in_array($key, $option->get_value_attribute()) ? 'selected' : null; ?>><?php echo $label; ?></option>
				<?php } ?>
			</select>

			<?php if ($description = $option->get_arg('description')) { ?>
				<p class="wmb-input-description"><?php echo $description; ?></p>
			<?php } ?>
		</div>
	</div>
<?php } ?>