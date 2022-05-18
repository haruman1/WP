<?php

	/**
	 * Single Product Image
	 * @since 1.0
	 */

	defined( 'ABSPATH' ) || exit;
	// wp_enqueue_script('wc-single-product');
	// wp_enqueue_style('wc-single-product');
	$id = get_the_id();

	if( shop_ready_is_elementor_mode() ){

		if($settings['wready_product_id'] !=''){
			$id = $settings['wready_product_id'];
		}

		echo '<div class="elementor-alert elementor-alert-info" role="alert">
        <span class="elementor-alert-title">Editor Mode Notice</span>
                        <span class="elementor-alert-description"> Default Image Will Not show in Editor Mode. Check in Product Details Frontend  .</span>
                                    <button type="button" class="elementor-alert-dismiss">
                <span aria-hidden="true">×</span>
                <span class="elementor-screen-only">Dismiss alert</span>
            </button>
                </div>';
        return;
	
	}

	global $product;
    $product = is_null($product)? wc_get_product($id): $product;
     
	if(!is_object($product)){
		 return;
	}

    if( !method_exists($product,'get_id') ){
		return;
	}

	$columns           = 4;
	$post_thumbnail_id = method_exists($product,'get_image_id') ? $product->get_image_id() : get_post_thumbnail_id($product->get_id());
	
	$wrapper_classes   = array(
			'woocommerce-product-gallery',
			'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
			'woocommerce-product-gallery--columns-' . absint( $columns ),
			'images',
	);
	
?>
	<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
		<figure class="woocommerce-product-gallery__wrapper">
			<?php

				if ( $post_thumbnail_id ) {
					$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
				} else {
					$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
					$html .= sprintf( '<img class="shop-ready-product-thumb-gly" src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'shopready-elementor-addon' ) );
					$html .= '</div>';
				}

				echo wp_kses_post($html);

				$attachment_ids = $product->get_gallery_image_ids();

				if( $settings['show_gallery']  == 'yes'){

					if ( $attachment_ids && $product->get_image_id() ) {
						foreach ( $attachment_ids as $attachment_id ) {
							echo wp_kses_post( wc_get_gallery_image_html( $attachment_id ) ); 
						}
					}
					
				} 
			

			?>
		</figure>
	</div>
