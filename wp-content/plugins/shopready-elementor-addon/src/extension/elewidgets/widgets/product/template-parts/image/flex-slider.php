<?php 

    defined( 'ABSPATH' ) || exit;

    wp_enqueue_script('slick'); 
	$id = get_the_id();

	if(shop_ready_is_elementor_mode()){

		if($settings['wready_product_id'] !=''){
			$id = $settings['wready_product_id'];
		}
	
	}

	global $product;
    $product = is_null($product)? wc_get_product($id): $product;

    if(!is_object($product)){
        return;
    }
    
    if( !method_exists($product,'get_id') ){
		return;
	}
  
    $attachment_ids = $product->get_gallery_image_ids();
    $post_thumbnail_id = method_exists($product,'get_image_id') ? $product->get_image_id() : get_post_thumbnail_id($product->get_id());
    
?>
<div class="wooready_product_details_thumb display:flex justify-content:center">
        <div class="wooready_product_details_thumb_wrapper margin-right:20">
            <div class="wooready_product_details_thumb_1">
                
                <?php
                    if(is_numeric($post_thumbnail_id)){
                        echo '<div class="item">';
                         $image_link = wp_get_attachment_url( $post_thumbnail_id );
                         echo wp_kses_post(sprintf('<img class="shop-ready-product-thumb" src="%s" alt="%s">',esc_url($image_link),esc_html($product->get_name())));
                        echo '</div>';
                    }
                 
                    foreach( $attachment_ids as $attachment_id ) {
                        echo '<div class="item">';
                            $image_link = wp_get_attachment_url( $attachment_id );
                            echo wp_kses_post(sprintf('<img class="shop-ready-product-thumb" src="%s" alt="%s">',esc_url($image_link),esc_html($product->get_name())));
                        echo '</div>';
                    }
                    
                ?>
             </div>
            <div class="wooready_product_details_small_item margin-top:15">
                <?php

                    if(is_numeric($post_thumbnail_id)){
                        echo '<div class="item">';
                            $image_link = shop_ready_resize(wp_get_attachment_url( $post_thumbnail_id ),300,300);
                            echo wp_kses_post(sprintf('<img class="shop-ready-product-thumb-gly" src="%s" alt="%s">',esc_url($image_link),esc_html($product->get_name())));
                        echo '</div>'; 
                    }

                    foreach( $attachment_ids as $attachment_id ) {
                        echo '<div class="item">';
                            $image_link = shop_ready_resize(wp_get_attachment_url( $attachment_id ),300,300);
                            echo wp_kses_post(sprintf('<img class="shop-ready-product-thumb-gly" src="%s" alt="%s">',esc_url($image_link),esc_html($product->get_name())));
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>