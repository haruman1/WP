<?php
/**
 * Product Loop Start
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="products display:grid width:100% flex-wrap:wrap woo-ready-products shop-ready-product-grid-ajax-loader grid-template-columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?>">
