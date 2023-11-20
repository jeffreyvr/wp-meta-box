jQuery(function ($) {

    document.addEventListener('wmb-repeater-field-init', function () {
        wmb_select2_destroy_all();
    })

    document.addEventListener('wmb-repeater-field-created', function (e) {
        let selects = document.querySelectorAll('[wmb-select2]');

        wmb_select2_init(selects);
    })

    function wmb_select2_destroy_all() {
        let selects = document.querySelectorAll('[wmb-select2]');

        for (let select of selects) {
            $(select).select2('destroy');
        }
    }

    function wmb_select2_init(selects) {
        for (let select of selects) {
            let config = {};

            if (select.getAttribute('wmb-select2')) {
                let customConfig = JSON.parse(select.getAttribute('wmb-select2'));

                config = Object.assign(config, customConfig);
            }

            // Convert every string inside config.language to a function that returns that string
            if (config.language) {
                for (let key in config.language) {
                    if (typeof config.language[key] === 'string') {
                        let string = config.language[key];
                        config.language[key] = function () {
                            return string;
                        };
                    }
                }
            }

            if (config._is_using_ajax) {
                config.ajax = {
                    url: ajaxurl,
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term,
                            action: select.getAttribute('wmb-select2:action')
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
                };
            }

            $(select).select2(config);
        }
    }

    let selects = document.querySelectorAll('[wmb-select2]');

    wmb_select2_init(selects);
})
