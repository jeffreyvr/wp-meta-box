jQuery(function($){
    $('.wbm-repeater-container').sortable({
        items: ".wbm-repeater-option-group",
        handle: ".wbm-drag",
      });

    $('.wbm-repeat').on('click', function(e) {
        e.preventDefault();

        let container = $(this).closest('.wbm-repeater').find('.wbm-repeater-container');

        let name = container.attr('wbm-repeater-name');

        let count = container.find('.wbm-repeater-option-group').length;

        console.log('counting ' + count + ' groups');

        let clone = container.find('.wbm-repeater-option-group').first().clone();

        clone.find('input, textarea').each(function(){
            $(this).attr('name', $(this).attr('name').replace('[0]', '['+count+']'));
        });

        container.append(wbm_clear_option_group_values(clone));

        wbm_delete_option_group();
    });

    wbm_delete_option_group();

    function wbm_delete_option_group() {
        $('.wbm-delete').off().on('click', function(e) {
            e.preventDefault();

            console.log('gettinh here');

            let container = $(this).closest('.wbm-repeater').find('.wbm-repeater-container');
            let count = container.closest('.wbm-repeater-option-group').length;

            if(count===1) {
                wbm_clear_option_group_values($(this).closest('.wbm-repeater-option-group'));
            } else {
                $(this).closest('.wbm-repeater-option-group').remove();
            }
        });
    }

    function wbm_clear_option_group_values(group) {
        group.find('input, textarea')
            .val('')
            .prop('checked', false)
            .prop('selected', false);
        return group;
    }
});