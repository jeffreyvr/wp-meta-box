jQuery(function($){
    $('.wmb-repeater-container').sortable({
        items: ".wmb-repeater-option-group",
        handle: ".wmb-drag",
      });

    $('.wmb-repeat').on('click', function(e) {
        e.preventDefault();

        let container = $(this).closest('.wmb-repeater').find('.wmb-repeater-container');

        wmb_dispatch_event('wmb-repeater-field-init', {container: container.get(0)});

        let count = container.find('.wmb-repeater-option-group').length;

        let clone = container.find('.wmb-repeater-option-group').first().clone();

        clone.find('input, textarea, select').each(function(){
            let name = $(this).attr('name');

            if(! name) {
                console.error('wmb-repeater: input, textarea, select must have a name attribute');
                return;
            }

            // Make sure these elements are unique / incremented
            $(this).attr('id', $(this).attr('id') + count);
            $(this).closest('label').attr('for', $(this).attr('for') + count);
            $(this).attr('name', name.replace('[0]', '['+count+']'));
        });

        container.append(wmb_clear_option_group_values(clone));

        wmb_delete_option_group();

        wmb_dispatch_event('wmb-repeater-field-created', {target: clone.get(0), container: container.get(0)});
    });

    wmb_delete_option_group();

    function wmb_delete_option_group() {
        $('.wmb-delete').off().on('click', function(e) {
            e.preventDefault();

            let container = $(this).closest('.wmb-repeater').find('.wmb-repeater-container');
            let count = container.find('.wmb-repeater-option-group').length;

            if(count===1) {
                wmb_clear_option_group_values($(this).closest('.wmb-repeater-option-group'));
            } else {
                $(this).closest('.wmb-repeater-option-group').remove();
            }

            wmb_dispatch_event('wmb-repeater-field-deleted', {container: container.get(0), target: $(this).closest('.wmb-repeater-option-group').get(0)});
        });
    }

    function wmb_clear_option_group_values(group) {
        group.find('input, textarea, select')
            .not(':checkbox, :radio')
            .val('');

        group.find('input').prop('checked', false)
        group.find('input').prop('selected', false);
        group.find('[wmb-media-library\\:preview]').html('');

        return group;
    }
});
