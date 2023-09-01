(function ($, elementor) {
    "use strict";

    var MTSE = {
        init: function () {
            var widgets = {
                "ms-slider-widget.default": MTSE.Slider,
                "ms-product-tabs-grid.default": MTSE.Tabs,
                "ms-product-category-tab.default": MTSE.Tabs,
                "ms-countdown.default": MTSE.Countdown,
                "ms-testimonial-slider.default": MTSE.TestimonialSlider,
            };

            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction("frontend/element_ready/" + widget, callback);
            });
        },

        Slider: function ($scope) {
            var $element = $scope.find('.ms-slider');
            if ($element.length > 0) {
                $element.each(function () {
                    var slider = $(this);
                    var params = JSON.parse(slider.attr('data-slider'));
                    slider.owlCarousel({
                        items: 1,
                        loop: true,
                        autoplay: JSON.parse(params.autoplay),
                        autoplayTimeout: params.pause,
                        nav: JSON.parse(params.nav),
                        dots: JSON.parse(params.dots),
                        navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>'],
                        responsive: {
                            0: {
                                margin: params.margin_mobile,
                            },
                            480: {
                                margin: params.margin_tablet,
                            },
                            769: {
                                margin: params.margin,
                            }
                        }
                    });
                });
            }
        },
        Tabs: function ($scope) {
            var tabs = $scope.find(".ms-product-tabs-grid");

            if (tabs.length > 0) {
                tabs.each(function (index, tab) {
                    $(tab).find('.tabs li').click(function (e) {
                        e.preventDefault();
                        let id = $(this).data('id');

                        $(this).siblings().removeClass('active');
                        $(this).parents('.ms-product-tabs-grid').find('.products').removeClass('active');

                        $(this).addClass('active');
                        $(this).parents('.ms-product-tabs-grid').find('#' + id).addClass('active');
                    });
                });
            }
        },
        Countdown: function ($scope) {
            var countdowns = $scope.find(".ms-countdown");

            if (countdowns.length > 0) {
                countdowns.each(function () {
                    var ctDown = $(this),
                            countdown_data = ctDown.data('countdown'),
                            cDate = new Date(countdown_data.date);

                    ctDown.countdown(cDate).on('update.countdown', function (event) {
                        var format = '%H:%M:%S';

                        var html = `<ul>`;
                        if (countdown_data.text.show_year) {
                            html += `<li><span class="label">${countdown_data.text.year}</span><span class="value">%Y</span></li>`;
                        }

                        if (countdown_data.text.show_month) {
                            html += `<li><span class="label">${countdown_data.text.month}</span><span class="value">%m</span></li>`;
                        }

                        if (countdown_data.text.show_week) {
                            html += `<li><span class="label">${countdown_data.text.week}</span><span class="value">`;
                            if (countdown_data.text.show_month) {
                                html += `%W`;
                            } else {
                                html += `%w`;
                            }
                            html += `</span></li>`;
                        }

                        if (countdown_data.text.show_day) {
                            html += `<li><span class="label">${countdown_data.text.day}</span><span class="value">`;
                            if (countdown_data.text.show_week || countdown_data.text.show_year || countdown_data.text.show_month) {
                                html += `%d`;
                            } else {
                                html += `%D`;
                            }
                            html += `</span></li>`;
                        }

                        if (countdown_data.text.show_hours) {
                            html += `<li><span class="label">${countdown_data.text.hour}</span><span class="value">%H</span></li>`;
                        }

                        if (countdown_data.text.show_minutes) {
                            html += `<li><span class="label">${countdown_data.text.minute}</span><span class="value">%M</span></li>`;
                        }

                        if (countdown_data.text.show_seconds) {
                            html += `<li><span class="label">${countdown_data.text.second}</span><span class="value">%S</span></li>`;
                        }

                        html += `</ul>`;


                        $(this).html(event.strftime(html));
                    }).on('finish.countdown', function (event) {
                        var complete_msg = countdown_data.complete_msg;
                        ctDown.addClass('complete').text(complete_msg);
                    });
                });
            }
        },
        TestimonialSlider: function ($scope) {
            var tsliders = $scope.find(".ms-testimonial-slider");

            if (tsliders.length > 0) {
                tsliders.each(function () {
                    var tslider = $(this);
                    var slider_data = tslider.data('slider');

                    tslider.owlCarousel({
                        items: 1,
                        loop: true,
                        autoplay: JSON.parse(slider_data.autoplay),
                        autoplayTimeout: slider_data.pause,
                        nav: false,
                        dots: JSON.parse(slider_data.show_dots),
                    });
                });
            }
        },
    };
    $(window).on("elementor/frontend/init", MTSE.init);
})(jQuery, window.elementorFrontend);
  