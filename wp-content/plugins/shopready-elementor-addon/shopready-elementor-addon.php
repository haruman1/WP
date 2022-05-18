<?php
/**
 * Plugin Name: ShopReady - Elementor Addons
 * Description: WooCommerce Builder for Elementor, Products Compare, UpSell, Variation Swatches, Wishlist, QuickView
 * Plugin URI: 	https://profiles.wordpress.org/quomodosoft
 * Version: 	1.4.9
 * Requires at least: 5.5
 * Tested up to: 5.9
 * Author: 		quomodosoft
 * Author URI: 	http://quomodosoft.com
 * License:  	apache-2.0+
 * License URI: http://www.apache.org/licenses/LICENSE-2.0
 * Text Domain: shopready-elementor-addon
 * Domain Path: /languages
 * Elementor tested up to: 3.5
 * Elementor Pro tested up to: 3.5.1
 * 
*/

ini_set( 'memory_limit', '2048M' );
ini_set( 'max_execution_time', '900' );

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if (defined('SHOP_READY')) {
	/**
	 * The plugin was already loaded (maybe as another plugin with different directory name)
	 */
} else {

        require __DIR__.'/vendor/autoload.php';

        /*
        **
        *** 
        *** 1. Used for security
        *** 2. Used to help know where we am on the filesystem.
        *** 
        **
        */
        
        define( 'SHOP_READY', true );
        define( 'SHOP_READY_VERSION', '1.4.8' );
        define( 'SHOP_READY_ASSET_MINIMIZE', true ); // uncomment for minimize version 
        define( 'SHOP_READY_LITE', true );
        define( 'SHOP_READY_ROOT', __FILE__ );
        define( 'SHOP_READY_URL', plugins_url( '/', SHOP_READY_ROOT ) );
        define( 'SHOP_READY_DIR_PATH', plugin_dir_path( SHOP_READY_ROOT ) );
        define( 'SHOP_READY_ADDONS_DIR_URL', SHOP_READY_URL.'src/extension' );
        define( 'SHOP_READY_ADDONS_DIR_PATH', SHOP_READY_DIR_PATH.'src/extension' );
        define( 'SHOP_READY_PLUGIN_BASE', plugin_basename( SHOP_READY_ROOT ) );
        define( 'SHOP_READY_ITEM_NAME', esc_html__('ShopReady','shopready-elementor-addon') );
        define( 'SHOP_READY_PUBLIC_ROOT_IMG', SHOP_READY_URL.'assets/public/images/' );
        define( 'SHOP_READY_PUBLIC_ROOT_JS', SHOP_READY_URL.'assets/public/js/' );
        define( 'SHOP_READY_PUBLIC_ROOT_CSS', SHOP_READY_URL.'assets/public/css/' );
        define( 'SHOP_READY_DEMO_URL', 'https://plugins.quomodosoft.com/shopready/' );
        define( 'SHOP_READY_SETTING_PATH', 'shop-ready-elements-dashboard' );

        /*
        ****
        ***** Now lets include the bootloader file
        ****
        */

        add_action('plugins_loaded', 'shop_ready_action_init_src',100);

        function shop_ready_action_init_src(){

            load_plugin_textdomain( 'shopready-elementor-addon' );
            do_action('shop_ready_before_bootstrap');
        
            require SHOP_READY_DIR_PATH .'/src/system/boot.php';
            require SHOP_READY_DIR_PATH .'/src/extension/init.php';
          
            do_action('shop_ready_after_bootstrap');
        }

        register_activation_hook(__FILE__,function(){
            update_option( 'shop_ready_qs_version', SHOP_READY_VERSION );
        } ); 
        
}

