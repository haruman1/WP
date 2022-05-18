;
(function ($) {
    var WidgetjupitercoreTabsHandler = function ($scope, $) {
        if ($('.jupiter-tab-menu .tab-button').hasClass("active")) {
            var active_tab_id = $('.jupiter-tab-menu .tab-button').attr('data-tab');
            $("#" + active_tab_id).addClass('active');
        }
        $('.jupiter-tab-menu .tab-button').on('click', function () {
            if ($(this).hasClass("active")) {
                return false;
            }
            var tab_id = $(this).attr('data-tab');
            $('.jupiter-tab-menu button').removeClass('active');
            $(this).addClass('active');
            $('.tab-content').slideUp();
            $("#" + tab_id).slideDown();
        });
    }
    var WidgetjupiterTooltipHandler = function ($scope, $) {        
        $('[data-toggle="tooltip"]').tooltip({
            html: true,
        });        
    }
    var WidgetjupitercoreCarouselHandler = function ($scope, $) {
        var carousel_elem = $scope.find('.jupitercore-carousel-activation').eq(0);
        if (carousel_elem.length > 0) {
            var settings = carousel_elem.data('settings');
            var arrows = settings['arrows'];
            var arrow_prev_txt = settings['arrow_prev_txt'];
            var arrow_next_txt = settings['arrow_next_txt'];
            var dots = settings['dots'];
            var autoplay = settings['autoplay'];
            var autoplay_speed = parseInt(settings['autoplay_speed']) || 3000;
            var animation_speed = parseInt(settings['animation_speed']) || 300;
            var pause_on_hover = settings['pause_on_hover'];
            var center_mode = settings['center_mode'];
            var fade_effect = settings['fade_effect'];
            var vertical_mode = settings['vertical_mode'];
            var center_padding = settings['center_padding'] ? settings['center_padding'] : '50px';
            var display_columns = parseInt(settings['display_columns']) || 1;
            var scroll_columns = parseInt(settings['scroll_columns']) || 1;
            var tablet_width = parseInt(settings['tablet_width']) || 800;
            var tablet_display_columns = parseInt(settings['tablet_display_columns']) || 1;
            var tablet_scroll_columns = parseInt(settings['tablet_scroll_columns']) || 1;
            var mobile_width = parseInt(settings['mobile_width']) || 480;
            var mobile_display_columns = parseInt(settings['mobile_display_columns']) || 1;
            var mobile_scroll_columns = parseInt(settings['mobile_scroll_columns']) || 1;
            var carousel_style_ck = parseInt(settings['carousel_style_ck']) || 1;
            if (carousel_style_ck == 4) {
                carousel_elem.slick({
                    arrows: arrows
                    , prevArrow: '<button class="jupitercore-carosul-prev"><i class="' + arrow_prev_txt + '"></i></button>'
                    , nextArrow: '<button class="jupitercore-carosul-next"><i class="' + arrow_next_txt + '"></i></button>'
                    , dots: dots
                    , customPaging: function (slick, index) {
                        var data_title = slick.$slides.eq(index).find('.jupitercore-data-title').data('title');
                        return '<h6>' + data_title + '</h6>';
                    }
                    , infinite: true
                    , autoplay: autoplay
                    , autoplaySpeed: autoplay_speed
                    , speed: animation_speed
                    , fade: false
                    , pauseOnHover: pause_on_hover
                    , slidesToShow: display_columns
                    , slidesToScroll: scroll_columns
                    , centerMode: center_mode
                    , fade: fade_effect
                    , vertical: vertical_mode
                    , centerPadding: center_padding
                    , responsive: [
                        {
                            breakpoint: tablet_width
                            , settings: {
                                slidesToShow: tablet_display_columns
                                , slidesToScroll: tablet_scroll_columns
                            }
                        }
                        , {
                            breakpoint: mobile_width
                            , settings: {
                                slidesToShow: mobile_display_columns
                                , slidesToScroll: mobile_scroll_columns
                            }
                        }
                    ]
                });
            }
            else {
                carousel_elem.slick({
                    arrows: arrows
                    , prevArrow: '<button class="slick-prev"><i class="' + arrow_prev_txt + '"></i></button>'
                    , nextArrow: '<button class="slick-next"><i class="' + arrow_next_txt + '"></i></button>'
                    , dots: dots
                    , infinite: true
                    , autoplay: autoplay
                    , autoplaySpeed: autoplay_speed
                    , speed: animation_speed
                    , fade: false
                    , pauseOnHover: pause_on_hover
                    , slidesToShow: display_columns
                    , slidesToScroll: scroll_columns
                    , centerMode: center_mode
                    , fade: fade_effect
                    , vertical: vertical_mode
                    , centerPadding: center_padding
                    , responsive: [
                        {
                            breakpoint: tablet_width
                            , settings: {
                                slidesToShow: tablet_display_columns
                                , slidesToScroll: tablet_scroll_columns
                            }
                        }
                        , {
                            breakpoint: mobile_width
                            , settings: {
                                slidesToShow: mobile_display_columns
                                , slidesToScroll: mobile_scroll_columns
                            }
                        }
                    ]
                });
            }
        }
    }
    var WidgetjupitercorePortfolioHandler = function ($scope, $) {
        // Portfolio Image Loded with Masonry
        var PortfolioMasonry = $('.grid-portfolios');
        if (typeof imagesLoaded == 'function') {
            imagesLoaded(PortfolioMasonry, function () {
                setTimeout(function () {
                    PortfolioMasonry.isotope({
                        itemSelector: '.portfolio-grid'
                        , resizesContainer: false
                        , layoutMode: 'masonry'
                        , filter: '*'
                    });
                }, 500);
            });
        };
        // Set Active Class for Portfolio filter
        $('.portfolio-filter-menu li').on('click', function (event) {
            $('.portfolio-filter-menu li').removeClass('active');
            $(this).addClass('active');
            event.preventDefault();
        });
        // Filter JS for Porrtfolio
        $('.portfolio-filter-menu').on('click', 'li', function () {
            var filterValue = $(this).attr('data-filter');
            PortfolioMasonry.isotope({
                filter: filterValue
            });
        });
    }
    var WidgetjupitercoreParallaxHandler = function ($scope, $back) {
        var prallax_settings = $scope.find('.element-prallax').eq(0);
        if (prallax_settings.length > 0) {
            var prallax_settings = prallax_settings.data('load');
            var parallx_speed = prallax_settings['parallx_speed'];
            $(window).scroll(function () {
                var scrollTop = $(window).scrollTop();
                var evenImgPos = scrollTop / parallx_speed + 'px';
                $('.xunbur-ex-element.element-prallax').find(".item").css('transform', 'translateY(' + evenImgPos + ')');
            });
        }
    }
    var WidgetjupitercoreLoadmoreHandler = function ($scope, $back) {
        var loaded_elem = $scope.find('.loaded-items').eq(0);
        if (loaded_elem.length > 0) {
            var settings = loaded_elem.data('load');
            var loaded_item = settings['loaded_item'];
            var load_slice = settings['load_slice'];
            $('.loaded-items').each(function () {
                $(this).children('div:not(.load-button)').addClass('load-item');
                $(this).find(".load-item").hide();
                $(this).find(".load-item").slice(0, loaded_item).show();
                $(this).find(".el-button").on('click', function (e) {
                    e.preventDefault();
                    $(this).parent().siblings(".load-item:hidden").slice(0, load_slice).slideDown(500);
                    if ($(this).parent().siblings(".load-item:hidden").length == 0) {
                        $(this).fadeOut('slow');
                    }
                    $('html,body').animate({
                        scrollTop: $(this).offset().top
                    }, 1500);
                });
            });
        }
    };
    var WidgetjupiterTeamSocialHandler = function () {
        $('.jupiter-team-box .social-content').on('mouseenter', function () {
            $(this).find('.social-item').slideDown('100');
            $(this).find('.social-button').addClass('show');
        });
        $('.jupiter-team-box').on('mouseleave', function () {
            $(this).find('.social-item').slideUp('100');
            $(this).find('.social-button').removeClass('show');
        });
    }
    
    var WidgetJupiterCoreTiltHandler = function ( $scope, $back ){        
        var ef_elem = $scope.find('.element-mouse-effect').eq(0);
        if (ef_elem.length > 0) {            
            var settings = ef_elem.data('effect');
            var max_tilt = settings['max_tilt'];
            var tilt_scale = settings['tilt_scale'];
            var tilt_speed = settings['tilt_speed'];
            var tilt_perspective = settings['tilt_perspective'];            
            ef_elem.tilt({
                maxTilt:        max_tilt,
                perspective:    tilt_perspective,
                scale:          tilt_scale,
                speed:          tilt_speed,
            });
        }
    }
    
        // Run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        var FloatingFx = elementorModules.frontend.handlers.Base.extend({
        onInit: function() {
            elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
            this.run();
        },

        getTheElement: function() {
            return this.$element.find('.elementor-widget-container')[0];
        },

        resetFx: function() {
            anime.remove(this.getTheElement());
            this.getTheElement() && this.getTheElement().removeAttribute('style');
        },

        onDestroy: function() {
            elementorModules.frontend.handlers.Base.prototype.onDestroy.apply(this, arguments);
            this.resetFx();
        },

        onElementChange: function() {
            this.resetFx();
            this.run();
        },

        run: function() {
            var settings = this.getElementSettings(),
                fxSettings = {
                    targets: this.getTheElement(),
                    loop: true,
                    direction: 'alternate',
                    easing: 'easeInOutSine'
                };

            if (settings.jc_floating_fx_translate_toggle) {
                if (settings.jc_floating_fx_translate_x.size) {
                    fxSettings.translateX = {
                        value: settings.jc_floating_fx_translate_x.size,
                        duration: settings.jc_floating_fx_translate_duration.size,
                        delay: settings.jc_floating_fx_translate_delay.size || 0
                    }
                }
                if (settings.jc_floating_fx_translate_y.size) {
                    fxSettings.translateY = {
                        value: settings.jc_floating_fx_translate_y.size,
                        duration: settings.jc_floating_fx_translate_duration.size,
                        delay: settings.jc_floating_fx_translate_delay.size || 0
                    }
                }
            }

            if (settings.jc_floating_fx_rotate_toggle) {
                if (settings.jc_floating_fx_rotate_x.size) {
                    fxSettings.rotateX = {
                        value: settings.jc_floating_fx_rotate_x.size,
                        duration: settings.jc_floating_fx_rotate_duration.size,
                        delay: settings.jc_floating_fx_rotate_delay.size || 0
                    }
                }
                if (settings.jc_floating_fx_rotate_y.size) {
                    fxSettings.rotateY = {
                        value: settings.jc_floating_fx_rotate_y.size,
                        duration: settings.jc_floating_fx_rotate_duration.size,
                        delay: settings.jc_floating_fx_rotate_delay.size || 0
                    }
                }
                if (settings.jc_floating_fx_rotate_z.size) {
                    fxSettings.rotateZ = {
                        value: settings.jc_floating_fx_rotate_z.size,
                        duration: settings.jc_floating_fx_rotate_duration.size,
                        delay: settings.jc_floating_fx_rotate_delay.size || 0
                    }
                }
            }

            if (settings.jc_floating_fx_scale_toggle) {
                if (settings.jc_floating_fx_scale_x.size) {
                    fxSettings.scaleX = {
                        value: settings.jc_floating_fx_scale_x.size,
                        duration: settings.jc_floating_fx_scale_duration.size,
                        delay: settings.jc_floating_fx_scale_delay.size || 0
                    }
                }
                if (settings.jc_floating_fx_scale_y.size) {
                    fxSettings.scaleY = {
                        value: settings.jc_floating_fx_scale_y.size,
                        duration: settings.jc_floating_fx_scale_duration.size,
                        delay: settings.jc_floating_fx_scale_delay.size || 0
                    }
                }
            }

            if (settings.jc_floating_fx_translate_toggle || settings.jc_floating_fx_rotate_toggle || settings.jc_floating_fx_scale_toggle) {
                this.getTheElement() && this.getTheElement().style.setProperty('will-change', 'transform');
                anime(fxSettings);
            }
        }
    });





        elementorFrontend.hooks.addAction('frontend/element_ready/jupiter-carousel-addons.default', WidgetjupitercoreCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/jupiter-product-addons.default', WidgetjupitercoreCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/jupiter-team-addons.default', WidgetjupitercoreCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/jupiter-postcarousel-addons.default', WidgetjupitercoreCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/jupiter-testimonial-addons.default', WidgetjupitercoreCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/jupitercore-portfolio-addons.default', WidgetjupitercoreCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/jupiter-tab-menu.default', WidgetjupitercoreTabsHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/jupitercore-portfolio-addons.default', WidgetjupitercorePortfolioHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/jupiter-position_element.default', WidgetjupitercoreParallaxHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/jupiter-position_element.default', WidgetJupiterCoreTiltHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/jupiter-feature-more-box.default', WidgetjupitercoreLoadmoreHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/jupiter-feature-more-box.default', WidgetjupitercoreCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/jupiter-team-addons.default', WidgetjupiterTeamSocialHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/jupiter-tooltip-addons.default', WidgetjupiterTooltipHandler);
        elementorFrontend.hooks.addAction( 'frontend/element_ready/widget', function ($scope) {
            new FloatingFx({ $element: $scope });
        });
    });
}(jQuery));