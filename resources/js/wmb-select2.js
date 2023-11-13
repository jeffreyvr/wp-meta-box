jQuery(function ($) {
    let selects = document.querySelectorAll('[wmb-select-filter\\:action]');

    console.log(selects);

    for (let select of selects) {
        $(select).select2({
            placeholder: 'Select an option',
            allowClear: true,
            ajax: {
                url: ajaxurl,
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        action: select.getAttribute('wmb-select-filter:action')
                    };
                },
                processResults: function (data) {
                    var options = [];
                    if (data) {
                        $.each(data, function (index, text) {
                            options.push({ id: index, text: text });
                        });
                    }
                    return {
                        results: options
                    };
                },
                cache: true
            },
            minimumInputLength: 2
        });
    }

})
