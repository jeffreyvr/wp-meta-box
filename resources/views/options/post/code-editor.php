<div class="wmb-input">
    <label for="<?php echo $option->get_id_attribute(); ?>"><?php echo $option->get_label(); ?></label>

    <div>
        <div class="wmb-code-editor">
            <textarea name="<?php echo esc_attr($option->get_name_attribute()); ?>" id="<?php echo $option->get_id_attribute(); ?>"><?php echo wp_unslash($option->get_value_attribute()); ?></textarea>
        </div>

        <?php if ($description = $option->get_arg('description')) { ?>
            <p class="wmb-input-description"><?php echo $description; ?></p>
        <?php } ?>
    </div>

    <script>
        jQuery(function($){
            wp.codeEditor.initialize($("#<?php echo $option->get_id_attribute(); ?>"), <?php echo $option->code_mirror_settings_name; ?>);

            wp.data.subscribe(function () {
                $("#<?php echo $option->get_id_attribute(); ?>").next(".CodeMirror").get(0).CodeMirror.save();
            });
        });
    </script>
</div>
