<?php if ($option->get_object_id()) { ?>
    <tr class="form-field term-<?php echo esc_attr($option->get_name_attribute()); ?>-wrap">
        <th scope="row">
            <label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>
        </th>
        <td>
            <div class="wmb-image-selector-container">
                <input name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>" type="hidden" value="<?php echo $option->get_value_attribute(); ?>" class="">

                <div class="wmb-image-selector-preview">
			        <?php if ($option->get_value_attribute()) { ?>
				        <?php echo $option->get_image_preview_url(); ?>
			        <?php } ?>
                </div>

                <a href="#" onclick="return jQuery(this).wmb_image_selector();" class="button wmb-image-selector-trigger"><?php _e('Select Image'); ?></a>

		        <?php if ($description = $option->get_description()) { ?>
                    <p class="wmb-input-description"><?php echo $description; ?></p>
		        <?php } ?>
            </div>
        </td>
    </tr>
<?php } else { ?>
    <div class="form-field term-<?php echo esc_attr($option->get_name_attribute()); ?>-wrap">
        <label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>

        <div class="wmb-image-selector-container">
            <input name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>" type="hidden" value="<?php echo $option->get_value_attribute(); ?>" class="">

            <div class="wmb-image-selector-preview">
			    <?php if ($option->get_value_attribute()) { ?>
				    <?php echo $option->get_image_preview_url(); ?>
			    <?php } ?>
            </div>

            <a href="#" onclick="return jQuery(this).wmb_image_selector();" class="button wmb-image-selector-trigger"><?php _e('Select Image'); ?></a>

		    <?php if ($description = $option->get_description()) { ?>
                <p class="wmb-input-description"><?php echo $description; ?></p>
		    <?php } ?>
        </div>
    </div>
<?php } ?>
