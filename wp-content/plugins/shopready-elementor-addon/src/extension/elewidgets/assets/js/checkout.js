'use strict';

(function($) {
    /* Storage Handling */

    var $supports_html5_storage = true;
    var cart_hash_key = null;
    if (typeof wc_cart_fragments_params != "undefined") {
        cart_hash_key = wc_cart_fragments_params ? wc_cart_fragments_params.cart_hash_key : null;

        // Satrt cart Frageent  Object
        var $fragment_refresh = {
            url: wc_cart_fragments_params.wc_ajax_url.toString().replace('%%endpoint%%', 'get_refreshed_fragments'),
            type: 'POST',
            data: {
                time: new Date().getTime()
            },
            timeout: wc_cart_fragments_params.request_timeout,
            success: function(data) {

                if (data && data.fragments) {

                    $.each(data.fragments, function(key, value) {

                        $(key).replaceWith(value);
                    });

                    if ($supports_html5_storage) {
                        sessionStorage.setItem(wc_cart_fragments_params.fragment_name, JSON.stringify(data.fragments));
                        set_cart_hash(data.cart_hash);
                    }


                    if (data.cart_hash) {
                        set_cart_creation_timestamp();
                    }


                    $(document.body).trigger('wc_fragments_refreshed');
                    $(document.body).trigger('update_checkout');
                }
            },
            error: function() {

                $(document.body).trigger('wc_fragments_ajax_error');
            }
        };
    }



    function set_cart_hash(cart_hash) {
        if ($supports_html5_storage) {
            localStorage.setItem(cart_hash_key, cart_hash);
            sessionStorage.setItem(cart_hash_key, cart_hash);
        }
    }

    function set_cart_creation_timestamp() {
        if ($supports_html5_storage) {
            sessionStorage.setItem('wc_cart_created', (new Date()).getTime());
        }
    }
    // ENd Cart Fragement

    // shipping Change
    $(document).on('change', '.wr-cart-checkout-shipping-method-wrapper input[name^="shipping_method"]', function() {
        var data = {
            shipping_method: $(this).val(),
            action: 'wr_woocommerce_shipping',
        }

        $.ajax({
            url: woocommerce_params.ajax_url,
            type: 'POST',

            data: data,

            success: function(data) {
                // location.reload();
            }
        });



    });
    $(document).on('updated_cart_totals', function() {

        $('.woo-raedy-cart-totals.cart_totals').hide();
        $('.woo-raedy-cart-totals.cart_totals:nth-of-type(1)').show();

    });



    var wr_checkout_order_review = {
        selectedPaymentMethod: false,
        $order_review: $('#order_review'),
        $checkout_form: $('form.checkout'),
        init: function() {

            $(document.body).on('click', '#ship-to-different-address-checkbox', this.shipping_change);
            // $(document.body).on('change', '.woo-ready-review-order input', this.order_qty_update);

        },

        shipping_change: function(e) {

            $('.woo-ready-checkout-shipping-fields .shipping_address').toggle('slow');
            return false;
        },

        order_qty_update: function() {

            var wr_checkout_key = $(this).attr('data-item_key');

            $fragment_refresh.data.cart = {
                'qty': $(this).val(),
                'key': wr_checkout_key,
            };

            $.ajax($fragment_refresh);

        },



        submit: function() {
            var $form = $(this);

            return false;
        },


    };

    wr_checkout_order_review.init();

    var checkout_multi_step_form = function($scope, $) {

        var id = $scope.data('id');

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;
        var steps = $scope.find("fieldset").length;

        setProgressBar(current);

        $scope.find(".next").click(function() {

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $scope.find("#progressbar li").eq($scope.find("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({ opacity: 0 }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({ 'opacity': opacity });
                },
                duration: 500
            });
            setProgressBar(++current);
        });

        $scope.find(".previous").click(function() {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $scope.find("#progressbar li").eq($scope.find("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({ opacity: 0 }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({ 'opacity': opacity });
                },
                duration: 500
            });
            setProgressBar(--current);
        });

        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $scope.find(".progress-bar")
                .css("width", percent + "%")
        }


    };



    $(window).on('elementor/frontend/init', function() {

        elementorFrontend.hooks.addAction('frontend/element_ready/checkout_multi_step_form.default', checkout_multi_step_form);

    });
})(jQuery);