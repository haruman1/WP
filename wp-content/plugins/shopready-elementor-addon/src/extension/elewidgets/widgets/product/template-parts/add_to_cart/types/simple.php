<?php
/**
 * Simple product add to cart
 *
 * @package Simple Product
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;


if ( ! $product->is_purchasable() ) {
	return;
}
$qty_label    =  $settings['simple_qty_label'] == 'yes' ? $settings['simple_qty_label_text'] : '';
if ( $product->is_in_stock() ) : ?>

	<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<?php
	
			if( $settings['show_stock'] == 'yes' ){
				echo wc_get_stock_html( $product ); // WPCS: XSS ok.
			}
			?>

			<div class="shop-ready-quantity-warapper display:flex gap:15"> 

				<?php if($qty_label !=''): ?>

					<div class="shop-ready-product-qty-label"> <?php echo esc_html($qty_label); ?> </div>
				
				<?php endif; ?>

				<?php 

					woocommerce_quantity_input(
						array(
							'min_value'   =>  $product->get_min_purchase_quantity(),
							'max_value'   => $product->get_max_purchase_quantity(),
							'input_value' => sanitize_text_field( isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity()), // WPCS: CSRF ok, input var ok.
						),
						$product
					);

			    ?>
			</div>
		<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button ajax_add_to_cart alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
	</form>

<?php endif; ?>
