jQuery(function($){
    $('.wmb-repeater-container').sortable({
        items: ".wmb-repeater-option-group",
        handle: ".wmb-drag",
      });

    $('.wmb-repeat').on('click', function(e) {
        e.preventDefault();

        let container = $(this).closest('.wmb-repeater').find('.wmb-repeater-container');

        let count = container.find('.wmb-repeater-option-group').length;

        let clone = container.find('.wmb-repeater-option-group').first().clone();

        clone.find('input, textarea, select').each(function(){
            $(this).attr('name', $(this).attr('name').replace('[0]', '['+count+']'));
        });

        container.append(wmb_clear_option_group_values(clone));

        wmb_delete_option_group();

        wmb_dispatch_event('wmb-repeater-field-created', {target: clone.get(0)});
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
