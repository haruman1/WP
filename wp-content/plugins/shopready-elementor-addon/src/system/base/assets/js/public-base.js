'use strict';


(function($) {

    /**
     * WooCommerce Product Compare
     * Popup
     * newslatter
     * coupon
     * quick checkout
     * remove compare item
     */


    var wready_product_compare = {


        modal_body: $('#woo-ready-product-compare .wready-md-body'),
        wready_products_obj_key: 'wready_compare_products_obj',
        wready_products_id_key: 'wready_compare_products',
        products_obj: [],
        init: function() {

            $(document.body).on('click', '.wready-product-compare', this.compare_popup_open);
            $(document.body).on('click', '.wready-product-cmp-remove', this.compare_popup_remove_item);
            $(document.body).on('click', '.shop-ready-remove-product a', this.compare_remove_widget_item);
            //$(document.body).on('click', 'a.showcoupon', this.default_coupon);
            $(document.body).on('click', '.shop-ready-pro-quick-checkout-button', this.product_quick_checkout);

            this.product_newslatter();

        },

        product_newslatter: function() {

            if (typeof newslatter_service === 'undefined') {
                return;
            }
            if (!newslatter_service.active) {
                return;
            }


            var $autoclose_time = parseInt(newslatter_service.autoclose_time) || 0;
            var $load_after_time = parseInt(newslatter_service.load_after_time) || 100;

            setTimeout(function() {

                    $('#shop-ready-pro-sr-newslatter-popup-modal').nifty('show');

                },
                $load_after_time
            );


            if (newslatter_service.auto_close && $autoclose_time > 0) {

                setTimeout(function() {
                        $("#shop-ready-pro-sr-newslatter-popup-modal").nifty("hide")
                    },

                    $autoclose_time
                );

            }


        },

        product_quick_checkout: function(event) {
            event.preventDefault();
            var p_id = $(this).attr('data-product_id');
            var formData = [];
            formData.push({
                name: 'product_id',
                value: p_id
            });

            $(document.body).trigger('adding_to_cart', [formData]);

            $.ajax({
                type: 'POST',
                url: woocommerce_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
                data: formData,
                success: function(response) {

                    if (!response) {
                        return;
                    }

                    $('body').trigger('update_checkout');
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash]);
                },
                complete: function() {

                }
            });

            $('#shop-ready-pro-sr-quick-checkout-popup-modal').nifty('show');

        },

        default_coupon: function(event) {

            $('.woocommerce-form-coupon').toggle('slow');
            return;
        },

        compare_popup_remove_item: function(e) {

            e.preventDefault();
            let product_id = parseInt($(this).data('product_id'));
            let product_objs = localStorage.getItem('wready_compare_products_obj') != null ? JSON.parse(localStorage.getItem('wready_compare_products_obj')) : [];
            let compare_products = localStorage.getItem('wready_compare_products') != null ? JSON.parse(localStorage.getItem('wready_compare_products')) : [];
            product_objs.products = _.filter(product_objs.products, function(item) {
                return item.id !== product_id
            });

            compare_products = _.reject(compare_products, function(num) { return num == product_id; });
            localStorage.setItem('wready_compare_products_obj', JSON.stringify(product_objs));
            localStorage.setItem('wready_compare_products', JSON.stringify(compare_products));
            $('.woo-ready-product-compare-modal').addClass('sr-compare-overly-preloading');
            $.ajax({
                type    : "post",
                dataType: "json",
                url     : wp.ajax.settings.url,
                data    : { action: "wready_compare_products", posts_id: JSON.stringify(compare_products) },
                success: function(wmsg) {
                   
                    wready_product_compare.products_obj = wmsg.data;
                    localStorage.setItem('wready_compare_products_obj', JSON.stringify(wmsg.data));
                    if (wmsg.data.template == true) {

                        wready_product_compare.add_inner_preload_html(wmsg.data);

                    }else{
                        wready_product_compare.add_inner_html(true);
                    } 
                    $('.woo-ready-product-compare-modal').removeClass('sr-compare-overly-preloading');
                }
            });
           

            return false;

        },

        compare_remove_widget_item: function(event) {
            event.preventDefault();
            let product_id = parseInt($(this).data('product_id'));


            let product_objs = localStorage.getItem('wready_compare_products_obj') != null ? JSON.parse(localStorage.getItem('wready_compare_products_obj')) : [];
            let compare_products = localStorage.getItem('wready_compare_products') != null ? JSON.parse(localStorage.getItem('wready_compare_products')) : [];
            product_objs.products = _.filter(product_objs.products, function(item) {
                return item.id !== product_id
            });
            compare_products = _.reject(compare_products, function(num) { return num == product_id; });
            localStorage.setItem('wready_compare_products_obj', JSON.stringify(product_objs));
            localStorage.setItem('wready_compare_products', JSON.stringify(compare_products));

            $.ajax({
                type: "post",
                dataType: "json",
                url: wp.ajax.settings.url,
                data: { action: "wready_compare_products", posts_id: JSON.stringify(compare_products) },
                success: function(wmsg) {
                    window.location.reload();
                }
            });

        },

        compare_popup_open: function(event) {

            let prodduct_id = parseInt($(this).data('product_id'));
            let prodduct_type = $(this).data('product-type');
            
            $("#woo-ready-product-compare").nifty("show");
            wready_product_compare.add_comare_busket(prodduct_id);
            return false;
        },

        add_inner_preload_html: function(msg) {
             
            var genereted_template = wp.template('shop-ready-pro-product-direct-html-compare');
            wready_product_compare.modal_body.html(genereted_template( wready_product_compare.products_obj ));
        },

        add_inner_html: function(msg) {

            var template = typeof wready_product_compare.products_obj.template == "undefined" ? false : wready_product_compare.products_obj.template;
            var product_objs = JSON.parse(localStorage.getItem('wready_compare_products_obj'));
            if (!template) {
                product_objs.filled = msg;
                var template = wp.template('wready-product-compare');
                wready_product_compare.modal_body.html(template(product_objs));
            }

            setTimeout(() => {
                $('.wready-cmp-table-msg').fadeOut();
            }, 3000);


        },


        add_comare_busket: function(_wready_product_id) {
           
            if (typeof localStorage != "undefined") {

                let compare_products = localStorage.getItem('wready_compare_products') != null ? JSON.parse(localStorage.getItem('wready_compare_products')) : [];
               
                    compare_products.push(_wready_product_id);
                    localStorage.setItem('wready_compare_products', JSON.stringify(compare_products));

                    //ajax send to wc session
                   
                    if (typeof wp.ajax.settings.url != "undefined") {

                        wready_product_compare.add_inner_preload_html('Add To Basket');
                        $('.woo-ready-product-compare-modal').addClass('sr-compare-overly-preloading');
                        $.ajax({
                            type    : "post",
                            dataType: "json",
                            url     : wp.ajax.settings.url,
                            data    : { action: "wready_compare_products", posts_id: JSON.stringify(compare_products) },
                            success: function(wmsg) {
                                
                                wready_product_compare.products_obj = wmsg.data;
                                localStorage.setItem('wready_compare_products_obj', JSON.stringify(wmsg.data));
                                if (wmsg.data.template == true) {

                                    wready_product_compare.add_inner_preload_html(wmsg.data);

                                } else {

                                    wready_product_compare.add_inner_html(true);
                                }

                                $('.woo-ready-product-compare-modal').removeClass('sr-compare-overly-preloading');

                            }
                        });

                    }
               

            }
        }

    };

    wready_product_compare.init();

    /**
     * WooCommerce Product WishList
     * Popup
     */
    var wready_product_wishlist = {

        modal_body: $('#woo-ready-product-wishlist .wready-md-body'),
        wready_products_obj_key: 'wready_wishlist_products_obj',
        wready_products_id_key: 'wready_wishlist_products',
        products_obj: [],
        init: function() {

            $(document.body).on('click', '.wready-product-wishlist', this.wishlist_popup_open);
            $(document.body).on('click', '.wready-product-wishlist-only', this.Open_wish_list);
            $(document.body).on('click', '.wready-product-wishlist-remove', this.wishlist_popup_remove_item);

        },

        wishlist_popup_remove_item: function(event) {
            event.preventDefault();
            let product_id = parseInt($(this).data('product_id'));
            let that_product = $(this);
            that_product.parents('.wready-wishlist-column').remove();

            let product_objs = localStorage.getItem('wready_wishlist_products_obj') != null ? JSON.parse(localStorage.getItem('wready_wishlist_products_obj')) : [];
            let wishlist_products = localStorage.getItem('wready_wishlist_products') != null ? JSON.parse(localStorage.getItem('wready_wishlist_products')) : [];


            product_objs.products = _.filter(product_objs.products, function(item) {
                return item.id !== product_id
            });
            wishlist_products = _.reject(wishlist_products, function(num) { return num == product_id; });
            product_objs.products = wishlist_products;
            localStorage.setItem('wready_wishlist_products_obj', JSON.stringify(product_objs));
            localStorage.setItem('wready_wishlist_products', JSON.stringify(wishlist_products));

            wready_product_wishlist.remove_wishlist_basket();



        },

        remove_wishlist_basket: function() {

            if (typeof localStorage != "undefined") {
                let wishlist_products = localStorage.getItem('wready_wishlist_products') != null ? JSON.parse(localStorage.getItem('wready_wishlist_products')) : [];

                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: wp.ajax.settings.url,
                    data: { action: "wready_wishlist_products", posts_id: JSON.stringify(wishlist_products) },
                    success: function(wmsg) {

                    }
                });


            }
        },

        Open_wish_list: function() {

            $("#woo-ready-product-wishlist").nifty("show");

            if (woo_ready_product_wishlist_ele_tpl == 'yes') {

                wready_product_wishlist.add_elementor_html('');

            } else {

                wready_product_wishlist.add_inner_html(false);
            }
        },

        add_elementor_html: function() {

            let product_objs = localStorage.getItem('wready_wishlist_products_obj') != null ? JSON.parse(localStorage.getItem('wready_wishlist_products_obj')) : [];
            let wishlist_products = localStorage.getItem('wready_wishlist_products') != null ? JSON.parse(localStorage.getItem('wready_wishlist_products')) : [];
        
            if (wishlist_products.length == 0) {

                wready_product_wishlist.add_inner_preload_html('Empty Wishlist');
                setTimeout(function() {
                    $("#woo-ready-product-wishlist").nifty("hide");
                }, 5000);

            }
        },

        wishlist_popup_open: function(event) {

            let prodduct_id = parseInt($(this).data('product_id'));
            $("#woo-ready-product-wishlist").nifty("show");
            wready_product_wishlist.add_wishlist_busket(prodduct_id);
            return false;
        },

        add_inner_preload_html: function(msg) {

            var template = wp.template('wready-product-wishlist-preload');
            wready_product_wishlist.modal_body.html(template({ name: msg }));
        },

        add_inner_html: function(msg) {

            var template = typeof wready_product_wishlist.products_obj.template == "undefined" ? false : wready_product_wishlist.products_obj.template;
            var product_objs = JSON.parse(localStorage.getItem('wready_wishlist_products_obj'));
            var w_products = JSON.parse(localStorage.getItem('wready_wishlist_products'));
          
            $.ajax({
                type: "post",
                dataType: "json",
                url: wp.ajax.settings.url,
                data: { action: "wready_wishlist_products", posts_id: JSON.stringify(w_products) },
                success: function(wmsg) {
  
                    wready_product_wishlist.products_obj = wmsg.data;
                    product_objs.products = wmsg.data.products;
                    localStorage.setItem('wready_wishlist_products_obj', JSON.stringify(wmsg.data));
                    if (!template) {

                        product_objs.filled = msg;
                        var template = wp.template('wready-product-wishlist');
                        wready_product_wishlist.modal_body.html(template(product_objs));
        
                    }

                }
            });

           

            setTimeout(() => {
                $('.wready-wishlist-table-msg').fadeOut();
            }, 3000);


        },


        add_wishlist_busket: function(_wready_product_id) {

            if (typeof localStorage != "undefined") {

                let wishlist_products = localStorage.getItem('wready_wishlist_products') != null ? JSON.parse(localStorage.getItem('wready_wishlist_products')) : [];

                if (!wishlist_products.includes(_wready_product_id) && Number.isInteger(_wready_product_id)) {

                    wishlist_products.push(_wready_product_id);
                    localStorage.setItem('wready_wishlist_products', JSON.stringify(wishlist_products));

                    if (typeof wp.ajax.settings.url != "undefined") {

                        wready_product_wishlist.add_inner_preload_html('Add To Basket');

                        $.ajax({
                            type: "post",
                            dataType: "json",
                            url: wp.ajax.settings.url,
                            data: { action: "wready_wishlist_products", posts_id: JSON.stringify(wishlist_products) },
                            success: function(wmsg) {
                                wready_product_wishlist.products_obj = wmsg.data;
                                localStorage.setItem('wready_wishlist_products_obj', JSON.stringify(wmsg.data));
                                if (wmsg.data.template == true) {

                                    wready_product_wishlist.add_inner_preload_html('Add To Basket');

                                } else {

                                    wready_product_wishlist.add_inner_html(true);
                                }

                            }
                        });

                    }
                } else {

                    if (woo_ready_product_wishlist_ele_tpl == 'yes') {
                        wready_product_wishlist.add_inner_preload_html('Already In WishList');
                    } else {

                        wready_product_wishlist.add_inner_html(false);
                    }


                }

            }
        }

    };

    wready_product_wishlist.init();
    /**
     * WooCommerce Product QuickView
     * Popup
     */
    var wready_product_quickview = {

        modal_body: $('#woo-ready-product-quickview .wready-md-body'),
        wready_products_obj_key: 'wready_quickview_products_obj',
        wready_products_id_key: 'wready_quickview_products',
        products_obj: [],
        init: function() {
             
            $(document.body).on('click', '.wready-product-quickview', this.quickview_popup_open);
            $(document.body).on('click', '.shop-ready-quick-view-tab-content .woocommerce-tabs .shop-ready-q-tabs li', this.product_quick_view_content_tab);
            

        },

        slider_init : function(){

            // .sr-quick-thumbnail-wrapper
            // .shop-ready-pro-quick-view-image-slider-wrapper
            let quick_view_thumbnail = $('.sr-quick-thumbnail-wrapper');
            let quick_view_gal_list = $('.woocommerce-product-gallery__image');

            console.log(quick_view_gal_list);
            console.log(quick_view_gal_list.length);

              
        },
        // click
        product_quick_view_content_tab: function(event) {

            event.preventDefault();
            let this_product_tab = $(this).attr('aria-controls');

            let product_tab = $('.shop-ready-quick-view-tab-content .woocommerce-tabs .shop-ready-q-tabs li');
            let product_tab_content = $('.shop-ready-quick-view-tab-content .wready-product-tab-content .woocommerce-Tabs-panel');
            $.each(product_tab, function(key, value) {

                if ($(this).attr('aria-controls') == this_product_tab) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }

            });

            $.each(product_tab_content, function(key, value) {

                if ($(this).attr('id') == this_product_tab) {
                    $(this).show(1000);
                } else {
                    $(this).hide(500);
                }

            });

        },
        // initialize tab 
        shop_ready_pro_quick_view_tab_content: function() {

            let product_tab = $('.shop-ready-quick-view-tab-content .woocommerce-tabs .shop-ready-q-tabs li');
            let product_tab_content = $('.shop-ready-quick-view-tab-content .wready-product-tab-content .woocommerce-Tabs-panel');

            $.each(product_tab, function(key, value) {

                if (key == 0) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }

            });
            // content
            $.each(product_tab_content, function(key, value) {

                if (key == 0) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                    $(this).hide();
                }

            });

        },

        quickview_popup_open: function(event) {

            let prodduct_id = parseInt($(this).data('product_id'));
          
            $("#woo-ready-product-quickview").nifty("show");
            wready_product_quickview.get_product_content(prodduct_id);
            
            return false;
        },

        add_inner_preload_html: function(msg) {

            var template = wp.template('wready-product-quickview-preload');
            wready_product_quickview.modal_body.html(template({ name: msg }));
        },

        add_inner_html: function(msg) {

            var template = typeof wready_product_quickview.products_obj.template == "undefined" ? false : wready_product_wishlist.products_obj.template;

            if (!template) {

                var template = wp.template('wready-product-quickview');
                wready_product_quickview.modal_body.html(template(wready_product_quickview.products_obj));

            }

        },


        get_product_content: function(_wready_product_id) {

            if (typeof wp.ajax.settings.url != "undefined") {

                wready_product_quickview.add_inner_preload_html('Product Loading');
                $('.woo-ready-product-quickview-modal').addClass('woo-ready-product-quickview-modal-preloader-overlay')
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: wp.ajax.settings.url,
                    data: { action: "wready_quickview_products", posts_id: _wready_product_id },
                    success: function(wmsg) {
                        
                        wready_product_quickview.products_obj = wmsg.data;
                        wready_product_quickview.add_inner_html(true);
                        wready_product_quickview.shop_ready_pro_quick_view_tab_content();
                        $('.woo-ready-product-quickview-modal').removeClass('woo-ready-product-quickview-modal-preloader-overlay')
                        wready_product_quickview.slider_init(); 
                    }
                });

            }

        },


    };

    wready_product_quickview.init();

    //Color swatch

    $(document).on('change', '.variation-radios input', function() {

        $('.variation-radios input:checked').each(function(index, element) {
            var $el = $(element);
            var thisName = $el.attr('name');
            var thisVal = $el.attr('value');

            $('select[name="' + thisName + '"]').val(thisVal).trigger('change');
        });

    });

    $(document).on('woocommerce_update_variation_values', function() {
        $('.variation-radios input').each(function(index, element) {
            var $el = $(element);

            var thisName = $el.attr('name');
            var thisVal = $el.attr('value');
            $el.removeAttr('disabled');
            if ($('select[name="' + thisName + '"] option[value="' + thisVal + '"]').is(':disabled')) {
                $el.prop('disabled', true);
            }
        });
    });

    $(document).on('wc_cart_button_updated', function() {
        $('.wready-product-loop-cart-link .ajax_add_to_cart.added').html(' added ');
    });

    // Hide element thst is empty
    document.querySelectorAll('.elementor-widget .woo-ready-ele-widget-container').forEach(function(element, i) {
        if (!element.hasChildNodes()) {
            if (element.textContent.trim() === "") {
                element.closest(".elementor-widget").style.display = 'none';
            }
        }
    });

    $(document).on('click', '.woo-ready-qty-add', function() {

        let prev_input = parseInt($(this).prev().val()) || 0;
        $(this).prev().val(prev_input + 1).trigger('change');

    });

    $(document).on('click', '.woo-ready-qty-sub', function() {

        let next_input = parseInt($(this).next().val()) || 0;
        if (next_input > 1) {
            if (next_input > 1) {
                $(this).next().val(next_input - 1).trigger('change');
            }
        }
    });

    // Mini Cart Update

    $(document).on('click', '.shop-ready-mini-cart-update-button', function(event) {

        event.preventDefault();
        let store_sr_mini_cart_keys = [];
        var _this_elemet = $(this);
        let cart_keys = _this_elemet.parents('.woo-ready-mini-cart-container').find('input.qty');
        $(".woo-ready-mini-cart-container").append('<div class="wr-random-overlay"></div>');
        cart_keys.each(function(index) {

            var sr__cart_keys = {};
            sr__cart_keys["key"] = $(this).attr('item_key');
            sr__cart_keys["value"] = $(this).val();
            store_sr_mini_cart_keys.push(sr__cart_keys);

        });

        $.ajax({
            type: "POST",
            url: wp.ajax.settings.url,
            data: {
                action: 'shop_ready_update_mini_cart_item',
                sr_cart_item_keys: store_sr_mini_cart_keys,
            },
            success: function(response) {

                $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash]);
                $(document.body).trigger('wc_fragment_refresh');
                $('.wr-checkout-cart-table').find('.wr-random-overlay').remove();
            },
        });

    });

    $(document).on('click', '.remove_from_cart_button', function() {

        $(".woo-ready-mini-cart-container").append('<div class="wr-random-overlay"></div>');

    });


    var wready_shopping_cart = {

        init: function() {


            $(document.body).on('click', '.ajax_add_to_cart ', this.cart_checkout_update);
            $(document.body).on('click', '.single_add_to_cart_button', this.product_details_cart_checkout_update);
            $(document.body).on('click', '.woo-ready-mini-cart-item .remove', this.product_remove_from_cart);
            $(document.body).on('click', '.wr-checkout-cart-table .product-remove .remove', this.product_remove_from_cart);

        },

        shop_ready_fly_to_element: function(flyer, flyingTo, add_to_cart) {

            var flyerClone = $(flyer).clone();

            $(flyerClone).css({ position: 'absolute', top: add_to_cart.offset().top - 20 + "px", left: add_to_cart.offset().left + 15 + "px", opacity: 1, 'z-index': 588000055 });

            $('body').append($(flyerClone));
            var gotoX = $(flyingTo).offset().left;
            var gotoY = $(flyingTo).offset().top;

            $(flyerClone).animate({
                    opacity: parseFloat(shop_ready_obj.animation_opacity),
                    left: gotoX,
                    top: gotoY,

                }, shop_ready_obj.custom_animation_time,
                function() {

                    $(flyingTo).addClass('shop-raedy-shopping-cart-added-shake');
                    $(flyingTo).fadeOut('fast', function() {
                        $(flyingTo).fadeIn('fast', function() {

                            $(flyerClone).fadeOut('fast', function() {
                                $(flyerClone).remove();

                                $(flyingTo).removeClass('shop-raedy-shopping-cart-added-shake');


                            });

                        });
                    });
                });
        },

        flying_cart_animation_style: function(add_to_cart) {

            if (shop_ready_obj.add_to_cart_animation == 'yes') {
                var widget_area = shop_ready_obj.animation_custom_area == 'yes' ? shop_ready_obj.cart_custom_area_cls : shop_ready_obj.animation_widget_area;
                var flying_content = '<span class="shop-ready-add-to-cart-animation-content" style="width:40px; height:40px; background:black; border-radius:100%; line-height:1; color:#fff;padding:10px">' + shop_ready_obj.animation_icon_content + '</span>';

                wready_shopping_cart.shop_ready_fly_to_element($(flying_content), "." + widget_area, add_to_cart);

            }

        },
        cart_checkout_update: function(event) {
            event.preventDefault();
            var __that_obj = $(this);

            var p_id = $(this).attr('data-product_id');
            var formData = [];
            formData.push({
                name: 'product_id',
                value: p_id
            });

            $(document.body).trigger('adding_to_cart', [formData]);

            if (__that_obj.hasClass('ajax_add_to_cart') || __that_obj.hasClass('add_to_cart_button')) {
                wready_shopping_cart.flying_cart_animation_style(__that_obj);
            }

            $.ajax({
                type: 'POST',
                url: woocommerce_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
                data: formData,
                success: function(response) {

                    if (!response) {
                        return;
                    }

                    $('body').trigger('update_checkout');
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash]);

                },
                complete: function() {

                }
            });

        },
        product_remove_from_cart: function(event) {
           
            event.preventDefault();
            var _this_elemet = $(this);
            $('.woo-ready-mini-cart-container.ajax-fragemnt').addClass('shop-ready-content-overlay-area');
            $.ajax({
                type: "POST",
                url: wp.ajax.settings.url,
                data: {
                    action: 'remove_item_from_cart',
                    'cart_item_key': $(this).data('cart_item_key')
                },
                success: function(response) {

                    if (!response) {
                        return;
                    }
                    _this_elemet.parents('tr').remove();
                    $(document.body).trigger('removed_from_cart', [response.fragments, response.cart_hash, $(this)]);
                    $('body').trigger('update_checkout');
                },
            });
        },
        product_details_cart_checkout_update: function(event) {

            event.preventDefault();
            var p_id = $(this).val();
            var $form = $(this).parents('form');
            var currentqty = $form.find('.product-quantity input.qty').val();
            var variation_id = parseInt($form.find("[name='variation_id']").val());
            if (variation_id) {
                p_id = $form.find("[name='variation_id']").val();
            }

            var formData = [];
            formData.push({
                name: 'product_id',
                value: p_id,
                quantity: currentqty
            });

            $(document.body).trigger('adding_to_cart', [formData]);

            $.ajax({
                type: 'POST',
                url: woocommerce_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
                data: formData,
                success: function(response) {

                    if (!response) {
                        return;
                    }

                    $('body').trigger('update_checkout');
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash]);
                    $('.woocommerce-product-page-notice-wrapper').show();

                },
                complete: function() {

                }
            });


        },
    }
    wready_shopping_cart.init();

    var wready_shop_filter = {

        request_val: {
            'page_number': 1,
            'page_count': 10,
            'sr_attributes': false,
            'attribute_filter': false,
            'sr_category': [

            ],
            'orderby': 'ASC',
            'sr_meta_orderby': '',
            'min_price': 0,
            'max_price': 1000000,
        },

        init: function() {

            if($('.shop-ready-ajax-product-wrapper').length){
                let page_count = 10;
                page_count = parseInt( $('.shop-ready-ajax-product-wrapper').attr('data-page-count') );
                if(page_count > 0){
                    wready_shop_filter.request_val.page_count = page_count;
                }else{
                    wready_shop_filter.request_val.page_count = 6; 
                }
               
            }
            if (typeof shop_ready_shop_filter_obj == 'undefined') {
                return;
            }

            if (!shop_ready_shop_filter_obj.active) {
                return;
            }

            $('.shop-ready-widget-rating-filter li a').on('click', this.rating_filter);
            $(document).on('click','.shop-ready-ajax-product-wrapper a.page-numbers', this.loadmore_pagination);
           
            $(document).on('change','.shop-ready--grid-ordering select', this.catelog_ordering);
            $('.woo-ready-attribute-filter input[type=checkbox], .shop-ready-filter-attribute-single').on('click', this.attribute_filter);
            $('.shop-ready-sidebar-category-filter-js .cat-item input').on('click', this.product_category_filter);
            $(document.body).on("price_slider_change", this.price_filter_update);

        },

       
        loadmore_pagination : function(e){

            e.preventDefault();

            let current_page = $(this).attr('href');
            const urlParams = current_page.split("?product-page=");

            if( urlParams[1] !== undefined ){
                wready_shop_filter.request_val.page_number = parseInt(urlParams[1]);
            }

            wready_shop_filter.fetch_grid();

            return false;
            
        }, 
        // Incomplete method . need varification
        product_category_filter: function(event) {
            event.preventDefault();
            wready_shop_filter.request_val.page_number = 1;
            let cats_list = [];

            var __this_cat_li = $(this).parent('li');

            if (__this_cat_li.hasClass('chosen')) {
                __this_cat_li.removeClass('chosen');
                $(this).removeAttr('checked');
                $(this).removeAttr('data-selected');
            } else {
                __this_cat_li.addClass('chosen');
                $(this).attr('checked', 'checked');
                $(this).attr('data-selected', 'yes');
            }

            let _all_cat_elements = $('.shop-ready-sidebar-category-filter-js .cat-item.chosen');
           
            if (_all_cat_elements.length) {

                _all_cat_elements.each(function(index) {
                   
                    cats_list.push($(this).find('input').val());
                });
             
                wready_shop_filter.request_val.sr_category = cats_list;

            } else {
                delete wready_shop_filter.request_val.sr_category;
            }

            wready_shop_filter.fetch_grid();

            return false;

        },

        rating_filter: function(event) {

            event.preventDefault();
            var rating_count = [];
            wready_shop_filter.request_val.page_number = 1;
            var __this_rating_li = $(this).parent();

            if (__this_rating_li.hasClass('chosen')) {
                __this_rating_li.removeClass('chosen');
            } else {
                __this_rating_li.addClass('chosen');
            }
            let all_elements = $('.wc-layered-nav-rating.chosen');
            if (all_elements.length) {

                all_elements.each(function(index) {
                    rating_count.push($(this).attr('data-rating_count'));
                });
                wready_shop_filter.request_val.rating_filter = rating_count.join(',');


            } else {
                delete wready_shop_filter.request_val.rating_filter;
            }
            wready_shop_filter.fetch_grid();

        },

        price_filter_update: function(event, min, max) {

            wready_shop_filter.request_val.min_price = min;
            wready_shop_filter.request_val.max_price = max;
            wready_shop_filter.fetch_grid();

        },

        catelog_ordering: function(e) {
            e.preventDefault();
            wready_shop_filter.request_val.page_number = 1;
            wready_shop_filter.request_val.orderby = $(this).val();
            wready_shop_filter.fetch_grid();
            return false;
        },

        attribute_filter: function(event) {

            event.preventDefault();
            wready_shop_filter.request_val.page_number = 1;
            if ($(this).attr('checked') == 'checked') {
                $(this).removeAttr('checked');
                $(this).removeAttr('data-selected');

            } else {

                $(this).attr('checked', 'checked');
                $(this).attr('data-selected', 'yes');
            }

            wready_shop_filter.fetch_grid();

            return false;
        },

        get_all_selected_attr() {

            let all_elements = $('.shop-ready-filter-attribute-single');
            let selected_attr = [];
            if (all_elements.length) {

                all_elements.each(function(index) {

                    var _attr_type = $(this).attr('data-type');
                    var _attr_selected = $(this).attr('data-selected');
                    var _attr_taxonomy = $(this).attr('data-taxonomy');
                    if (_attr_selected == 'yes') {

                        selected_attr.push({ 'type': _attr_type, 'value': _attr_taxonomy });

                    }

                });
                var groups = _.groupBy(selected_attr, 'type');

                wready_shop_filter.request_val.sr_attributes = groups;
            }

        },


        fetch_grid: function() {
            wready_shop_filter.get_all_selected_attr();
            
            $('.woo-ready-products').addClass('shop-reay-pro-grid-overlay');
            var formData = wready_shop_filter.request_val;
            formData.action = 'shop_ready_shop_product_refresh_content';
            $('.shop-ready-shop-grid').addClass('shop-ready-shop-grid-overlay');

            $.ajax({
                type: 'GET',
                url: shop_ready_shop_filter_obj.ajax_url,
                data: formData,
                success: function(response) {

                    if (!response) {
                        return;
                    }

                    $('.shop-ready-product-grid-ajax-loader').parents('.shop-ready-ajax-product-wrapper').html(response.woo_ready_products);


                },
                complete: function() {

                }
            });

        }

    }

    wready_shop_filter.init();
})(jQuery);