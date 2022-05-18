<?php 

    /**
     * Elementor 
     * override from elementor elementor/modules/pagetemplates/header footer
     */
    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly.
    }


    \Elementor\Plugin::$instance->frontend->add_body_class( 'elementor-template-full-width' );

    do_action( 'shop_ready_template_header_common','cart');

    get_header( 'shop' );

    /**
     * Before Header-Footer page template content.
     *
     * Fires before the content of Elementor Header-Footer page template.
     *
     * @since 2.0.0
     */
    do_action( 'elementor/page_templates/header-footer/before_content' ); ?>

    <?php  do_action( 'mangocube_empty_cart_container_before' ); ?>

    <div class="mangocube-empty-cart-container">
        
        <?php  do_action( 'mangocube_empty_cart_notification' ); ?>
        <?php  do_action( 'mangocube_act_tpl_empty_cart' ); ?>

    </div>
    <?php  do_action( 'mangocube_empty_cart_container_after' ); ?>

        
    <?php 

    /**
     * After Header-Footer page template content.
     *
     * Fires after the content of Elementor Header-Footer page template.
     *
     * @since 2.0.0
     */
    do_action( 'elementor/page_templates/header-footer/after_content' );

    get_footer( 'shop' );


