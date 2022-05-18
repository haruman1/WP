<!DOCTYPE html>
<html <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
		<?php wp_head(); ?>

	</head>

	<body <?php body_class(['shopready-elementor-addon','woo-ready-header-enable']); ?>>

		<?php
		    wp_body_open();
			echo '<div class="shop--ready-header-content-wrapper">';
				do_action( 'woo_ready_header_builder_before' );
				do_action( 'woo_ready_header_builder' );
				do_action( 'woo_ready_header_builder_after' );
			echo "</div>";
		
		?>
		
			
			
