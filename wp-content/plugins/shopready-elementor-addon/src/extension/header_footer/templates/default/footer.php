			<?php
			   echo '<div class="shop--ready-footer-content-wrapper">';
					do_action( 'woo_ready_footer_builder_before' );
					do_action( 'woo_ready_footer_builder' );
					do_action( 'woo_ready_footer_builder_after' );
				echo "</div>";
				wp_footer();
			?>
		
	</body>
</html>
