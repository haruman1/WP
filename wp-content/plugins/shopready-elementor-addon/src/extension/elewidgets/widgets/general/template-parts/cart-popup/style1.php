    <?php
        // popup 
        use Shop_Ready\helpers\classes\Elementor_Helper as WReady_Helper;

        $count_icon  = WReady_Helper::get_global_setting('woo_ready_widget_cart_count_icon');
        $cart_label  = WReady_Helper::get_global_setting('woo_ready_widget_cart_label');
        $singular    = WReady_Helper::get_global_setting('woo_ready_widget_cart_count_singular');
        $plural      = WReady_Helper::get_global_setting('woo_ready_widget_cart_count_plural');
        $before_text = WReady_Helper::get_global_setting('woo_ready_widget_cart_number_before_text');
      

    ?>
    
    <!--====== Poup Cart START ======-->
        <div class="woo-ready-dropdown wooready_shop_cart_layout_1 woo-ready-block-header">
            
            <div class="woo-ready-user-interface woo-ready-cart-popup">
                
                <?php echo shop_ready_render_icons( $count_icon,'wready-cart-count' ); ?>
                
                <?php if($before_text == 'yes'): ?>
                    <?php if(isset(WC()->cart)){ ?>
                        <span class="wready-cart-count-before"> <?php echo wp_kses_post(WC()->cart->get_cart_contents_count()>1?sprintf('%s %s',WC()->cart->get_cart_contents_count(),$plural):sprintf('%s %s',WC()->cart->get_cart_contents_count(),$singular)); ?> </span>
                    <?php } ?>
                <?php endif; ?>
                <?php if($cart_label !=''): ?>
                   <div class="display:inline-block wready-cart-count-text"> <?php echo esc_html($cart_label); ?> </div> 
                <?php endif; ?>
                
                <?php if($before_text != 'yes'): ?>
                    <?php if(isset(WC()->cart)){ ?>
                        <span class="wready-cart-count-after"> <?php echo wp_kses_post(WC()->cart->get_cart_contents_count()>1?sprintf('%s %s',WC()->cart->get_cart_contents_count(),$plural):sprintf('%s %s',WC()->cart->get_cart_contents_count(),$singular)); ?> </span>
                    <?php } ?>
                <?php endif; ?>
              
            </div>
        
            <div class="header-account woo-ready-sub-content <?php echo esc_attr($settings['_kt_entrance_animation']); ?>">
                <?php if( $settings['modal_template_id'] > 0 && is_numeric( $settings['modal_template_id'] ) ): ?>
                    <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $settings['modal_template_id'] ); ?>
                <?php endif; ?>
            </div>
        </div>
    <!--======  PopUp cart END ======-->