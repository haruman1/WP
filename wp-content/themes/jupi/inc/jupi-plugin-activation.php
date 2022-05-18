<?php
require_once get_theme_file_path('/inc/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'jupi_register_required_plugins' );
function jupi_register_required_plugins() {
	$plugins = array(        
		// Add CMB2 plugin. Userd for Create Extra New Field in .
		array(
			'name'      => 'Redux Framework',
			'slug'      => 'redux-framework',
			'required'  => true,
		),
        array(
            'name'      => 'Jupi Core',
            'slug'      => 'jupicore',
            'source'    => get_theme_file_path('/lib/plugins/jupicore.zip'),
            'required'  => false
        ),
        array(
            'name'      => 'MailChimp for WordPress',
            'slug'      => 'mailchimp-for-wp',
            'required'  => false
        ),
        array(
            'name'      => 'Unyson One Click Demo Importer',
            'slug'      => 'unyson',
            'required'  => false
        ),
        array(
            'name'      => 'Elementor Page Builder',
            'slug'      => 'elementor',
            'required'  => false
        ),
        array(
            'name'      => 'Elements Ready',
            'slug'      => 'element-ready-lite',
            'required'  => false
        ),
        array(
		    'name'      => 'ShopReady Addon',
		    'slug'      => 'shopready-elementor-addon',
		    'required'  => true
		),
        array(
            'name'      => 'Classic Editor',
            'slug'      => 'classic-editor',
            'required'  => false
        ),
        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false
        ),
        array(
            'name'      => 'CMB2',
            'slug'      => 'cmb2',
            'required'  => true
        ),
        array(
            'name'      => 'WooCommerce',
            'slug'      => 'woocommerce',
            'required'  => false
        ),
        array(
            'name'      => 'WooCommerce Gallery Slider',
            'slug'      => 'advanced-woocommerce-product-gallery-slider',
            'required'  => false
        )
	);

	$config = array(
		'id'           => 'jupi',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}