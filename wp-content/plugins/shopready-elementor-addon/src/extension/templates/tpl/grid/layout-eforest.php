<div <?php wc_product_class( 'wooready_product_layout_eforest wooready_product_layout_eforest wooready-slider-product-layout', $product ); ?>>

	<?php

		do_action( 'shop_ready_grid_thumbnail' );
		do_action( 'woo_ready_grid_loop_content_before' );
		do_action( 'shop_ready_grid_loop_content' );
		do_action( 'woo_ready_grid_loop_content_after' );
	
	?>

</div>