<?php

/**
 * Product quantity inputs
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 */

defined( 'ABSPATH' ) || exit;

use Shop_Ready\helpers\classes\Elementor_Helper as WReady_Helper;

$is_sr_active = false;
//shop_ready_template_is_active_gl('single')
if(is_singular('product') && shop_ready_template_is_active_gl('single')){
	$is_sr_active = true;
}

if(is_cart() && shop_ready_template_is_active_gl('cart')){
	$is_sr_active = true;
}

$on_change_qty  = WReady_Helper::get_global_setting('shop_ready_pro_cart_update_on_change_qty','no');
    
preg_match("/\[(.*?)\]/", $input_name, $matches);
$item_key = isset($matches[1])?$matches[1]:'';

if($is_sr_active){
	
	
	if ( $max_value && $min_value === $max_value ) {
		?>
		<div class="quantity hidden">
			<input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
		</div>
		<?php
	} else {
		
		$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'shopready-elementor-addon' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'shopready-elementor-addon' );
		?>
		<div class="wooready_product_quantity ">
			<div class="product-quantity"> 
				<label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php echo esc_attr( $label ); ?></label>
				<button type="button" class="woo-ready-qty-sub <?php echo esc_attr($on_change_qty == 'yes'?'woo-ready-qty-sub-js':''); ?>">-</button>
				<input
					type="number"
					id="<?php echo esc_attr( $input_id ); ?>"
					class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
					step="<?php echo esc_attr( $step ); ?>"
					min="<?php echo esc_attr( $min_value ); ?>"
					max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
					name="<?php echo esc_attr( $input_name ); ?>"
					data-item_key="<?php echo esc_attr( $item_key ); ?>"
					value="<?php echo esc_attr( $input_value ); ?>"
					title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'shopready-elementor-addon' ); ?>"
					size="4"
					placeholder="<?php echo esc_attr( $placeholder ); ?>"
					inputmode="<?php echo esc_attr( $inputmode ); ?>" />
				<button type="button" class="woo-ready-qty-add <?php echo esc_attr($on_change_qty == 'yes'?'woo-ready-qty-add-js':''); ?>">+</button>
			</div>
		</div>
		<?php
	}
	
}else{
	if ( $max_value && $min_value === $max_value ) {
		?>
		<div class="quantity hidden">
			<input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
		</div>
		<?php
	} else {
		/* translators: %s: Quantity. */
		$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'shopready-elementor-addon' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'shopready-elementor-addon' );
		?> 
		<div class="quantity">
			<?php do_action( 'woocommerce_before_quantity_input_field' ); ?>
			<label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php echo esc_attr( $label ); ?></label>
			<input
				type="number"
				id="<?php echo esc_attr( $input_id ); ?>"
				class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
				step="<?php echo esc_attr( $step ); ?>"
				min="<?php echo esc_attr( $min_value ); ?>"
				max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
				name="<?php echo esc_attr( $input_name ); ?>"
				value="<?php echo esc_attr( $input_value ); ?>"
				title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'shopready-elementor-addon' ); ?>"
				size="4"
				data-item_key="<?php echo esc_attr( $item_key ); ?>"
				placeholder="<?php echo esc_attr( $placeholder ); ?>"
				inputmode="<?php echo esc_attr( $inputmode ); ?>" />
			<?php do_action( 'woocommerce_after_quantity_input_field' ); ?>
		</div>
		<?php
	}
}
