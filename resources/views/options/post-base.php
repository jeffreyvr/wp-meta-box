<div class="wmb-input <?php echo $option->get_group_class_attribute(); ?>">
    <label
        for="<?php echo $option->get_id_attribute(); ?>"
        class="<?php echo $option->get_label_class_attribute(); ?>"><?php echo $option->get_label(); ?></label>

    <div>
        <?php echo $slot; ?>

        <?php if ($description = $option->get_description()) { ?>
            <p class="wmb-input-description"><?php echo $description; ?></p>
        <?php } ?>
    </div>
</div>
