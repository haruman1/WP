<?php

/**
 * Product Data Tabs | Product details page
 * @since 1.0
 * @author quomodosoft.com
 */

    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    $product_tabs = apply_filters( 'woocommerce_product_tabs', array() );
   
    $hide_tabs = $settings['hide_tabs'];

    if(shop_ready_is_elementor_mode() ){
  
        echo '<div class="elementor-alert elementor-alert-info" role="alert">
        <span class="elementor-alert-title">Editor Mode Notice</span>
                        <span class="elementor-alert-description"> Data Tab Will Not show in Editor Mode. Check in preview  .</span>
                                    <button type="button" class="elementor-alert-dismiss">
                <span aria-hidden="true">×</span>
                <span class="elementor-screen-only">Dismiss alert</span>
            </button>
                </div>';
        return;

    }
 

if ( ! empty( $product_tabs ) ) : ?>

	<div class="woocommerce-tabs wc-tabs-wrapper">

        <?php if( $settings['show_tab_menu'] == 'yes' ): ?> 
            <ul class="tabs wc-tabs" role="tablist">
                <?php foreach ( $product_tabs as $key => $product_tab ) : ?>
                    <?php 
                    
                        if(in_array( $key , $hide_tabs)){
                            continue;
                        } 

                    ?>
                    <li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
                        <a href="#tab-<?php echo esc_attr( $key ); ?>">
                            <?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <div class="wready-product-tab-content">
            <?php foreach ( $product_tabs as $key => $product_tab ) : ?>
                    <?php 
                        if(in_array( $key , $hide_tabs)){
                            continue;
                        }    
                    ?>
                    <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
                        <?php
                            if ( isset( $product_tab['callback'] ) ) {
                                call_user_func( $product_tab['callback'], $key, $product_tab );
                            }
                        ?>
                    </div>
            <?php endforeach; ?>
       
        </div>
		
	</div>

<?php endif; ?>
