<?php if ($option->get_object_id()) { ?>
	<tr class="form-field term-<?php echo esc_attr($option->get_name_attribute()); ?>-wrap">
		<th scope="row">
			<label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>
		</th>
		<td>
			<div>
				<select name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>">
					<?php foreach ($option->get_options() as $key => $label) { ?>
						<option value="<?php echo $key; ?>" <?php selected($option->get_value_attribute(), $key); ?>><?php echo $label; ?></option>
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
			<select name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>">
				<?php foreach ($option->get_options() as $key => $label) { ?>
					<option value="<?php echo $key; ?>" <?php selected($option->get_value_attribute(), $key); ?>><?php echo $label; ?></option>
				<?php } ?>
			</select>

			<?php if ($description = $option->get_arg('description')) { ?>
				<p class="wmb-input-description"><?php echo $description; ?></p>
			<?php } ?>
		</div>
	</div>
<?php } ?>