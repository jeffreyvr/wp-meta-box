<div class="wmb-repeater">
    <div class="wmb-repeater-container" wmb-repeater-name="<?php echo $option->get_name(); ?>">
        <?php foreach($option->get_options() as $group_options) { ?>
            <div class="wmb-repeater-option-group">
                <div class="wmb-repeater-option-group-header">
                    <svg class="wmb-drag" width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" role="img" aria-hidden="true" focusable="false"><path d="M5 4h2V2H5v2zm6-2v2h2V2h-2zm-6 8h2V8H5v2zm6 0h2V8h-2v2zm-6 6h2v-2H5v2zm6 0h2v-2h-2v2z"></path></svg>

                    <button type="button" class="wmb-delete">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="-2 -2 24 24" width="24" height="24" role="img" aria-hidden="true" focusable="false"><path d="M12 4h3c.6 0 1 .4 1 1v1H3V5c0-.6.5-1 1-1h3c.2-1.1 1.3-2 2.5-2s2.3.9 2.5 2zM8 4h3c-.2-.6-.9-1-1.5-1S8.2 3.4 8 4zM4 7h11l-.9 10.1c0 .5-.5.9-1 .9H5.9c-.5 0-.9-.4-1-.9L4 7z"></path></svg>
                    </button>
                </div>
                <div class="wmb-repeater-option-group-content">
                    <?php foreach($group_options as $repeater_option) { ?>
                        <?php
                            do_action('wmb_before_option_render', $repeater_option);

                            echo $repeater_option->render();

                            do_action('wmb_after_option_render', $repeater_option);
                        ?>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <button type="button" class="wmb-repeat components-button is-secondary is-small"><?php echo $option->get_arg('repeater_add_button_text', '+ Add Row'); ?></button>
</div>
