<?php 

/**
 * Upsell
 * @since 1.0
 */

    $id = get_the_id();

    if(shop_ready_is_elementor_mode()){

        if($settings['wready_product_id'] !=''){
            $id = $settings['wready_product_id'];
            global $product;
            $product = is_null($product)? wc_get_product($id): $product;
          
            $GLOBALS['product'] = $product;
        }
        
    }

    
    $limit   = '-1';
    $columns = 4;
    $orderby = 'rand';
    $order   = 'desc';
    
    if ( ! empty( $settings['columns'] ) ) {
        $columns = $settings['columns'];
    }

    if ( ! empty( $settings['orderby'] ) ) {
        $orderby = $settings['orderby'];
    }

    if ( ! empty( $settings['order'] ) ) {
        $order = $settings['order'];
    }
   
    woocommerce_upsell_display( $limit, $columns, $orderby, $order );