(function ($) {
    if ($('.sdi-tab-filter').length > 0) {
        $('.sdi-tab-group').each(function () {
            $(this).find('.sdi-tab:first').addClass('sdi-active');
        });

        // init Isotope
        var $grid = $('.sdi-demo-box-wrap').imagesLoaded(function () {
            $grid.isotope({
                itemSelector: '.sdi-demo-box',
            });
        });

        // store filter for each group
        var filters = {};

        $('.sdi-tab-group').on('click', '.sdi-tab', function (event) {
            var $button = $(event.currentTarget);
            // get group key
            var $buttonGroup = $button.parents('.sdi-tab-group');
            var filterGroup = $buttonGroup.attr('data-filter-group');
            // set filter for group
            filters[ filterGroup ] = $button.attr('data-filter');
            // combine filters
            var filterValue = concatValues(filters);
            // set filter for Isotope
            $grid.isotope({filter: filterValue});
        });

        // change is-checked class on buttons
        $('.sdi-tab-group').each(function (i, buttonGroup) {
            var $buttonGroup = $(buttonGroup);
            $buttonGroup.on('click', '.sdi-tab', function (event) {
                $buttonGroup.find('.sdi-active').removeClass('sdi-active');
                var $button = $(event.currentTarget);
                $button.addClass('sdi-active');
            });
        });

        // flatten object by concatting values
        function concatValues(obj) {
            var value = '';
            for (var prop in obj) {
                value += obj[ prop ];
            }
            return value;
        }
    }

    $('.sdi-modal-button').on('click', function (e) {
        e.preventDefault();
        $('body').addClass('sdi-modal-opened');
        var modalId = $(this).attr('href');
        $(modalId).fadeIn();

        $("html, body").animate({scrollTop: 0}, "slow");
    });

    $('.sdi-modal-back, .sdi-modal-cancel').on('click', function (e) {
        $('body').removeClass('sdi-modal-opened');
        $('.sdi-modal').hide();
        $("html, body").animate({scrollTop: 0}, "slow");
    });

    $('body').on('click', '.sdi-import-demo', function () {
        var $el = $(this);
        var demo = $(this).attr('data-demo-slug');
        var reset = $('#checkbox-reset-' + demo).is(':checked');
        var reset_message = '';

        if (reset) {
            reset_message = sdi_ajax_data.reset_database;
            var confirm_message = 'Are you sure to proceed? Resetting the database will delete all your contents.';
        } else {
            var confirm_message = 'Are you sure to proceed?';
        }

        $import_true = confirm(confirm_message);
        if ($import_true == false)
            return;

        $("html, body").animate({scrollTop: 0}, "slow");

        $('#sdi-modal-' + demo).hide();
        $('#sdi-import-progress').show();

        $('#sdi-import-progress .sdi-import-progress-message').html(sdi_ajax_data.prepare_importing).fadeIn();

        var info = {
            demo: demo,
            reset: reset,
            next_step: 'sdi_install_demo',
            next_step_message: reset_message
        };

        setTimeout(function () {
            do_ajax(info);
        }, 2000);
    });

    function do_ajax(info) {
        console.log(info);
        if (info.next_step) {
            var data = {
                action: info.next_step,
                demo: info.demo,
                reset: info.reset,
                security: sdi_ajax_data.nonce
            };

            jQuery.ajax({
                url: ajaxurl,
                type: 'post',
                data: data,
                beforeSend: function () {
                    if (info.next_step_message) {
                        $('#sdi-import-progress .sdi-import-progress-message').hide().html('').fadeIn().html(info.next_step_message);
                    }
                },
                success: function (response) {
                    var info = JSON.parse(response);

                    if (!info.error) {
                        if (info.complete_message) {
                            $('#sdi-import-progress .sdi-import-progress-message').hide().html('').fadeIn().html(info.complete_message);
                        }
                        setTimeout(function () {
                            do_ajax(info);
                        }, 2000);
                    } else {
                        $('#sdi-import-progress .sdi-import-progress-message').html(info.error_message);
                        $('#sdi-import-progress').addClass('import-error');

                    }
                },
                error: function (xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    $('#sdi-import-progress .sdi-import-progress-message').html(sdi_ajax_data.import_error);
                    $('#sdi-import-progress').addClass('import-error');
                }
            });
        } else {
            $('#sdi-import-progress .sdi-import-progress-message').html(sdi_ajax_data.import_success);
            $('#sdi-import-progress').addClass('import-success');
        }
    }
})(jQuery);
