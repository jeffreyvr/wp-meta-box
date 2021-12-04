<div class="wmb-input wbm-repeater">
    <label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>

    <div>
        <?php foreach($option->get_options() as $repeater_option) { ?>
            <?php echo $repeater_option->render(); ?>
        <?php } ?>
    </div>
</div>
